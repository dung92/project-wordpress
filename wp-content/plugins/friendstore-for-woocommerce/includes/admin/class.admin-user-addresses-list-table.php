<?php
if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class FoW_Admin_User_Addresses_List_Table extends WP_List_Table {
	public $user;

	/**
	 * Create and instance of this list table.
	 * @param WP_User $user
	 */
	public function __construct( $user ) {
		$this->user = $user;
		parent::__construct( array(
			'singular'  => 'address',
			'plural'    => 'addresses',
			'ajax'      => false,
		) );
	}

	/**
	 * List of columns
	 * @return array
	 */
	public function get_columns() {
		return array(
			'address'   => wcl10n__( 'Address', 'woocommerce' ),
		);
	}

	/**
	 * List of sortable columns
	 * @return array
	 */
	public function get_sortable_columns() {
		return array();
	}

	public function prepare_items() {
		$columns    = $this->get_columns();
		$hidden     = array();

		$sortable   = $this->get_sortable_columns();
		$this->_column_headers = array( $columns, $hidden, $sortable );
		$addresses  = FoW()->address_book->get_user_addresses( $this->user, false );
		$items      = array();

		foreach ( $addresses as $index => $address ) {
			$items[] = array( 'index' => $index, 'address' => $address );
		}

		$this->items = $items;
	}

	public function column_address( $item ) {
		$out = '<div class="address">' . fsw_get_formatted_address( $item['address'] ) . '</div>';

		// Get actions
		$actions = array(
			'edit'  => '<a class="edit-address" data-index="' . $item['index'] . '" title="' . esc_attr( wcl10n__( 'Edit' ) ) . '" href="#">' . wcl10n__( 'Edit' ) . '</a>',
			'trash' => '<a class="submitdelete" title="' . esc_attr( wcl10n__( 'Delete' ) ) . '" href="admin-post.php?action=fsw_delete_address&index=' . $item['index'] . '&user_id=' . $this->user->ID . '&_wpnonce=' . wp_create_nonce( 'delete_shipping_address' ) . '">' . wcl10n__( 'Delete' ) . '</a>',
		);

		$row_actions = array();

		$i=0;
		foreach ( $actions as $action => $link ) {
			$row_actions[] = '<span class="' . esc_attr( $action ) . '">' . $link . ($i==0 ? ' | ' : '') . '</span>';
			$i++;
		}

		$out .= '<div class="row-actions">' . implode( '', $row_actions ) . '</div>';

		return $out;
	}

	public function single_row( $item ) {
		$address    = $item['address'];
		$fields     = WC()->countries->get_address_fields( $address['shipping_country'], 'shipping_' );

		// Add filter Shipping fields in Profile
		$fields = apply_filters('fsw_profile_shipping_fields', FoW_Ultility::get_address_fields('shipping', $fields));
		if(isset($address['shipping_state'])) $fields['shipping_city']['options'] = FoW_Ultility::get_districts_array_by_city_id($address['shipping_state']);
		if(isset($address['shipping_city'])) $fields['shipping_address_2']['options'] = FoW_Ultility::get_wards_array_by_district_id($address['shipping_city']);

		?>
		<tr id="address-<?php echo $item['index']; ?>">
			<?php $this->single_row_columns( $item ); ?>
		</tr>
		<tr></tr>
		<tr style="display: none;" class="address-form fsw-address-form" id="address-form-<?php echo $item['index']; ?>" data-index="<?php echo $item['index']; ?>">
			<td>
				<div class="address-column">
				<?php
				foreach ( $fields as $key => $field ) {
					$val = ( isset( $address[ $key ] ) ) ? $address[ $key ] : '';

					if ( empty( $val ) && ! empty( $_GET[ $key ] ) ) {
						$val = $_GET[ $key ];
					}

					echo woocommerce_form_field( $key, $field, $val );
				}
				?>
				</div>

				<p class="submit">
					<input type="button" class="button btn-cancel" value="<?php wcl10n_e( 'Cancel', '', 'attr' ); ?>" />
					<input type="button" class="button button-primary btn-save" value="<?php wcl10n_e( 'Save address', 'woocommerce', 'attr' ); ?>" />
                    <span class="spinner" style="float: none; margin-top: 0;"></span>
				</p>
			</td>
		</tr>
		<?php
	}

	public function display_tablenav( $which ) {}
}
