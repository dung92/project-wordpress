<?php

namespace WPDesk\ShopMagic\Admin\Guest;

use WPDesk\ShopMagic\Guest\Guest;
use WPDesk\ShopMagic\Guest\GuestDAO;
use WPDesk\ShopMagic\Helper\WordPressFormatHelper;

/**
 * WordPress WP_List_Table for guest list.
 *
 * @package WPDesk\ShopMagic\Admin\CommunicationType
 */
final class TableList extends \WP_List_Table {
	public function __construct() {
		parent::__construct(
			array(
				'singular' => 'guest',
				'plural'   => 'guests',
				'ajax'     => false,
			)
		);
	}

	/**
	 * Prepare table list items.
	 *
	 * @global \wpdb $wpdb
	 */
	public function prepare_items() {
		global $wpdb;
		$repository = new GuestDAO( $wpdb );

		$this->prepare_column_headers();
		$items_per_page = $this->get_items_per_page( 'guest_items_per_page', 20 );
		$current_page   = $this->get_pagenum();
		if ( 1 < $current_page ) {
			$offset = $items_per_page * ( $current_page - 1 );
		} else {
			$offset = 0;
		}

		$date_order = ( isset( $_GET['order'] ) && $_GET['order'] === 'asc' ) ? 'ASC' : 'DESC';
		$order_by   = ( isset( $_GET['orderby'] ) ) ? $_GET['orderby'] : 'updated';

		$this->items = $repository->get_all( [ $order_by => $date_order ], $items_per_page, $offset );
		$total_items = $repository->get_count();

		$this->set_pagination_args(
			array(
				'total_items'    => $total_items,
				'items_per_page' => $items_per_page,
				'total_pages'    => ceil( $total_items / $items_per_page ),
			)
		);
	}

	/**
	 * Set _column_headers property for table list
	 */
	private function prepare_column_headers() {
		$this->_column_headers = array(
			$this->get_columns(),
			array(),
			$this->get_sortable_columns(),
		);
	}

	/**
	 * Get list columns.
	 *
	 * @return string[]
	 */
	public function get_columns() {
		return array(
			'id'      => __( 'ID', 'shopmagic-for-woocommerce' ),
			'email'   => __( 'E-mail', 'shopmagic-for-woocommerce' ),
			'updated' => __( 'Last active', 'shopmagic-for-woocommerce' ),
			'created' => __( 'Created', 'shopmagic-for-woocommerce' ),
			'options' => __( 'Options', 'shopmagic-for-woocommerce' ),
		);
	}

	/**
	 * Get a list of sortable columns.
	 *
	 * @return array
	 */
	protected function get_sortable_columns() {
		return array(
			'email'   => array( 'email', false ),
			'updated' => array( 'updated', false )
		);
	}

	/**
	 * @param Guest $guest
	 *
	 * @return string
	 *
	 * @internal
	 */
	protected function column_id( $guest ) {
		return sprintf( '#%s', esc_html( $guest->get_id() ) );
	}

	/**
	 * @param Guest $guest
	 *
	 * @return string
	 *
	 * @internal
	 */
	protected function column_email( $guest ) {

		return sprintf( '<a href="mailto:%s">%s</a>', $guest->get_email(), $guest->get_email() );
	}

	/**
	 * @param Guest $guest
	 *
	 * @return string
	 *
	 * @internal
	 */
	protected function column_created( $guest ) {
		$timestamp = $guest->get_created();
		if ( $timestamp instanceof \DateTimeInterface ) {
			return $this->render_timestamp( $timestamp );
		}

		return '';
	}

	/**
	 * @param \DateTimeInterface $timestamp
	 *
	 * @return string
	 */
	private function render_timestamp( \DateTimeInterface $timestamp ) {
		$timestamp_format = 'Y-m-d H:i:s';
		$timestamp_format = apply_filters( 'shopmagic/core/guest/timestamp_format', $timestamp_format );

		return WordPressFormatHelper::format_wp_datetime( $timestamp, $timestamp_format );
	}

	/**
	 * @param Guest $guest
	 *
	 * @return string
	 *
	 * @internal
	 */
	protected function column_updated( $guest ) {
		$timestamp = $guest->get_updated();
		if ( $timestamp instanceof \DateTimeInterface ) {
			return $this->render_timestamp( $timestamp );
		}

		return '';
	}


	/**
	 * @param Guest $guest
	 *
	 * @return string
	 *
	 * @internal
	 */
	protected function column_options( $guest ) {
		return sprintf( '<a href="%s">View</a>', SingleGuest::get_url( $guest ) );
	}

	/**
	 * Get a list of CSS classes for the WP_List_Table table tag.
	 *
	 * @return string[] Array of CSS classes for the table tag.
	 */
	public function get_table_classes() {
		return array( 'widefat', 'striped', $this->_args['plural'] );
	}
}
