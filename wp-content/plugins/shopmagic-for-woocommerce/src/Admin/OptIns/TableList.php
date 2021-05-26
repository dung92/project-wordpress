<?php

namespace WPDesk\ShopMagic\Admin\OptIns;

use WPDesk\ShopMagic\Optin\EmailOptModel;
use WPDesk\ShopMagic\Optin\EmailOptRepository;
use WPDesk\ShopMagic\Optin\OptInModel;
use WPDesk\ShopMagic\Optin\OptOutModel;

/**
 * WordPress WP_List_Table for optins list.
 *
 * @package WPDesk\ShopMagic\Admin\CommunicationType
 */
final class TableList extends \WP_List_Table {

	public function __construct() {
		parent::__construct(
			array(
				'singular' => 'optin',
				'plural'   => 'optins',
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
		$repository = new EmailOptRepository( $wpdb );

		$this->prepare_column_headers();
		$items_per_page = $this->get_items_per_page( 'optins_items_per_page', 10 );
		$current_page   = $this->get_pagenum();
		if ( 1 < $current_page ) {
			$offset = $items_per_page * ( $current_page - 1 );
		} else {
			$offset = 0;
		}
		if ( ! empty( $_POST['s'] ) ) {
			$where = [ [ 'field' => 'p1.email', 'condition' => 'LIKE', 'value' => '%' . $_POST['s'] . '%' ] ];
		} else {
			$where = [];
		}

		$email_order = ( isset( $_GET['order'] ) && $_GET['order'] === 'asc' ) ? 'ASC' : 'DESC';

		$this->items = $repository->get_all( $where, [ 'p1.email' => $email_order ], $items_per_page, $offset );
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
//			'cb'     => '<input type="checkbox" />',
			'email'  => __( 'E-mail', 'shopmagic-for-woocommerce' ),
			'optin'  => __( 'Opt-ins', 'shopmagic-for-woocommerce' ),
			'optout' => __( 'Out-outs', 'shopmagic-for-woocommerce' ),
		);
	}

	/**
	 * Get a list of sortable columns.
	 *
	 * @return array
	 */
	protected function get_sortable_columns() {
		return array(
			'email' => array( 'email', true )
		);
	}

	/**
	 * @param EmailOptModel $email
	 *
	 * @return string
	 */
	protected function column_cb( $email ) {
		return sprintf( '<input type="checkbox" name="email[]" value="%1$s" />', esc_attr( $email->get_email() ) );
	}

	/**
	 * @param EmailOptModel $email
	 *
	 * @return string
	 */
	protected function column_email( $email ) {
		return sprintf( '<a href="mailto: %s">%s</a>', esc_attr( $email->get_email() ), esc_html( $email->get_email() ) );
	}

	/**
	 * @param EmailOptModel $email
	 *
	 * @return string
	 */
	protected function column_optin( $email ) {
		return implode( "<br/>", array_map( function ( $optin ) {
			/** @var OptInModel $optin */
			return "{$optin->get_list_name()} {$optin->get_created_as_string()}";
		}, $email->get_optins() ) );
	}

	/**
	 * @param EmailOptModel $email
	 *
	 * @return string
	 */
	protected function column_optout( $email ) {
		return implode( "<br/>", array_map( function ( $optout ) {
			/** @var OptOutModel $optout */
			return "{$optout->get_list_name()} {$optout->get_created_as_string()}";
		}, $email->get_optouts() ) );
	}
}
