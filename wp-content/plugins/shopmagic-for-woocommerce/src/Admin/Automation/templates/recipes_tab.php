<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** @var \WPDesk\ShopMagic\Recipe\Recipe[] $recipes */

?>

<h1 class="wp-heading-inline"><?php _e( 'Recipes', 'shopmagic-for-woocommerce' ); ?></h1>

<table class="wp-list-table widefat striped">
	<thead>
	<tr>
		<th><?php _e( 'Recipe', 'shopmagic-for-woocommerce' ); ?></th>
		<th><?php _e( 'Actions', 'shopmagic-for-woocommerce' ); ?></th>
	</tr>
	</thead>
	<?php foreach ( $recipes as $recipe ): ?>
		<tr>
			<td><p><span class="row-title"><?php echo esc_html( $recipe->get_name() ); ?></span></p>
					<p><?php echo esc_html( $recipe->get_description() ); ?></p>
			</td>
			<td style="vertical-align: middle;">
			<?php if ( $recipe->can_use() ): ?>
				<a class="button button-primary" href="<?php echo add_query_arg( [
						'action' => 'shopmagic_brew_recipe',
						'recipe' => $recipe->get_id()
					], admin_url( 'admin-ajax.php' ) ); ?>"><?php _e( 'Use recipe', 'shopmagic-for-woocommerce' ); ?></a>
			<?php else: ?>
				<a class="button" href="https://wpde.sk/shopmagic-recipes" target="_blank"><?php _e( 'Learn more', 'shopmagic-for-woocommerce' ); ?></a>
			<?php endif; ?>
			</td>
		</tr>
	<?php endforeach; ?>
</table>
