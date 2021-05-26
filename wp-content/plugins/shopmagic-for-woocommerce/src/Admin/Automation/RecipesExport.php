<?php


namespace WPDesk\ShopMagic\Admin\Automation;


use WPDesk\ShopMagic\Recipe\RecipeExporter;

class RecipesExport {

	public function hooks() {
		add_action( 'wp_ajax_export_as_recipe', [ $this, 'export_as_recipe' ] );

		add_action( 'admin_init', function () {
			add_meta_box( 'shopmagic_export_as_recipe', __( 'Export as recipe', 'shopmagic-for-woocommerce' ), static function () {
				$id         = (int) $_GET['post'];
				$export_url = add_query_arg( [
					'action' => 'export_as_recipe',
					'id'     => $id
				], admin_url( 'admin-ajax.php' ) );
				echo "<a href='{$export_url}' target='_blank'>Export</a>";
			}, 'shopmagic_automation', 'side', 'high' );
		} );
	}

	/**
	 * @internal
	 */
	public function export_as_recipe() {
		if ( current_user_can( 'manage_options' ) ) {
			$recipe = ( new RecipeExporter() )->get_as_recipe( (int) $_GET['id'] );
			$recipe = [ 'name' => 'Template name', 'description' => 'Template description' ] + $recipe;
			wp_send_json( $recipe );
		}
	}
}
