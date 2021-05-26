<?php


namespace WPDesk\ShopMagic\Recipe;


final class RecipeProvider {
	/** @var string */
	private $dir;

	/** @var string[] */
	private $installed_events;

	/** @var string[] */
	private $installed_filters;

	/** @var string[] */
	private $installed_actions;
	/**
	 * @var array
	 */
	private $installed_placeholders;

	public function __construct( string $dir, array $installed_events, array $installed_filters, array $installed_actions, array $installed_placeholders ) {
		$this->dir = $dir;

		$this->installed_events       = $installed_events;
		$this->installed_filters      = $installed_filters;
		$this->installed_actions      = $installed_actions;
		$this->installed_placeholders = $installed_placeholders;
	}

	public function get_recipe( string $id ): Recipe {
		$full_filename = $this->dir . '/' . $id;

		return new Recipe(
			json_decode( file_get_contents( $full_filename ), true ),
			$id,
			$this->installed_events,
			$this->installed_filters,
			$this->installed_actions,
			$this->installed_placeholders
		);
	}

	private function get_locale(): string {
		$locale = get_locale();
		if ( ! file_exists( $this->dir . '/' . $locale ) ) {
			$default_locale = 'en_US';
			$locale         = $default_locale;
		}

		return $locale;
	}

	/**
	 * @return Recipe[]
	 */
	public function get_recipes(): \Generator {
		$locale       = $this->get_locale();
		$lang_path    = $this->dir . '/' . $locale;
		$recipe_files = scandir( $lang_path );
		sort( $recipe_files, SORT_NATURAL );
		foreach ( $recipe_files as $filename ) {
			$full_filename = $lang_path . '/' . $filename;
			if ( is_file( $full_filename ) ) {
				yield $this->get_recipe( $locale . '/' . $filename );
			}
		}
	}
}
