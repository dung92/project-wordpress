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

if (!class_exists('FoW_OrderStatus')) {
    class FoW_OrderStatus {
        function __construct() {
            add_filter('woocommerce_register_shop_order_post_statuses', array($this, 'register_order_statuses'));
            add_filter('wc_order_statuses', array($this, 'add_order_statuses'));
            add_filter('bulk_actions-edit-shop_order', array($this, 'dropdown_bulk_actions_shop_order'), 50, 1);
            add_filter('woocommerce_admin_order_actions', array($this, 'add_order_status_actions_button'), 100, 2);
            add_filter('woocommerce_admin_order_preview_actions', array($this, 'additional_admin_order_preview_buttons_actions'), 100, 2);
        }

        function register_order_statuses($order_statuses) {
            $new_order_statuses = array();

            // add new order status before processing
            foreach ($order_statuses as $key => $status) {
                if ('wc-completed' === $key) {
                    $new_order_statuses['wc-shipping'] = array(
                        'label'                     => esc_html__('Shipping', 'friendstore-for-woocommerce'),
                        'public'                    => true,
                        'exclude_from_search'       => false,
                        'show_in_admin_all_list'    => true,
                        'show_in_admin_status_list' => true,
                        'label_count'               => _n_noop('Shipping <span class="count">(%s)</span>', 'Shipping <span class="count">(%s)</span>', 'friendstore-for-woocommerce')
                    );
                    $new_order_statuses['wc-shipped'] = array(
                        'label'                     => esc_html__('Shipped', 'friendstore-for-woocommerce'),
                        'public'                    => true,
                        'exclude_from_search'       => false,
                        'show_in_admin_all_list'    => true,
                        'show_in_admin_status_list' => true,
                        'label_count'               => _n_noop('Shipped <span class="count">(%s)</span>', 'Shipped <span class="count">(%s)</span>', 'friendstore-for-woocommerce')
                    );
                }
                $new_order_statuses[$key] = $status;
            };
            return $new_order_statuses;
        }

        function add_order_statuses($order_statuses) {
            $new_order_statuses = array();

            // add new order status before processing
            foreach ($order_statuses as $key => $status) {
                if ('wc-completed' === $key) {
                    $new_order_statuses['wc-shipping'] = esc_html__('Shipping', 'friendstore-for-woocommerce');
                    $new_order_statuses['wc-shipped'] = esc_html__('Shipped', 'friendstore-for-woocommerce');
                }
                $new_order_statuses[$key] = $status;
            };
            return $new_order_statuses;
        }

        function dropdown_bulk_actions_shop_order($actions) {
            $new_actions = array();

            // add new order status before processing
            foreach ($actions as $key => $action) {
                if ('mark_completed' === $key)
                    $new_actions['mark_shipped'] = esc_html__('Change status to shipped', 'friendstore-for-woocommerce');

                $new_actions[$key] = $action;
            }
            return $new_actions;
        }

        function add_order_status_actions_button($actions, $order) {
            $new_actions = array();

            $ship_statuses = array(
                'complete' => array(
                    'status_id' => 'completed',
                    'label'     => wcl10n__('Completed', 'woocommerce', 'html'),
                    'allowed'   => array('shipping', 'shipped'),
                ),
                'shipping' => array(
                    'status_id' => 'shipping',
                    'label'     => esc_html__('Shipping', 'friendstore-for-woocommerce'),
                    'allowed'   => array('on-hold', 'processing', 'pending'),
                ),
                'shipped'  => array(
                    'status_id' => 'shipped',
                    'label'     => esc_html__('Shipped', 'friendstore-for-woocommerce'),
                    'allowed'   => array('shipping'),
                ),
            );

            foreach ($ship_statuses as $status_slug => $values) {
                if ($order->has_status($values['allowed'])) {
                    if ($status_slug == 'complete') {
                        foreach ($actions as $key => $action) {
                            $new_actions[$key] = $action;
                        }
                        $new_actions[$status_slug] = array(
                            'url'    => wp_nonce_url(admin_url('admin-ajax.php?action=woocommerce_mark_order_status&status=' . $values['status_id'] . '&order_id=' . $order->get_id()), 'woocommerce-mark-order-status'),
                            'name'   => $values['label'],
                            'action' => $status_slug,
                        );
                    } else {
                        foreach ($actions as $key => $action) {
                            if ('complete' === $key) {
                                $new_actions[$status_slug] = array(
                                    'url'    => wp_nonce_url(admin_url('admin-ajax.php?action=woocommerce_mark_order_status&status=' . $values['status_id'] . '&order_id=' . $order->get_id()), 'woocommerce-mark-order-status'),
                                    'name'   => $values['label'],
                                    'action' => $status_slug,
                                );
                            }
                            $new_actions[$key] = $action;
                        }
                    }
                    $actions = $new_actions;
                    $new_actions = array();
                }
            }

            return $actions;
        }

        function additional_admin_order_preview_buttons_actions($actions, $order) {
            $new_actions = array();

            if (empty($actions)) {
                $actions['status'] = array(
                    'group'   => wcl10n__('Change status: ', 'woocommerce', 'html'),
                    'actions' => array(),
                );
            }

            $ship_statuses = array(
                'complete' => array(
                    'status_id' => 'completed',
                    'label'     => wcl10n__('Completed', 'woocommerce', 'html'),
                    'title'     => wcl10n__('Change order status to completed', 'woocommerce', 'html'),
                    'allowed'   => array('shipping', 'shipped'),
                ),
                'shipping' => array(
                    'status_id' => 'shipping',
                    'label'     => esc_html__('Shipping', 'friendstore-for-woocommerce'),
                    'title'     => esc_html__('Change order status to shipping', 'friendstore-for-woocommerce'),
                    'allowed'   => array('on-hold', 'processing', 'pending'),
                ),
                'shipped'  => array(
                    'status_id' => 'shipped',
                    'label'     => esc_html__('Shipped', 'friendstore-for-woocommerce'),
                    'title'     => esc_html__('Change order status to shipped', 'friendstore-for-woocommerce'),
                    'allowed'   => array('shipping'),
                ),
            );

            foreach ($ship_statuses as $status_slug => $values) {
                if ($order->has_status($values['allowed'])) {
                    if ($status_slug == 'complete') {
                        if (count($actions) > 0) {
                            foreach ($actions['status']['actions'] as $key => $action) {
                                $new_actions[$key] = $action;
                            }
                        }
                        $new_actions[$status_slug] = array(
                            'url'    => wp_nonce_url(admin_url('admin-ajax.php?action=woocommerce_mark_order_status&status=' . $values['status_id'] . '&order_id=' . $order->get_id()), 'woocommerce-mark-order-status'),
                            'name'   => $values['label'],
                            'title'  => $values['title'],
                            'action' => '123',
                        );
                    } else {
                        foreach ($actions['status']['actions'] as $key => $action) {
                            if ('complete' === $key) {
                                $new_actions[$status_slug] = array(
                                    'url'    => wp_nonce_url(admin_url('admin-ajax.php?action=woocommerce_mark_order_status&status=' . $values['status_id'] . '&order_id=' . $order->get_id()), 'woocommerce-mark-order-status'),
                                    'name'   => $values['label'],
                                    'title'  => $values['title'],
                                    'action' => $status_slug,
                                );
                            }
                            $new_actions[$key] = $action;
                        }
                    }
                    $actions['status']['actions'] = $new_actions;
                    $new_actions = array();
                }
            }
            return $actions;
        }
    }

    new FoW_OrderStatus();
}