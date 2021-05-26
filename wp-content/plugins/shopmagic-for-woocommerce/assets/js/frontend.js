window.shopmagic = (function (window, document, $) {
	let app = {};

	app.cache = function () {
		app.$ajax_form = $('.shopmagic-form form');
	};

	app.init = function () {
		app.cache();
		app.$message_container = $('.shopmagic-message');
		app.$ajax_form.on('submit', app.form_handler);
	};

	app.post_ajax = function (serial_data) {
		let post_data = {
			action: 'sm_subscribe_user_to_list',
			nonce: shopmagic_form.nonce,
			show_name: shopmagic_form.show_name,
			serialized: serial_data,
		};

		$.post(shopmagic_form.ajax_url, post_data, app.ajax_response, 'json')
	};

	app.ajax_response = function (response) {
		if (response.success) {
			app.$message_container.removeClass('error').addClass('success');
			app.$message_container.text(response.data).show();
		} else {
			app.$message_container.removeClass('success').addClass('error');
			app.$message_container.text(response.data).show();
		}
	};

	app.form_handler = function (evt) {
		evt.preventDefault();
		app.$message_container.hide();
		let serialized_data = app.$ajax_form.serialize();
		app.post_ajax(serialized_data);
	};

	$(document).ready(app.init);

	return app;

})(window, document, jQuery);
