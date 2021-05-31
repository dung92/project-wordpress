<?php
/**
 * Copyright (c) VietFriend, Inc. and its affiliates. All Rights Reserved
 *
 * This source code is licensed under the license found in the
 * LICENSE file in the root directory of this source tree.
 *
 * @package FriendStore for WooCommerce
 */

defined('ABSPATH') || exit;

if (!class_exists('FoW_AddressBook')) {
	class FoW_AddressBook {
        private $country;

		public function __construct() {
            add_action( 'init', array( $this, 'addresses_checkout' ) );
            add_action( 'init', array( $this, 'addresses_my_account' ) );
            add_action( 'init', array( $this, 'addresses_user_profile' ) );

			add_action( 'template_redirect', array( $this, 'delete_address' ) );
			add_action( 'template_redirect', array( $this, 'save_addresses' ) );
			add_action( 'template_redirect', array( $this, 'save_addresses_book_from_post' ) );
			add_action( 'template_redirect', array( $this, 'address_book' ) );
		}

        public function is_enabled(){
            return apply_filters( 'fsw_user_addresses_enabled', true );
        }

        public function array_sort($array, $on, $order=SORT_DESC) {
            $new_array = array();
            $sortable_array = array();

            if (count($array) > 0) {
                foreach ($array as $k => $v) {
                    if (is_array($v)) {
                        foreach ($v as $k2 => $v2) {
                            if ($k2 == $on) {
                                $sortable_array[$k] = $v2;
                            }
                        }
                    } else {
                        $sortable_array[$k] = $v;
                    }
                }

                switch ($order) {
                    case SORT_ASC:
                        asort( $sortable_array, SORT_NATURAL | SORT_FLAG_CASE );
                        break;
                    case SORT_DESC:
                        arsort( $sortable_array, SORT_NATURAL | SORT_FLAG_CASE  );
                        break;
                }

                foreach ($sortable_array as $k => $v) {
                    $new_array[$k] = $array[$k];
                }
            }

            return $new_array;
        }

        public function unique_address_key( $address ) {
            if ( empty( $address ) || ! is_array( $address ) ) {
                return false;
            }

            return md5( implode( '_', $address ) );
        }

        public function get_address_country() {
            if ( ! empty( $this->country ) ) {
                return $this->country;
            }

            $user = wp_get_current_user();
            $addresses = FoW()->address_book->get_user_addresses( $user, false );

            $address = get_query_var( 'edit-address' );
            $parts = explode( '_', $address );
            $index = $parts[2];

            if ( isset( $addresses[ $index ] ) && ! empty( $addresses[ $index ]['shipping_country'] ) ) {
                $this->country = $addresses[ $index ]['shipping_country'];
                return $this->country;
            }

            return false;
        }

        public function get_user_addresses( $user, $include_default = true ) {
            if ( ! self::is_enabled() ) return;
            if (! $user instanceof WP_User ) {
                $user = new WP_User( $user );
            }

            if ($user->ID != 0) {
                $addresses = get_user_meta($user->ID, 'fsw_other_addresses', true);

                if (! $addresses) {
                    $addresses = array();
                }

                if ( $include_default ) {
                    $default_address = $this->get_user_default_address( $user->ID );

                    if ( $default_address['address_1'] && $default_address['postcode'] ) {
                        $addresses += array( $default_address );
                    }
                }
            } else {
                // guest address - using sessions to store the address
                $addresses = ( fsw_session_isset('user_addresses') ) ? fsw_session_get('user_addresses') : array();
            }

            return $this->array_sort( $addresses, 'shipping_first_name' );
        }

		public function get_user_default_address( $user_id ) {
            if ( ! self::is_enabled() ) return;
			$default_address = array(
				'shipping_first_name' 	=> get_user_meta( $user_id, 'shipping_first_name', true ),
				'shipping_last_name'	=> get_user_meta( $user_id, 'shipping_last_name', true ),
				'shipping_company'		=> get_user_meta( $user_id, 'shipping_company', true ),
				'shipping_address_1'	=> get_user_meta( $user_id, 'shipping_address_1', true ),
				'shipping_address_2'	=> get_user_meta( $user_id, 'shipping_address_2', true ),
				'shipping_city'			=> get_user_meta( $user_id, 'shipping_city', true ),
				'shipping_state'		=> get_user_meta( $user_id, 'shipping_state', true ),
				'shipping_postcode'		=> get_user_meta( $user_id, 'shipping_postcode', true ),
				'shipping_country'		=> get_user_meta( $user_id, 'shipping_country', true ),
				'default_address'       => true
			);

			// backwards compatibility
			$default_address['first_name'] 	= $default_address['shipping_first_name'];
			$default_address['last_name']	= $default_address['shipping_last_name'];
			$default_address['company']		= $default_address['shipping_company'];
			$default_address['address_1']	= $default_address['shipping_address_1'];
			$default_address['address_2']	= $default_address['shipping_address_2'];
			$default_address['city']		= $default_address['shipping_city'];
			$default_address['state']		= $default_address['shipping_state'];
			$default_address['postcode']	= $default_address['shipping_postcode'];
			$default_address['country']     = $default_address['shipping_country'];

			return apply_filters( 'wc_ms_default_user_address', $default_address );
		}

        public function address_book() {
            if ( ! self::is_enabled() ) return;
            $user = wp_get_current_user();

            if ($user->ID == 0) {
                return;
            }

            if (isset($_GET['addressbook']) && $_GET['addressbook'] == 1) {
                $addresses = get_user_meta($user->ID, 'fsw_other_addresses', true);
                ?>
                <p></p>
                <h2><?php _e( 'Address Book', 'friendstore-for-woocommerce' ); ?></h2>
                <?php
                if (!empty($addresses)):
                    foreach ($addresses as $addr) {
                        if ( empty($addr) ) continue;

                        echo '<div style="float: left; width: 200px;">';
                        $address = array(
                            'first_name'    => $addr['shipping_first_name'],
                            'last_name'     => $addr['shipping_last_name'],
                            'company'       => $addr['shipping_company'],
                            'address_1'     => $addr['shipping_address_1'],
                            'address_2'     => $addr['shipping_address_2'],
                            'city'          => $addr['shipping_city'],
                            'state'         => $addr['shipping_state'],
                            'postcode'      => $addr['shipping_postcode'],
                            'country'       => $addr['shipping_country']
                        );
                        $formatted_address  = fsw_get_formatted_address( $address );
                        $json_address       = wp_json_encode( $address );

                        if (!$formatted_address) _e( 'You have not set up a shipping address yet.', 'friendstore-for-woocommerce' ); else echo '<address>'.$formatted_address.'</address>';
                        echo '  <textarea style="display:none;">'. $json_address .'</textarea>';
                        echo '  <p><button type="button" class="button address-use">'. __( 'Use this address', 'friendstore-for-woocommerce' ) .'</button></p>';
                        echo '</div>';
                    }
                    echo '<div class="clear: both;"></div>';
                else:
                    echo '<h4>'. __( 'You have no shipping addresses saved.', 'friendstore-for-woocommerce' ) .'</h4>';
                endif;
                ?>
                <script type="text/javascript">
                    jQuery(document).ready(function() {
                        jQuery( '.address-use' ).click(function() {
                            var address = jQuery.parseJSON(jQuery(this).parents( 'p' ).prev( 'textarea' ).val());
                            jQuery(this).prop( 'disabled', true);

                            setAddress(address, '<?php echo $_GET['sig']; ?>' );
                            tb_remove();
                        });
                    });
                </script>
                <?php
                exit;
            }
        }

		public function delete_address() {
            if ( ! self::is_enabled() ) return;

			$user = wp_get_current_user();

			if ( isset($_REQUEST['address-delete']) && isset($_REQUEST['id']) ) {
				$id         = $_REQUEST['id'];
				$addresses  = $this->get_user_addresses( $user );

				if ($user->ID != 0) {
					$addresses = get_user_meta($user->ID, 'fsw_other_addresses', true);

					if (! $addresses) {
						$addresses = array();
					}

					$default_address = $this->get_user_default_address( $user->ID );

					if ( $default_address['address_1'] && $default_address['postcode'] ) {
						array_unshift($addresses, $default_address);
					}

					if ( $id == 0 ) {
						$default_address = $addresses[0];

						if ( $default_address['shipping_address_1'] && $default_address['shipping_postcode'] ) {
							update_user_meta( $user->ID, 'shipping_first_name', '' );
							update_user_meta( $user->ID, 'shipping_last_name',  '' );
							update_user_meta( $user->ID, 'shipping_company',    '' );
							update_user_meta( $user->ID, 'shipping_address_1',  '' );
							update_user_meta( $user->ID, 'shipping_address_2',  '' );
							update_user_meta( $user->ID, 'shipping_city',       '' );
							update_user_meta( $user->ID, 'shipping_state',      '' );
							update_user_meta( $user->ID, 'shipping_postcode',   '' );
							update_user_meta( $user->ID, 'shipping_country',    '' );
						}
					} else {
						unset( $addresses[ $id ] );
					}

					unset( $addresses[0] );

					update_user_meta($user->ID, 'fsw_other_addresses', $addresses);

				} else {
					// guests
					unset( $addresses[ $id ] );
					fsw_session_set( 'user_addresses', $addresses );

				}

				if ( function_exists('wc_add_notice') )
					wc_add_notice( __('Address deleted successfully.', 'friendstore-for-woocommerce'), 'success');
				else
					WC()->add_message( __('Address deleted successfully.', 'friendstore-for-woocommerce') );

				wp_redirect( get_permalink( wc_get_page_id('multiple_addresses') ) );
				exit;

			}
		}

		public function save_addresses() {
            if ( ! self::is_enabled() ) return;

			if (isset($_POST['shipping_address_action']) && $_POST['shipping_address_action'] == 'save' ) {
				/* @var $cart WC_Cart */
				$cart       = WC()->cart;
				$checkout   = WC()->checkout;

				$user_addresses = $this->get_user_addresses( get_current_user_id() );

				$fields = WC()->countries->get_address_fields( WC()->countries->get_base_country(), 'shipping_' );

				$cart->get_cart_from_session();
				$cart_items = fsw_get_real_cart_items();

				$data   = array();
				$rel    = array();

				if ( isset($_POST['items']) ) {

					$items = $_POST['items'];

					// handler for delete requests
					if ( isset($_POST['delete_line']) ) {
						$delete     = $_POST['delete'];
						$cart_key   = $delete['key'];
						$index      = $delete['index'];

						// trim the quantity by 1 and remove the corresponding address
						$cart_items = fsw_get_real_cart_items();
						$item_qty   = $cart_items[$cart_key]['quantity'] - 1;
						$cart->set_quantity( $cart_key, $item_qty );

						if ( isset($items[$cart_key]['qty'][$index]) ) {
							unset( $items[$cart_key]['qty'][$index] );
						}

						if ( isset($items[$cart_key]['address'][$index]) ) {
							unset( $items[$cart_key]['address'][$index] );
						}
					}

					// handler for quantities update
					foreach ( $items as $cart_key => $item ) {
						$qtys           = $item['qty'];
						$item_addresses = $item['address'];

						foreach ( $item_addresses as $idx => $item_address ) {
							$cart_items     = fsw_get_real_cart_items();
							$new_qty        = false;

							if ( $qtys[ $idx ] == 0 ) {
								// decrement the cart item quantity by one
								$current_qty = $cart_items[ $cart_key ]['quantity'];
								$new_qty        = $current_qty - 1;
								$cart->set_quantity( $cart_key, $new_qty );
							} elseif ( $qtys[ $idx ] > 1 ) {
								$qty_to_add = $qtys[$idx] - 1;
								$item_qty   = $cart_items[$cart_key]['quantity'];
								$new_qty    = $item_qty + $qty_to_add;
								$cart->set_quantity( $cart_key, $new_qty );
							}

						}

					}

					$cart_items = fsw_get_real_cart_items();
					foreach ( $items as $cart_key => $item ) {
						$qtys           = $item['qty'];
						$item_addresses = $item['address'];

						$product_id = $cart_items[$cart_key]['product_id'];
						$sig        = $cart_key .'_'. $product_id .'_';
						$_sig       = '';

						foreach ( $item_addresses as $idx => $item_address ) {
							$address_id = $item_address;
							$user_address = $user_addresses[ $address_id ];

							$i = 1;
							for ( $x = 0; $x < $qtys[$idx]; $x++ ) {

								$rel[ $address_id ][]  = $cart_key;

								while ( isset($data['shipping_first_name_'. $sig . $i]) ) {
									$i++;
								}
								$_sig = $sig . $i;

								if ( $fields ) foreach ( $fields as $key => $field ) :
									$data[$key .'_'. $_sig] = $user_address[ $key ];
								endforeach;
							}

						}

						$cart_address_ids_session = (array)fsw_session_get( 'cart_address_ids' );

						if ( !empty($_sig) && !fsw_session_isset( 'cart_address_ids' ) || ! in_array($_sig, $cart_address_ids_session) ) {
							$cart_address_sigs_session = fsw_session_get( 'cart_address_sigs' );
							$cart_address_sigs_session[$_sig] = $address_id;
							fsw_session_set( 'cart_address_sigs', $cart_address_sigs_session);
						}

					}

				}

				fsw_session_set( 'cart_item_addresses', $data );
				fsw_session_set( 'address_relationships', $rel );
				fsw_session_set( 'fsw_item_addresses', $rel );

				if ( isset($_POST['update_quantities']) || isset($_POST['delete_line']) ) {
					$next_url = get_permalink( wc_get_page_id( 'multiple_addresses' ) );
				} else {
					// redirect to the checkout page
					$next_url = wc_get_checkout_url();
				}

				$this->wcms->clear_packages_cache();

				wp_redirect($next_url);
				exit;
			} elseif (isset($_POST['shipping_account_address_action']) && $_POST['shipping_account_address_action'] == 'save' ) {
				$user   = wp_get_current_user();
				$idx    = $_POST['idx'];

				$addresses = get_user_meta( $user->ID, 'fsw_other_addresses', true );

				if ( !is_array( $addresses ) ) {
					$addresses = array();
				}

				if ( $idx == -1 ) {
					$idx = count( $addresses );

					while ( array_key_exists( $idx, $addresses ) ) {
						$idx++;
					}
				}

				unset($_POST['shipping_account_address_action'], $_POST['set_addresses'], $_POST['idx']);

				foreach ($_POST as $key => $value) {
					$addresses[ $idx ][ $key ] = $value;
				}


				update_user_meta( $user->ID, 'fsw_other_addresses', $addresses );

				if ( function_exists('wc_add_notice') )
					wc_add_notice( __( 'Address saved successfully.', 'friendstore-for-woocommerce' ), 'success' );
				else
					WC()->add_message(__( 'Address saved successfully.', 'friendstore-for-woocommerce' ) );

				$page_id = wc_get_page_id( 'myaccount' );
				wp_redirect(get_permalink($page_id));
				exit;
			}
		}

		public function save_addresses_book_from_post() {
            if ( ! self::is_enabled() ) return;

			if ( !empty( $_POST['action'] ) && $_POST['action'] == 'save_to_address_book' ) {

				$user       = wp_get_current_user();
				$id         = $_POST['id'];
				$address    = $_POST['address'];
				$addresses  = $this->get_user_addresses( $user );
				$shipFields = WC()->countries->get_address_fields( $address['shipping_country'], 'shipping_' );
				$errors     = array();
				$redirect_url   = (isset($_POST['next'])) ? $_POST['next'] : get_permalink( wc_get_page_id('multiple_addresses') );

				foreach ( $shipFields as $key => $field ) {

					if ( isset($field['required']) && $field['required'] && empty($address[$key]) ) {
						if ( 'shipping_state' == $key && empty( WC()->countries->get_states( $address['shipping_country'] ) ) ) {
							continue;
						}

						$errors[] = $key;
					}

					if (! empty($address[$key]) ) {

						// Validation rules
						if ( ! empty( $field['validate'] ) && is_array( $field['validate'] ) ) {
							foreach ( $field['validate'] as $rule ) {
								switch ( $rule ) {
									case 'postcode' :
										$address[ $key ] = trim( $address[ $key ] );

										if ( ! WC_Validation::is_postcode( $address[ $key ], $address[ 'shipping_country' ] ) ) :
											$errors[] = $key;
											wc_add_notice( wcl10n__( 'Please enter a valid postcode / ZIP.', 'woocommerce' ), 'error' );
										else :
											$address[ $key ] = wc_format_postcode( $address[ $key ], $address[ 'shipping_country' ] );
										endif;
										break;
									case 'phone' :
										$address[ $key ] = wc_format_phone_number( $address[ $key ] );

										if ( ! WC_Validation::is_phone( $address[ $key ] ) ) {
											$errors[] = $key;

											if ( function_exists('wc_add_notice') )
												wc_add_notice( sprintf( wcl10n__( '%s is not a valid phone number.', 'woocommerce' ),'<strong>' . $field['label'] . '</strong>' ), 'error' );
											else
												WC()->add_error( sprintf( wcl10n__( '%s is not a valid phone number.', 'woocommerce' ),'<strong>' . $field['label'] . '</strong>' ));
										}

										break;
									case 'email' :
										$address[ $key ] = strtolower( $address[ $key ] );

										if ( ! is_email( $address[ $key ] ) ) {
											$errors[] = $key;

											if ( function_exists('wc_add_notice') )
												wc_add_notice( sprintf( wcl10n__( '%s is not a valid email address.', 'woocommerce' ), '<strong>' . $field['label'] . '</strong>' ), 'error' );
											else
												WC()->add_error( sprintf( wcl10n__( '%s is not a valid email address.', 'woocommerce' ), '<strong>' . $field['label'] . '</strong>' ) );
										}

										break;
									case 'state' :
										// Get valid states
										$valid_states = WC()->countries->get_states( $address[ 'shipping_country' ] );
										if ( $valid_states )
											$valid_state_values = array_flip( array_map( 'strtolower', $valid_states ) );

										// Convert value to key if set
										if ( isset( $valid_state_values[ strtolower( $address[ $key ] ) ] ) )
											$address[ $key ] = $valid_state_values[ strtolower( $address[ $key ] ) ];

										// Only validate if the country has specific state options
										if ( is_array($valid_states) && sizeof( $valid_states ) > 0 )
											if ( ! in_array( $address[ $key ], array_keys( $valid_states ) ) ) {
												$errors[] = $key;

												if ( function_exists('wc_add_notice') )
													wc_add_notice( sprintf( wcl10n__('%1$s is not valid. Please enter one of the following: %2$s', 'woocommerce'),'<strong>'. $field['label'] .'</strong>', implode( ', ', $valid_states )), 'error' );
												else
													WC()->add_error( sprintf( wcl10n__('%1$s is not valid. Please enter one of the following: %2$s', 'woocommerce'),'<strong>'. $field['label'] .'</strong>', implode( ', ', $valid_states )));
											}

										break;
								}
							}
						}

					}

				}

				if ( count($errors) > 0 ) {
					if ( function_exists( 'wc_add_notice' ) ) {
						wc_add_notice( __( 'Please enter the complete address', 'friendstore-for-woocommerce' ), 'error' );
					} else {
						WC()->add_error( __( 'Please enter the complete address', 'friendstore-for-woocommerce' ) );
					}
					$next = add_query_arg( $address, $redirect_url );
					wp_redirect( add_query_arg('address-form', 1, $next ) );
					exit;
				}

				// address is unique, save!
				if ( $id == -1 ) {
					$vals = '';
					foreach ($address as $key => $value) {
						$vals .= $value;
					}
					$md5 = md5($vals);

					foreach ($addresses as $addr) {
						$vals = '';
						if( !is_array($addr) ) { continue; }
						foreach ($addr as $key => $value) {
							$vals .= $value;
						}
						$addrMd5 = md5($vals);

						if ($md5 == $addrMd5) {
							// duplicate address!
							if ( function_exists( 'wc_add_notice' ) ) {
								wc_add_notice( __( 'Address is already in your address book', 'friendstore-for-woocommerce' ), 'error' );
							} else {
								WC()->add_error( __( 'Address is already in your address book', 'friendstore-for-woocommerce' ) );
							}
							$next = add_query_arg( $address, $redirect_url );
							wp_redirect( add_query_arg('address-form', 1, $next ) );
							exit;
						}
					}

					$addresses[] = $address;
				} else {
					$addresses[$id] = $address;
				}

				// update the default address and remove it from the $addresses array
				if ( $user->ID > 0 ) {
					if ( $id == 0 ) {
						$default_address = $addresses[0];
						unset( $addresses[0] );

						if ( $default_address['shipping_address_1'] && $default_address['shipping_postcode'] ) {
							update_user_meta( $user->ID, 'shipping_first_name', $default_address['shipping_first_name'] );
							update_user_meta( $user->ID, 'shipping_last_name',  $default_address['shipping_last_name'] );
							update_user_meta( $user->ID, 'shipping_company',    $default_address['shipping_company'] );
							update_user_meta( $user->ID, 'shipping_address_1',  $default_address['shipping_address_1'] );
							update_user_meta( $user->ID, 'shipping_address_2',  $default_address['shipping_address_2'] );
							update_user_meta( $user->ID, 'shipping_city',       $default_address['shipping_city'] );
							update_user_meta( $user->ID, 'shipping_state',      $default_address['shipping_state'] );
							update_user_meta( $user->ID, 'shipping_postcode',   $default_address['shipping_postcode'] );
							update_user_meta( $user->ID, 'shipping_country',    $default_address['shipping_country'] );
						}
						unset( $addresses[0] );
					}

				}

				$this->save_user_addresses( $user->ID, $addresses );

				if ( $id >= 0 ) {
					$next = add_query_arg( 'updated', '1', $redirect_url );
				} else {
					$next = add_query_arg( 'new', '1', $redirect_url );
				}

				wp_redirect( $next );
				exit;
			}
		}

		/**
		 * Save user addresses to account or session
		 * Removes the default addresses and any duplicate addresses
		 *
		 * @param  integer  $user_id    Customer user ID
		 * @param  array    $addresses  List of user addresses
		 */
		public function save_user_addresses( $user_id, $addresses ) {
            if ( ! self::is_enabled() ) return;

			$keys = array();
			foreach ( $addresses as $index => $address ) {
				if ( ! empty( $address['default_address'] ) ) {
					// Remove default address
					unset( $addresses[ $index ] );
				} elseif ( $key = $this->unique_address_key( $address ) ) {
					// Save unique address key
					$keys[ $index ] = $key;
				} else {
					// Remove empty address
					unset( $addresses[ $index ] );
				}
			}

			// Remove any duplicate addresses
			$duplicates = array_diff_assoc( $keys, array_unique( $keys ) );
			foreach( array_keys( $duplicates ) as $index ) {
				unset( $addresses[ $index ] );
			}

			if ( $user_id > 0 ) {
				update_user_meta( $user_id, 'fsw_other_addresses', $addresses );
			} else {
				fsw_session_set( 'user_addresses', $addresses );
			}
		}


        public function addresses_checkout(){
            if ( ! self::is_enabled() ) return;
            add_action( 'woocommerce_before_checkout_billing_form', array( $this, 'checkout_billing_form' ), 10, 1 );
            add_action( 'woocommerce_before_checkout_shipping_form', array( $this, 'checkout_shipping_form' ), 10, 1 );
        }

        public function addresses_my_account(){
            if ( ! self::is_enabled() ) return;

            if ( version_compare( WC_VERSION, '2.6', '<' ) ) return;

            add_filter( 'woocommerce_my_account_get_addresses', array( $this, 'my_account_address_labels' ), 10, 2 );
            add_filter( 'woocommerce_my_account_my_address_formatted_address', array( $this, 'my_account_address_formatted' ), 10, 3 );

            add_filter( 'woocommerce_address_to_edit', array( $this, 'my_account_address_to_edit' ), 10, 2 );

            add_filter( 'woocommerce_my_account_edit_address_field_value', array( $this, 'my_account_edit_address_field_value' ), 10, 3 );
            add_action( 'template_redirect', array( $this, 'my_account_save_address' ), 1 );

            // Delete address in edit address page
            add_action( 'woocommerce_before_edit_account_address_form', array( $this, 'my_account_delete_address_button' ) );
            add_action( 'wp_loaded', array( $this, 'my_account_delete_address_action' ), 20 );

            // Add address button on my account addresses page
            add_action( 'woocommerce_account_edit-address_endpoint', array( $this, 'my_account_add_address_button' ), 90 );

            // Initialize address fields
            add_action( 'woocommerce_account_content', array( $this, 'my_account_init_address_fields' ), 1 );

        }

        public function addresses_user_profile(){
            if ( ! self::is_enabled() ) return;

            add_action( 'admin_notices', array( $this, 'user_profile_admin_notice' ) );
            add_action( 'edit_user_profile', array( $this, 'user_profile_table_addresses' ), 21 );
            add_action( 'show_user_profile', array( $this, 'user_profile_table_addresses' ), 21 );

            // delete address request
            add_action( 'admin_post_fsw_delete_address', array( $this, 'user_profile_delete_address' ) );
            add_action( 'wp_ajax_fsw_edit_user_address', array( $this, 'user_profile_edit_address' ) );
        }

        /**
         * Actions Checkout page
         */
        private function checkout_render_dropdown($fieldset) {
            $user = wp_get_current_user();
            if(!$user->exists()) return;

            $addresses = FoW()->address_book->get_user_addresses( $user );

            fsw_get_template('addresses/dropdown-addresses.php', array( 'addresses' => $addresses, 'fieldset' => $fieldset));
        }

        public function checkout_billing_form($checkout) {
            $this->checkout_render_dropdown('billing');
        }

        public function checkout_shipping_form($checkout) {
            $this->checkout_render_dropdown('shipping');
        }

        /**
         * Actions My account page
         */
        public function my_account_address_labels( $labels, $customer_id ) {
            $user = get_user_by( 'id', $customer_id );
            $addresses = FoW()->address_book->get_user_addresses( $user, false );

            $address_id = 0;

            foreach ( $addresses as $index => $address ) {
                $address_id++;

                $labels[ 'fsw_address_' . $index ] = sprintf( '%s %d', wcl10n__('Shipping address', 'woocommerce'), $address_id );
            }

            return $labels;
        }

        public function my_account_address_formatted( $address, $customer_id, $address_id ) {
            if ( strpos( $address_id, 'fsw_address_' ) === 0 ) {
                $user = get_user_by( 'id', $customer_id );
                $addresses = FoW()->address_book->get_user_addresses( $user, false );

                $parts = explode( '_', $address_id );
                $index = $parts[2];

                if ( isset( $addresses[ $index ] ) ) {
                    $account_address = $addresses[ $index ];

                    foreach ( $account_address as $key => $value ) {
                        $key = str_replace( 'shipping_', '', $key );
                        $account_address[ $key ] = $value;
                    }

                    $address = $account_address;
                }
            }

            return $address;
        }

        public function my_account_address_to_edit( $address, $load_address ) {
            if(isset($address['shipping_state'])) $address['shipping_city']['options'] = FoW_Ultility::get_districts_array_by_city_id($address['shipping_state']['value']);
            if(isset($address['shipping_city'])) $address['shipping_address_2']['options'] = FoW_Ultility::get_wards_array_by_district_id($address['shipping_city']['value']);

            return $address;
        }

        public function my_account_edit_address_field_value( $value, $key, $load_address ) {
            if ( strpos( $load_address, 'fsw_address_' ) === 0 ) {
                $parts = explode( '_', $load_address );
                $index = $parts[2];

                if ( 'new' === $index ) {
                    return empty( $_POST[ $key ] ) ? '' : wc_clean( $_POST[ $key ] );
                }

                $user = wp_get_current_user();
                $addresses = FoW()->address_book->get_user_addresses( $user, false );

                if ( ! isset( $addresses[ $index ] ) ) {
                    return $value;
                }

                $key = str_replace( $load_address, 'shipping', $key );
                if(isset($addresses[ $index ][ $key ])) $value = $addresses[ $index ][ $key ];
            }

            return $value;
        }

        public function my_account_save_address() {
            global $wp;

            if ( 'POST' !== strtoupper( $_SERVER['REQUEST_METHOD'] ) ) {
                return;
            }

            if ( version_compare( WC_VERSION, '3.4', '<' ) ) {
                if ( empty( $_POST['action'] ) || 'edit_address' !== $_POST['action'] || empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'woocommerce-edit_address' ) ) {
                    return;
                }
            } else {
                if ( empty( $_POST['action'] ) || 'edit_address' !== $_POST['action'] ) {
                    return;
                }
            }

            $user_id = get_current_user_id();

            if ( $user_id <= 0 ) {
                return;
            }

            $load_address = isset( $wp->query_vars['edit-address'] ) ? wc_edit_address_i18n( sanitize_title( $wp->query_vars['edit-address'] ), true ) : 'billing';

            // Only save our own addresses
            if ( strpos( $load_address, 'fsw_address_' ) !== 0 ) {
                return;
            }

            $address = WC()->countries->get_address_fields( esc_attr( $_POST[ 'shipping_country' ] ), 'shipping_' );

            foreach ( $address as $key => $field ) {

                if ( ! isset( $field['type'] ) ) {
                    $field['type'] = 'text';
                }

                // Get Value.
                switch ( $field['type'] ) {
                    case 'checkbox' :
                        $_POST[ $key ] = (int) isset( $_POST[ $key ] );
                        break;
                    default :
                        $_POST[ $key ] = isset( $_POST[ $key ] ) ? wc_clean( $_POST[ $key ] ) : '';
                        break;
                }

                // Hook to allow modification of value.
                $_POST[ $key ] = apply_filters( 'woocommerce_process_myaccount_field_' . $key, $_POST[ $key ] );

                // Validation: Required fields.
                if ( ! empty( $field['required'] ) && empty( $_POST[ $key ] ) ) {
                    wc_add_notice( sprintf( wcl10n__( '%s is a required field.', 'woocommerce' ), $field['label'] ), 'error' );
                }

                if ( ! empty( $_POST[ $key ] ) ) {

                    // Validation rules
                    if ( ! empty( $field['validate'] ) && is_array( $field['validate'] ) ) {
                        foreach ( $field['validate'] as $rule ) {
                            switch ( $rule ) {
                                case 'postcode' :
                                    $_POST[ $key ] = strtoupper( str_replace( ' ', '', $_POST[ $key ] ) );

                                    if ( ! isset( $_POST[ $load_address . '_country' ] ) ) {
                                        continue 2;
                                    }

                                    if ( ! WC_Validation::is_postcode( $_POST[ $key ], $_POST[ $load_address . '_country' ] ) ) {
                                        wc_add_notice( wcl10n__( 'Please enter a valid postcode / ZIP.', 'woocommerce' ), 'error' );
                                    } else {
                                        $_POST[ $key ] = wc_format_postcode( $_POST[ $key ], $_POST[ $load_address . '_country' ] );
                                    }
                                    break;
                                case 'phone' :
                                    $_POST[ $key ] = wc_format_phone_number( $_POST[ $key ] );

                                    if ( ! WC_Validation::is_phone( $_POST[ $key ] ) ) {
                                        wc_add_notice( sprintf( wcl10n__( '%s is not a valid phone number.', 'woocommerce' ), '<strong>' . $field['label'] . '</strong>' ), 'error' );
                                    }
                                    break;
                                case 'email' :
                                    $_POST[ $key ] = strtolower( $_POST[ $key ] );

                                    if ( ! is_email( $_POST[ $key ] ) ) {
                                        wc_add_notice( sprintf( wcl10n__( '%s is not a valid email address.', 'woocommerce' ), '<strong>' . $field['label'] . '</strong>' ), 'error' );
                                    }
                                    break;
                            }
                        }
                    }
                }
            }

            do_action( 'woocommerce_after_save_address_validation', $user_id, $load_address, $address );

            if ( 0 === wc_notice_count( 'error' ) ) {

                $user        = new WP_User( $user_id );
                $addresses   = FoW()->address_book->get_user_addresses( $user, false );
                $parts       = explode( '_', $load_address );
                $index       = $parts[2];
                $new_address = array();

                foreach ( $address as $key => $field ) {
                    $new_address[ $key ] = $_POST[ $key ];
                }

                if ( 'new' === $index ) {
                    $addresses[] = $new_address;
                    end( $addresses );
                    $index = key( $addresses );
                    wc_add_notice( __( 'Address added successfully.', 'friendstore-for-woocommerce' ) );
                } else {
                    $addresses[ $index ] = $new_address;
                    wc_add_notice( wcl10n__( 'Address changed successfully.', 'woocommerce' ) );
                }

                $default_address = FoW()->address_book->get_user_default_address( $user->ID );

                if ( $default_address['address_1'] && $default_address['postcode'] ) {
                    array_unshift( $addresses, $default_address );
                }

                FoW()->address_book->save_user_addresses( $user_id, $addresses );

                do_action( 'woocommerce_customer_save_address', $user_id, $load_address );

                wp_safe_redirect( wc_get_endpoint_url( 'edit-address', '', wc_get_page_permalink( 'myaccount' ) ) );
                exit;
            }

            // Prevent WC_Form_Handler::save_address
            unset( $_POST['action'] );
        }

        public function my_account_delete_address_button() {
            $address = get_query_var( 'edit-address' );
            $edit_address = wc_get_endpoint_url( 'edit-address' );

            // Only show on multiple addresses
            if ( 0 !== strpos( $address, 'fsw_address_' ) || empty( $edit_address ) || $address == 'fsw_address_new' ) {
                return;
            }

            $remove_link = wp_nonce_url( add_query_arg( 'remove_address', $address, $edit_address ), 'fsw-delete-address' );

            fsw_get_template('addresses/button-delete.php', array( 'remove_link' => $remove_link));
        }

        public function my_account_delete_address_action() {
            if ( ! empty( $_GET['remove_address'] ) && isset( $_GET['_wpnonce'] ) && wp_verify_nonce( $_GET['_wpnonce'], 'fsw-delete-address' ) ) {

                $user = wp_get_current_user();
                if ( $user->ID ) {
                    $address   = wc_clean( $_GET['remove_address'] );
                    $parts = explode( '_', $address );
                    $index = isset($parts[2]) ? $parts[2] : '';

                    $addresses = FoW()->address_book->get_user_addresses( $user );

                    if ( $index && isset( $addresses[ $index ] ) ) {
                        unset( $addresses[ $index ] );
                        FoW()->address_book->save_user_addresses( $user->ID, $addresses );
                        wc_add_notice( __('Address deleted successfully.', 'friendstore-for-woocommerce') );
                    } else {
                        wc_add_notice( __( 'Error: non-existing address ID.', 'friendstore-for-woocommerce' ), 'error' );
                    }

                    // Redirect to edit address page
                    wp_safe_redirect( wc_get_account_endpoint_url( 'edit-address' ) );
                    exit;
                }
            }
        }

        public function my_account_add_address_button() {
            $address = get_query_var( 'edit-address' );

            if ( empty( $address ) ) {
                $add_new_link = wc_get_account_endpoint_url( 'edit-address' ) . 'fsw_address_new';
                fsw_get_template('addresses/button-add-new.php', array( 'add_new_link' => $add_new_link));
            }
        }

        public function my_account_init_address_fields() {
            $address = get_query_var( 'edit-address' );

            if ( 0 === strpos( $address, 'fsw_address_' ) ) {
                add_filter( 'woocommerce_' . $address . '_fields', array( $this, 'my_account_country_address_fields' ), 10, 2 );
                add_filter( 'woocommerce_checkout_get_value', array( $this, 'my_account_country_address_value' ), 10, 2 );
            }
        }

        public function my_account_country_address_fields( $address_fields, $country ) {
            $address_country = $this->get_address_country();
            if ( false !== $address_country ) {
                $country = $address_country;
            }

            return WC()->countries->get_address_fields( $country, 'shipping_' );
        }

        public function my_account_country_address_value( $value, $input ) {
            if ( 'shipping_country' === $input ) {
                $country = $this->get_address_country();
                if ( false !== $country ) {
                    return $country;
                }
            }
            return $value;
        }


        /**
         * Actions User Profile page
         */
        public function user_profile_admin_notice() {
            if ( isset( $_GET['fsw_address_deleted'] ) ) {
                echo '<div class="updated"><p>' . __('Address deleted successfully.', 'friendstore-for-woocommerce' ) . '</p></div>';
            }
        }

        public function user_profile_table_addresses( $user ) {
            if ( ! current_user_can( 'manage_woocommerce' ) ) return;
            ?>
            <h3><?php _e( 'Other Shipping Addresses', 'friendstore-for-woocommerce' ); ?></h3>

            <div id="other_addresses_div">
                <?php $this->user_profile_render_table( $user ); ?>
            </div>
            <?php
        }

        public function user_profile_render_table( $user ) {
            require 'admin/class.admin-user-addresses-list-table.php';

            $table = new FoW_Admin_User_Addresses_List_Table( $user );
            $table->prepare_items();
            $table->display();
        }

        public function user_profile_delete_address() {
            check_admin_referer( 'delete_shipping_address' );

            $user_id    = $_REQUEST['user_id'];
            $index      = $_REQUEST['index'];

            $user = new WP_User( $user_id );
            $addresses = FoW()->address_book->get_user_addresses( $user, false );

            if ( isset( $addresses[ $index ] ) ) {
                unset( $addresses[ $index ] );
            }

            FoW()->address_book->save_user_addresses( $user_id, $addresses );

            // redirect back to the profile page
            wp_safe_redirect( admin_url( 'user-edit.php?user_id=' . $user_id . '&fsw_address_deleted=1' ) );
            exit;
        }

        public function user_profile_edit_address() {
            $address = array();
            parse_str( $_POST['data'], $address );
            $index      = $_POST['index'];
            $user_id    = $_POST['user'];
            $user       = new WP_User( $user_id );
            $addresses  = FoW()->address_book->get_user_addresses( $user, false );

            // store the same values without the shipping_ prefix
            foreach ( $address as $key => $value ) {
                $address[ $key ] = $value;
            }

            $addresses[ $index ] = $address;

            FoW()->address_book->save_user_addresses( $user_id, $addresses );

            die( fsw_get_formatted_address( $address ) );
        }
	}
}