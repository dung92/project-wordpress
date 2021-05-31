jQuery(document).ready(function($) {
	let json_wards = lwc_ward.wards.replace(/&quot;/g, '"'),
		json_countries = lwc_ward.countries,
		wards = $.parseJSON(json_wards);
		
	$('body').on('change', '#billing_country, #shipping_country', function() {
		let container = $(this),
			select_id = container.attr('id'),
			country = container.val(),
			row_ward = $('#'+select_id.replace('_country', '_ward')).closest('.form-row');
			
		if (json_countries.indexOf(country) >= 0) {
			row_ward.show();
		} else {
			row_ward.hide();
		}
	});
		
	$('body').on('change', '#billing_city, #shipping_city, #calc_shipping_city', function() {
		let container = $(this),
			select_id = container.attr('id'),
			city = container.val();
		
		if (wards[city]) {
			if(wards[city] instanceof Array) {
				var list = wards[city].sort();
				var select_ward = $('#'+select_id.replace('_city', '_ward'));
				
				if (select_ward.length) {
					html = '<option value="">'+ lwc_ward.i18n_select_ward_text +'</option>';
					for (let i = 0; i < list.length; i++) {
						html += '<option value="'+ list[i] +'">'+ list[i] +'</option>';
					}
					select_ward.html(html);
				}
			}
		}
	});
});