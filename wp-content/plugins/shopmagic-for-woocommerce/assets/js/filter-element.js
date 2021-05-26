'use strict';

/**
 * Single filter fields events.
 *
 * @param {jQuery} $container
 * @param {Number} groupNumber
 * @param {Number} ruleNumber
 * @param {Object} translations
 * @constructor
 */
function FilterElement($container, groupNumber, ruleNumber, translations) {
	this.$container = $container;
	this.translations = translations;

	this.groupNumber = groupNumber;
	this.ruleNumber = ruleNumber;
}

FilterElement.prototype = {
	filter: null,
	$container: null,
	afterRenderHook: function () {
	},
	translations: {},
	groupNumber: '',
	ruleNumber: 0,

	/**
	 *
	 * @param {Object} field
	 * @returns {jQuery|HTMLElement}
	 */
	prepareHtmlField: function (field) {
		/**
		 * @param {jQuery} $select
		 * @param {Object} options
		 */
		const setSelectOptions = function ($select, options) {
			for (let key in options) {
				if (options.hasOwnProperty(key)) {
					const val = options[key];
					$select.append('<option value="' + key + '">' + val + '</option>');
				}
			}
		}

		let $element;
		switch (field.template) {
			case 'select':
				$element = jQuery('<select />');
				setSelectOptions($element, field.options);
				break;
			case 'woo-select':
				$element = jQuery('<select />');
				$element.prop('multiple', true);
				$element.addClass('wc-enhanced-select');
				setSelectOptions($element, field.options);

				let old_hook = this.afterRenderHook;
				this.afterRenderHook = function () {
					jQuery(document.body).trigger('wc-enhanced-select-init');
					old_hook();
				};
				break;
			case 'product-select':
				$element = jQuery('<select />')
					.addClass('wc-product-search')
					.data('action', 'woocommerce_json_search_products_and_variations')
					.data('placeholder', field.placeholder);
				setSelectOptions($element, field.options);

				let old = this.afterRenderHook;
				this.afterRenderHook = (function ($element) {
					return function () {
						// this type of select has no options, so must put previous values as special options
						const prevVal = $element.data('preval');
						if (prevVal) {
							for (let name in prevVal) {
								if (prevVal.hasOwnProperty(name)) {
									let $option = jQuery('<option />');
									$option
										.attr('selected', 'selected')
										.val(prevVal[name])
										.html(name);
									$element.append($option);
								}
							}
						}

						jQuery(document.body).trigger('wc-enhanced-select-init');
						old();
					};
				})($element);
				break;
			case 'input-date-picker':
				$element = jQuery('<input type="text" />')
					.addClass('date-picker')
					.datepicker({
						dateFormat: 'yy-mm-dd',
						showOtherMonths: true,
						selectOtherMonths: true,
						showButtonPanel: true
					});
				break;
			default:
				$element = jQuery('<input type="text" />');
		}

		if (field.disabled) {
			$element.prop('disabled', true);
		}
		if (field.readonly) {
			$element.prop('readonly', true);
		}
		if (field.multiple) {
			$element.attr('name', this.generateFieldName(field.name) + '[]');
			$element.prop('multiple', true);
		} else {
			$element.attr('name', this.generateFieldName(field.name));
		}
		if (field.placeholder) {
			$element.prop('placeholder', field.placeholder);
		}

		if (field.label) {
			$element.prepend(jQuery('<label>' + field.label + '</label>'));
		}

		return $element;
	},

	/**
	 * @param {string} fieldName
	 * @returns {string}
	 */
	generateFieldName: function (fieldName) {
		return '_filters[' + [this.groupNumber, this.ruleNumber, fieldName].join('][') + ']';
	},

	/**
	 * @param {Array<Object>} possibleFilters
	 */
	renderSelectFilterField: function (possibleFilters) {
		let $select = jQuery('<select />');
		$select.attr('name', this.generateFieldName('filter_slug'));

		let groupName = null;
		let $group = null;

		possibleFilters.forEach(function (filter) {
			let $option = jQuery('<option />')
				.val(filter.id)
				.html(filter.name)
				.data('filter', filter);

			if (filter.group !== groupName) {
				if ($group !== null) {
					$select.append($group);
				}
				groupName = filter.group;
				$group = jQuery('<optgroup />').attr('label', groupName);
			}

			$group.append($option);
		});
		if ($group !== null) {
			$select.append($group);
		}

		$select.change(function (e) {
			const selectedFilter = jQuery(e.target).find(":selected").data('filter');

			this.renderFields(selectedFilter);
		}.bind(this));

		this.$container.find('.filter-field-select').append($select);
	},

	/**
	 * @param {Object} filterData
	 */
	setFilterData: function (filterData = null) {
		let $option = this.$container.find('.filter-field-select select option[value=' + filterData.filter_slug + ']');
		if ($option.length > 0) {
			$option.attr('selected', 'selected');
			const selectedFilter = $option.data('filter');
			this.renderFields(selectedFilter, filterData.data);
		}
	},

	/**
	 * @param {Object} selectedFilter
	 * @param {Object} fieldsData
	 */
	renderFields: function (selectedFilter, fieldsData = null) {
		this.filter = selectedFilter;

		this.afterRenderHook = function () {
		};

		let $fieldsContainer = this.$container.find('.filter-fields');
		$fieldsContainer.empty();

		if (this.filter.fields) {
			this.filter.fields.forEach(function (field) {
				let $htmlField = this.prepareHtmlField(field);
				if (fieldsData && fieldsData.hasOwnProperty(field.name)) {
					$htmlField.val(fieldsData[field.name]);
					$htmlField.data('preval', fieldsData[field.name]);
				}
				$fieldsContainer.append($htmlField);
				$htmlField.wrap('<div class="field"></div>')
			}.bind(this));
		}

		this.afterRenderHook();
	}
};
