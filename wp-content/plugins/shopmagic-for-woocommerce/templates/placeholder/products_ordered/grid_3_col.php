<?php
/** @var WC_Order_Item[] $order_items */
/** @var WC_Product[] $products */
/** @var string[] $product_names */
/** @var string[] $parameters */
?>
<style>
	<?php /** don't inline this css - hack for gmail */ ?>
	.sm-product-grid .sm-product-grid-item-2-col img {
		height: auto !important;
	}
</style>

<table cellspacing="0" cellpadding="0" class="sm-product-grid">
	<tbody>
	<tr>
		<td style="padding: 0;">
			<div class="sm-product-grid-container">
				<?php $n = 1; ?>
				<?php foreach ( $products as $product ): ?>

					<div class="sm-product-grid-item-3-col"
						 style="<?php echo( $n % 3 ? '' : 'margin-right: 0;' ) ?>">

						<a href="<?php echo esc_url( $product->get_permalink() ); ?>"><?php echo $product->get_image() ?></a>
						<h3>
							<a href="<?php echo esc_url( $product->get_permalink() ); ?>"><?php echo esc_html( $product->get_name() ); ?></a>
						</h3>
					</div>
					<?php $n ++; endforeach; ?>
			</div>
		</td>
	</tr>
	</tbody>
</table>
