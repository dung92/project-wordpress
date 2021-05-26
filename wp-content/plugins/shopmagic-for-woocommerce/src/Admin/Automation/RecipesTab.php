<?php


namespace WPDesk\ShopMagic\Admin\Automation;


use ShopMagicVendor\WPDesk\View\Renderer\SimplePhpRenderer;
use ShopMagicVendor\WPDesk\View\Resolver\DirResolver;
use WPDesk\ShopMagic\Action\ActionFactory2;
use WPDesk\ShopMagic\Event\EventFactory2;
use WPDesk\ShopMagic\Filter\FilterFactory2;
use WPDesk\ShopMagic\Placeholder\PlaceholderFactory2;
use WPDesk\ShopMagic\Recipe\RecipeProvider;

class RecipesTab {
	/** @var RecipeProvider */
	private $recipe_provider;

	public function __construct(
		EventFactory2 $event_factory,
		FilterFactory2 $filter_factory,
		ActionFactory2 $action_factory,
		PlaceholderFactory2 $placeholder_factory
	) {
		// wait for integrations to initialize all factories
		add_action( 'shopmagic/core/initialized/v2', function () use ( $event_factory, $filter_factory, $action_factory, $placeholder_factory ) {
			$this->recipe_provider = new RecipeProvider(
				__DIR__ . '/' . 'recipes',
				array_keys( $event_factory->get_event_list() ),
				array_keys( $filter_factory->get_filter_list() ),
				array_keys( $action_factory->get_action_list() ),
				$placeholder_factory->get_possible_placeholder_slugs()
			);
		}, 99999 );

	}

	public function hooks() {
		add_action( 'wp_ajax_shopmagic_recipes_tab', [ $this, 'render_tab' ] );
		add_action( 'wp_ajax_shopmagic_brew_recipe', [ $this, 'brew_recipe' ] );
		add_action( 'admin_notices', [ $this, 'shopmagic_admin_notice_recipes' ] );
	}

	/**
	 * @internal
	 */
	public function render_tab() {
		$renderer = new SimplePhpRenderer( new DirResolver( __DIR__ . DIRECTORY_SEPARATOR . 'templates' ) );
		echo $renderer->render( 'recipes_tab', [ 'recipes' => ( $this->recipe_provider )->get_recipes() ] );
		wp_die();
	}

	/**
	 * @internal
	 */
	public function brew_recipe() {
		if ( current_user_can( 'manage_options' ) ) {
			// escape ID for security reasons
			$id_map = explode( '/', $_GET['recipe'] );
			$id_map = array_slice( array_map( 'sanitize_file_name', $id_map ), 0, 2 );
			$id     = implode( '/', $id_map );

			$recipe  = $this->recipe_provider->get_recipe( $id );
			$post_id = $recipe->import();
			wp_redirect( get_edit_post_link( $post_id, 'not-for-display-context' ) );
			exit();
		}
	}

	/**
	 * Display recipes admin notice
	 *
	 */
	public function shopmagic_admin_notice_recipes() {

		global $current_user;
		$user_id     = $current_user->ID;
		$notice_name = 'recipes';
		$screen      = get_current_screen();

		if ( $screen && $screen->post_type === 'shopmagic_automation' && $screen->action === 'add' && ! get_user_meta( $user_id, 'shopmagic_ignore_notice_' . $notice_name ) ) {

			echo '<div class="notice notice-info is-dismissible shopmagic-recipes-notice" data-notice-name="' . $notice_name . '"><h2>' . __( 'Recipes', 'shopmagic-for-woocommerce' ) . '</h2><p>' . __( 'Recipes are a great way to start with ShopMagic. Browse ready-to-use follow-up strategies, best email texts and save a lot of time!', 'shopmagic-for-woocommerce' ) . '</p><a class="button button-primary" href="' . admin_url( 'edit.php?post_type=shopmagic_automation#recipes_tab' ) . '" target="_blank">' . __( 'Browse recipes', 'shopmagic-for-woocommerce' ) . '</a><br><br></div>';
		}

	}
}
