<?php

namespace WPDesk\ShopMagic\Admin\Outcome;

use ShopMagicVendor\WPDesk\Forms\Field\SubmitField;
use ShopMagicVendor\WPDesk\Forms\Form;
use ShopMagicVendor\WPDesk\Forms\Resolver\DefaultFormFieldResolver;
use ShopMagicVendor\WPDesk\View\Renderer\SimplePhpRenderer;
use ShopMagicVendor\WPDesk\View\Resolver\ChainResolver;
use ShopMagicVendor\WPDesk\View\Resolver\DirResolver;
use WPDesk\ShopMagic\Admin\SelectAjaxField\AutomationSelectAjax;
use WPDesk\ShopMagic\Admin\SelectAjaxField\CustomerSelectAjax;
use WPDesk\ShopMagic\AutomationOutcome\OutcomeInTable;
use WPDesk\ShopMagic\AutomationOutcome\OutcomeReposistory;
use WPDesk\ShopMagic\Customer\Customer;
use WPDesk\ShopMagic\Helper\WordPressFormatHelper;
use WPDesk\ShopMagic\LoggerFactory;

/**
 * WordPress WP_List_Table for outcome list.
 *
 * @package WPDesk\ShopMagic\Admin\CommunicationType
 */
final class TableList extends \WP_List_Table {
	/** @var Form\FormWithFields */
	private $form_filter;

	public function __construct() {
		parent::__construct(
			[
				'singular' => 'outcome',
				'plural'   => 'outcomes',
				'ajax'     => false,
			]
		);
		$this->form_filter = new Form\FormWithFields( [
			( new AutomationSelectAjax() )
				->set_name( 'automation_id' ),
			( new CustomerSelectAjax() )
				->set_name( 'customer_id' ),
			( new SubmitField() )
				->set_name( 'submit' )
				->add_class( 'button' )
				->set_label( __( 'Filter', 'shopmagic-for-woocommerce' ) ),
		], 'form_filter' );
	}

	/**
	 * Prepare table list items.
	 *
	 * @global \wpdb $wpdb
	 */
	public function prepare_items() {
		global $wpdb;
		$repository = new OutcomeReposistory( $wpdb );

		if ( isset( $_GET[ $this->form_filter->get_form_id() ] ) ) {
			$this->form_filter->handle_request( $_GET[ $this->form_filter->get_form_id() ] );
			$filters = array_filter( $this->form_filter->get_data() );
		} else {
			$filters = [];
		}

		$this->prepare_column_headers();
		$items_per_page = $this->get_items_per_page( 'optins_items_per_page', 20 );
		$current_page   = $this->get_pagenum();
		if ( 1 < $current_page ) {
			$offset = $items_per_page * ( $current_page - 1 );
		} else {
			$offset = 0;
		}

		$date_order = ( isset( $_GET['order'] ) && $_GET['order'] === 'asc' ) ? 'ASC' : 'DESC';

		$this->items = $repository->get_all( $filters, [ 'updated' => $date_order ], $items_per_page, $offset );
		$total_items = $repository->get_count( $filters );

		$this->set_pagination_args(
			[
				'total_items'    => $total_items,
				'items_per_page' => $items_per_page,
				'total_pages'    => ceil( $total_items / $items_per_page ),
			]
		);
	}

	/**
	 * Set _column_headers property for table list
	 */
	private function prepare_column_headers() {
		$this->_column_headers = [
			$this->get_columns(),
			[],
			$this->get_sortable_columns(),
		];
	}

	/**
	 * Get list columns.
	 *
	 * @return string[]
	 */
	public function get_columns() {
		return [
			'id'         => __( 'ID', 'shopmagic-for-woocommerce' ),
			'status'     => __( 'Status', 'shopmagic-for-woocommerce' ),
			'automation' => __( 'Automation', 'shopmagic-for-woocommerce' ),
			'customer'   => __( 'Customer', 'shopmagic-for-woocommerce' ),
			'action'     => __( 'Action', 'shopmagic-for-woocommerce' ),
			'timestamp'  => __( 'Date', 'shopmagic-for-woocommerce' ),
			'options'    => __( 'Options', 'shopmagic-for-woocommerce' ),

		];
	}

	/**
	 * @param OutcomeInTable $outcome
	 *
	 * @return string
	 *
	 * @internal
	 */
	protected function column_options( OutcomeInTable $outcome ): string {
		if ( $outcome->has_logs() ) {
			return sprintf( __( '<a href="%s">View logs</a>', 'shopmagic-for-woocommerce' ), SingleOutcome::get_url( $outcome ) );
		}

		return '';
	}

	/**
	 * Get a list of sortable columns.
	 *
	 * @return array
	 */
	protected function get_sortable_columns() {
		return [
			'timestamp' => [ 'timestamp', false ]
		];
	}

