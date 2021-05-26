<?php
/** @var WC_Order_Item[] $order_items */
/** @var WC_Product[] $products */
/** @var string[] $product_names */
/** @var string[] $parameters */
?>
<ul>
	<?php foreach ( $products as $product ): ?>
		<li><?php echo $product->get_name() ?></li>
	<?php endforeach; ?>
</ul>
