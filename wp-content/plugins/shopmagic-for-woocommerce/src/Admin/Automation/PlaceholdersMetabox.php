<?php
namespace WPDesk\ShopMagic\Admin\Automation;

/**
 * ShopMagic Placeholders Meta Box class
 *
 * @package ShopMagic
 * @since   1.0.0
 */
final class PlaceholdersMetabox extends AbstractMetabox {

	public function initialize() {
		$this->setup();
	}

	/**
	 * Setup metabox.
	 *
	 * @since   1.0.0
	 */
	function setup() {
		add_meta_box( 'shopmagic_placeholders_metabox', __( 'Placeholders', 'shopmagic-for-woocommerce' ), array(
			$this,
			'draw_metabox'
		), 'shopmagic_automation', 'side' );
	}

	/**
	 * Display metabox in admin side
	 *
	 * @param \WP_Post $post
	 *
	 * @since   1.0.0
	 */
	function draw_metabox( $post ) {
		echo $this->get_renderer()->render('placeholder_metabox');
	}
}