	/**
	 * @param OutcomeInTable $outcome
	 *
	 * @return string
	 */
	protected function column_automation( $outcome ) {
		$url = get_edit_post_link( $outcome->get_automation_id() );

		return sprintf( '<a href="%s">%s</a>', esc_url( $url ), esc_html( $outcome->get_automation_name() ) );
	}

	/**
	 * @param Customer $customer
	 *
	 * @return string
	 */
	public static function render_customer_column( Customer $customer ) {
		if ( $customer->get_email() === '' && $customer->is_guest() ) {
			return __( 'No customer has been provided', 'shopmagic-for-woocommerce' );
		}

		try {
			if ( $customer->is_guest() ) {
				return sprintf( __( 'Guest:', 'shopmagic-for-woocommerce' ) . ' %s <a href="mailto:%s">%s</a>',
					esc_html( $customer->get_full_name() ),
					esc_attr( $customer->get_email() ),
					esc_html( $customer->get_email() )
				);
			}

			return sprintf( '<a href="%s">%s</a> <a href="mailto:%s">%s</a>',
				esc_url( get_edit_user_link( $customer->get_id() ) ),
				esc_html( $customer->get_full_name() ),
				esc_attr( $customer->get_email() ),
				esc_html( $customer->get_email() )
			);
		} catch ( \Throwable $e ) {
			LoggerFactory::get_logger()->error( 'Error in ' . __CLASS__ . '::' . __METHOD__, [ 'exception' => $e ] );

			return __( 'Invalid customer', 'shopmagic-for-woocommerce' );
		}
	}


	/**
	 * @param OutcomeInTable $outcome
	 *
	 * @return string
	 */
	protected
	function column_customer(
		$outcome
	) {
		$customer = $outcome->get_customer();
		if ( $customer instanceof Customer ) {
			return self::render_customer_column( $customer );
		}

		// fallback - when guest conversion is in progress
		return sprintf( '<a href="mailto:%s">%s</a>',
			esc_attr( $outcome->get_customer_email() ),
			esc_html( $outcome->get_customer_email() )
		);
	}

	/**
	 * @param OutcomeInTable $outcome
	 *
	 * @return string
	 */
	protected
	function column_action(
		$outcome
	) {
		return sprintf( '%s', esc_html( $outcome->get_action_name() ) );
	}

	/**
	 * @param OutcomeInTable $outcome
	 *
	 * @return string
	 */
	protected
	function column_id(
		$outcome
	) {
		return sprintf( '#%s', esc_html( $outcome->get_execution_id() ) );
	}

	/**
	 * @param OutcomeInTable $outcome
	 *
	 * @return string
	 */
	protected
	function column_status(
		$outcome
	) {
		$success = $outcome->get_success();

		switch ( $success ) {
			case true:
				$status_name        = __( 'Completed', 'shopmagic-for-woocommerce' );
				$status_description = __( 'Successfully finished.', 'shopmagic-for-woocommerce' );
				$status_class       = 'completed';
				break;
			case null:
				$status_name        = __( 'Unknown', 'shopmagic-for-woocommerce' );
				$status_description = __( 'Finished but there is no info about success or failure.', 'shopmagic-for-woocommerce' );
				$status_class       = 'unknown';
				break;
			default:
				$status_name        = __( 'Failed', 'shopmagic-for-woocommerce' );
				$status_description = __( 'There was an error with executing this action.', 'shopmagic-for-woocommerce' );
				$status_class       = 'failed';
		}

		return sprintf( '<mark class="outcome-status status-%s tips" data-tip="%s"><span>%s</span></mark>', $status_class, $status_description, $status_name );
	}

	/**
	 * @param OutcomeInTable $outcome
	 *
	 * @return string
	 */
	protected
	function column_timestamp(
		$outcome
	) {
		$timestamp = $outcome->get_update_date();
		if ( $timestamp instanceof \DateTimeInterface ) {
			$timestamp_format = 'Y-m-d H:i:s';
			$timestamp_format = apply_filters( 'shopmagic/core/outcomes/timestamp_format', $timestamp_format );

			return WordPressFormatHelper::format_wp_datetime( $timestamp, $timestamp_format );
		}

		return '';
	}

	/**
	 * Extra controls to be displayed between bulk actions and pagination
	 *
	 * @param string $which
	 */
	protected
	function extra_tablenav(
		$which
	) {
		if ( 'top' === $which ) {
			$renderer = new SimplePhpRenderer( new ChainResolver(
					new DirResolver( __DIR__ . '/templates' ),
					new DefaultFormFieldResolver(),
					new DirResolver( __DIR__ . '/../SelectAjaxField/templates' ) )
			);

			echo $this->form_filter->render_fields( $renderer );
		}
	}

	/**
	 * Get a list of CSS classes for the WP_List_Table table tag.
	 *
	 * @return string[] Array of CSS classes for the table tag.
	 */
	public
	function get_table_classes() {
		return [ 'widefat', 'striped', $this->_args['plural'] ];
	}
}
