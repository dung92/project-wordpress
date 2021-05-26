<?php

namespace WPDesk\ShopMagic\CommunicationList;

use WPDesk\ShopMagic\Automation\AutomationPostType;

/**
 * Communication type taxonomy definition. Should be hooked with AutomationPostType
 *
 * @package WPDesk\ShopMagic\Automation
 *
 * @since 2.8
 */
final class CommunicationListPostType {
	const TYPE = 'shopmagic_list';
	const POST_TYPE_MENU_URL = 'edit.php?post_type=' . self::TYPE;

	/** @internal */
	const DATE_COLUMN_KEY = 'date';
	/** @internal */
	const TYPE_COLUMN_KEY = 'type';
	/** @internal */
	const OPTIN_COLUMN_KEY = 'optin';
	/** @internal */
	const OPTOUT_COLUMN_KEY = 'optout';


	/**
	 * Initializes custom post type for List types.
	 *
	 * @internal
	 */
	public function setup_post_type() {
		$labels = array(
			'name'               => _x( 'Lists', 'post type general name', 'shopmagic-for-woocommerce' ),
			'singular_name'      => _x( 'List', 'post type singular name', 'shopmagic-for-woocommerce' ),
			'menu_name'          => _x( 'Lists', 'admin menu', 'shopmagic-for-woocommerce' ),
			'name_admin_bar'     => _x( 'Lists', 'add on admin bar', 'shopmagic-for-woocommerce' ),
			'add_new'            => _x( 'Add New', 'list', 'shopmagic-for-woocommerce' ),
			'add_new_item'       => __( 'Add New List', 'shopmagic-for-woocommerce' ),
			'new_item'           => __( 'New List', 'shopmagic-for-woocommerce' ),
			'edit_item'          => __( 'Edit List', 'shopmagic-for-woocommerce' ),
			'view_item'          => __( 'View List', 'shopmagic-for-woocommerce' ),
			'all_items'          => __( 'Lists', 'shopmagic-for-woocommerce' ),
			'search_items'       => __( 'Search Lists', 'shopmagic-for-woocommerce' ),
			'parent_item_colon'  => __( 'Parent Lists:', 'shopmagic-for-woocommerce' ),
			'not_found'          => __( 'No Lists found.', 'shopmagic-for-woocommerce' ),
			'not_found_in_trash' => __( 'No Lists found in Trash.', 'shopmagic-for-woocommerce' )
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'ShopMagic lists.', 'shopmagic-for-woocommerce' ),
			'public'             => false,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'show_in_menu'       => AutomationPostType::POST_TYPE_MENU_URL,
			'show_in_nav_menus'  => false,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'list' ),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => 10,
			'supports'           => array( 'title' ),
			'taxonomies'         => []
		);

		register_post_type( self::TYPE, $args );
	}

	/**
	 * Adds 'Event' column header to 'Automations' page and moves date to the last position
	 *
	 * @param array $columns
	 *
	 * @return array new columns
	 * @since 2.8
	 */
	public function set_column_headers( $columns ) {
		$date = $columns[ self::DATE_COLUMN_KEY ];
		unset( $columns[ self::DATE_COLUMN_KEY ] );

		$columns[ self::TYPE_COLUMN_KEY ]   = __( 'Type', 'shopmagic-for-woocommerce' );
		$columns[ self::OPTIN_COLUMN_KEY ]  = __( 'Opt-ins', 'shopmagic-for-woocommerce' );
		$columns[ self::OPTOUT_COLUMN_KEY ] = __( 'Opt-outs', 'shopmagic-for-woocommerce' );

		// we want to add date at the end of the indexed associated array
		$columns[ self::DATE_COLUMN_KEY ] = $date;

		return $columns;
	}

	/**
	 * Makes 'Event' column sortable
	 *
	 * @param array $columns
	 *
	 * @return array sortable columns
	 */
	public function set_sortable_columns( $columns ) {
		return $columns;
	}

	/**
	 * Adds 'Event' column content to 'Automations' page
	 *
	 * @param string $column name of column being displayed
	 * @param int $post_id post ID in the row
	 */
	public function display_columns_content( $column, $post_id ) {
		global $wpdb;
		static $simple_cache = [];
		if ( isset( $simple_cache[ $post_id ] ) ) {
			$item = $simple_cache[ $post_id ];
		} else {
			$repository = new CommunicationListRepository( $wpdb );
			$item       = $simple_cache[ $post_id ] = $repository->get_by_id_for_table( $post_id );
		}

		switch ( $column ) {
			case self::TYPE_COLUMN_KEY:
				echo $item->get_type_name();
				break;
			case self::OPTIN_COLUMN_KEY:
				echo $item->get_optin_count();
				break;
			case self::OPTOUT_COLUMN_KEY:
				echo $item->get_optout_count();
				break;
		}
	}

	/**
	 * @inheritDoc
	 */
	public function hooks() {
		add_action( 'init', [ $this, 'setup_post_type' ] );
		add_filter( 'manage_' . self::TYPE . '_posts_columns', array( $this, 'set_column_headers' ) );
		add_filter( 'manage_edit-' . self::TYPE . '_sortable_columns', array( $this, 'set_sortable_columns' ) );
		add_action( 'manage_' . self::TYPE . '_posts_custom_column', array( $this, 'display_columns_content' ), 10, 2 );
	}
}
