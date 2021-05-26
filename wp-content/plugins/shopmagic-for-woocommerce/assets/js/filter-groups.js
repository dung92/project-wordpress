'use strict';

/**
 * Filters group (and-or) events and rendering.
 *
 * @param possibleFilters
 * @param translations
 * @constructor
 */
function FilterGroups(possibleFilters, translations) {
	this.possibleFilters = possibleFilters;
	this.translations = translations;
	this.possibleFilters.unshift({
		id: '',
		name: this.translations.select_filter,
	});
}

FilterGroups.prototype = {
	addGroupButtonId: '#add-filter-group',
	filterGroupContainerId: '#filter-group-area',
	possibleFilters: [],
	translations: {},
	uniqueIdCounter: 0,

	/**
	 * @returns {jQuery|HTMLElement}
	 */
	prepareFilterGroupTemplate: function () {
		let $groupTemplate = jQuery('<div class="filters-group"><div class="filter-field-select"></div><div class="filter-fields"></div><div class="filter-buttons"><button class="button filter-add-and">' + this.translations.and + '</button><button class="filter-remove" title="' + this.translations.remove + '">&ndash;</button></div></div>');

		$groupTemplate.find('.filter-remove').click(function (e) {
			e.preventDefault();
			this.removeGroup(jQuery(e.target).parents('.filters-group'));
		}.bind(this));

		$groupTemplate.find('.filter-add-and').click(function (e) {
			e.preventDefault();
			this.addNewAndInnerGroup(jQuery(e.target).parents('.filters-group'));
		}.bind(this));

		return $groupTemplate;
	},

	/**
	 *
	 * @param {jQuery} $groupHandle
	 * @param {Object} filterData
	 */
	addNewAndInnerGroup: function ($groupHandle, filterData) {
		let $template = this.prepareFilterGroupTemplate();
		$template.data('groupId', $groupHandle.data('groupId'));
		$groupHandle.after($template);
		this.initializeFilterElement($template, $template.data('groupId'), ++this.uniqueIdCounter, filterData);
	},

	/**
	 *
	 * @param {jQuery} $template
	 * @param {Number} groupNumber
	 * @param {Number} ruleNumber
	 * @param {Object} filterData
	 */
	initializeFilterElement: function ($template, groupNumber, ruleNumber, filterData) {
		let filterElement = new FilterElement($template, groupNumber, ruleNumber, this.translations);
		filterElement.renderSelectFilterField(this.possibleFilters)
		if (filterData) {
			filterElement.setFilterData(filterData);
		}
	},

	/**
	 * @param {Object} filterData
	 * @returns {jQuery|HTMLElement}
	 */
	addNewFilterGroup: function (filterData) {
		let $template = this.prepareFilterGroupTemplate();
		$template.data('groupId', ++this.uniqueIdCounter)
		let $container = jQuery(this.filterGroupContainerId);

		if ($container.find('.filters-group').length > 0) {
			$template.prepend('<div class="filters-group-or"><span>' + this.translations.or + '</span></div>')
		}
		$container
			.append($template);

		this.initializeFilterElement($template, $template.data('groupId'), ++this.uniqueIdCounter, filterData);

		return $template;
	},

	renderExistentFilters: function (existingFilters) {
		let lastOrId = null;
		let $template = null;
		for (let orGroupId in existingFilters) {
			if (existingFilters.hasOwnProperty(orGroupId)) {
				for (let andGroupId in existingFilters[orGroupId]) {
					if (existingFilters[orGroupId].hasOwnProperty(andGroupId)) {
						const filterData = existingFilters[orGroupId][andGroupId];

						if (lastOrId !== orGroupId) {
							lastOrId = orGroupId;
							$template = this.addNewFilterGroup(filterData);
						} else {
							this.addNewAndInnerGroup($template, filterData);
						}
					}
				}
			}
		}
	},

	/**
	 * @param {jQuery} $groupHandle
	 */
	removeGroup: function ($groupHandle) {
		$groupHandle.next().find('.filter-group-or').remove();
		$groupHandle.remove();
	},

	attachEvents: function () {
		jQuery(this.filterGroupContainerId).empty();
		jQuery(this.addGroupButtonId)
			.toggle(this.possibleFilters.length > 1)
			.unbind()
			.click(function (e) {
				e.preventDefault();
				this.addNewFilterGroup();
			}.bind(this));
	}
};
