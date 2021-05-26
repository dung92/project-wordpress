'use strict';

/**
 * Creates a Placeholder dialog to help user create a placeholder string.
 *
 * @param {string} slug Unique placeholder slug that identify placeholder in backend
 * @constructor
 */
function PlaceholderDialog(slug) {
	this.slug = slug;
}

PlaceholderDialog.prototype = {
	slug: '',
	wpActionDialogRender: 'shopmagic_placeholder_dialog',
	stringResultSelector: '#placeholder_result',
	stringCopySelector: '#copy_placeholder_result',
	dialogHandle: null,

	/**
	 * Shows dialog.
	 *
	 * @public
	 */
	show: function () {
		if (this.dialogHandle === null) {
			jQuery.get(ajaxurl, {
				'action': this.wpActionDialogRender,
				'event_data': jQuery("#shopmagic_event_metabox [name^='event']").serialize(),
				'slug': this.slug
			}, this.render.bind(this));
		} else {
			console.debug('Show: Dialog is already visible');
		}
	},

	/**
	 * Render dialog html data and show as dialog with all behaviours.
	 *
	 * @param {string} data
	 *
	 * @private
	 */
	render: function (data) {
		this.dialogHandle = jQuery(data).dialog({
			modal: true,
			draggable: false,
			resizable: false,
			width: 560,
			classes: {
				"ui-dialog": "placeholder-dialog"
			},
			close: this.destroy.bind(this)
		});
		this.runStringGenerator();
	},

	/**
	 * Create result string and put it as input val.
	 *
	 * @param {Array<jQuery>} $fields Array of values
	 *
	 * @private
	 */
	generatePlaceholderString: function ($fields) {
		const paramsString = $fields.map(function (index, item) {
			const name = jQuery(item).attr('name').toString().replace(/[\[\]]/g, '');
			const value = jQuery(item).val()? jQuery(item).val().toString(): '';
			if (value.length > 0) {
				return `${name}: '${value}'`;
			}
			return '';
		}).toArray().filter(function (item) {
			return item.length > 0;
		}).join(', ');

		let result = `{{ ${this.slug} }}`;
		if (paramsString.length > 0) {
			result = `{{ ${this.slug} | ${paramsString} }}`;
		}

		jQuery(this.dialogHandle).find(this.stringResultSelector).val(result);
	},

	/**
	 * Refresh result string and attach all result string behaviours.
	 *
	 * @private
	 */
	runStringGenerator: function () {
		let $fields = jQuery(this.dialogHandle).find('select, input').not(this.stringResultSelector);
		const self = this;

		this.generatePlaceholderString($fields);

		$fields
			.keyup(function (e) {
				e.preventDefault();
				self.generatePlaceholderString($fields);
			})
			.change(function (e) {
				e.preventDefault();
				self.generatePlaceholderString($fields);
			});

		jQuery(this.dialogHandle).find(this.stringCopySelector).click(function (e) {
			e.preventDefault();
			self.copyResultToClipboard();
			self.destroy();
		});
	},

	/**
	 * Copy result field value to the clipboard.
	 *
	 * @private
	 */
	copyResultToClipboard: function () {
		const resultField = jQuery(this.dialogHandle).find(this.stringResultSelector).get(0);
		resultField.select();
		resultField.setSelectionRange(0, 99999);
		document.execCommand("copy");
	},

	/**
	 * Destroys dialog. After this method the dialog is unavailable and not exists in DOM.
	 *
	 * @private
	 */
	destroy: function () {
		jQuery(this.dialogHandle)
			.empty()
			.remove();
	}
};
