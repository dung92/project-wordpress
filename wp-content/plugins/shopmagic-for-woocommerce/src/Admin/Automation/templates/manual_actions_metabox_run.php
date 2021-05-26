<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @var string $name Expected manual automation submit name.
 */

?>

<p>
	<?php echo sprintf( __( 'Please set up and save the automation. Then press the button below in order to trigger actions. %sLearn more &rarr;%s', 'shopmagic-for-woocommerce' ), '<a href="https://docs.shopmagic.app/" target="_blank">', '</a>' ); ?>
</p>

<input type="submit" name="<?php echo $name ?>" value="<?php _e( 'Preview and run actions', 'shopmagic-for-woocommerce' ); ?>" class="button button-primary button-large"/>
