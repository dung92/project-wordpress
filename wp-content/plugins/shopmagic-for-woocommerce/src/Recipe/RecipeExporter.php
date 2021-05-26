<?php

namespace WPDesk\ShopMagic\Recipe;

use WPDesk\ShopMagic\Automation\AutomationPersistence;

final class RecipeExporter {
	public function get_as_recipe(int $automation_id): array {
		$automation_persistence = new AutomationPersistence( $automation_id );

		$data = [
			'event'   => [
				'slug' => $automation_persistence->get_event_slug(),
				'data' => $automation_persistence->get_event_data(),
			],
			'filters' => $automation_persistence->get_filters_data(),
			'actions' => $automation_persistence->get_actions_data(),
		];

		return $data;
	}
}
