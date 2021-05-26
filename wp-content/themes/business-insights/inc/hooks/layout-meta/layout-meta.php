<?php
/**
 * Implement theme metabox.
 *
 * @package Business Insights
 */

if (!function_exists('business_insights_add_theme_meta_box')) :

    /**
     * Add the Meta Box
     *
     * @since 1.0.0
     */
    function business_insights_add_theme_meta_box()
    {

        $apply_metabox_post_types = array('post', 'page');

        foreach ($apply_metabox_post_types as $key => $type) {
            add_meta_box(
                'business-insights-theme-settings',
                esc_html__('Single Page/Post Settings', 'business-insights'),
                'business_insights_render_theme_settings_metabox',
                $type
            );
        }

    }

endif;

add_action('add_meta_boxes', 'business_insights_add_theme_meta_box');

add_action( 'admin_enqueue_scripts', 'business_insights_backend_scripts');
if ( ! function_exists( 'business_insights_backend_scripts' ) ){
    function business_insights_backend_scripts( $hook ) {
        wp_enqueue_style( 'wp-color-picker');
        wp_enqueue_script( 'wp-color-picker');
    }
}

if (!function_exists('business_insights_render_theme_settings_metabox')) :

    /**
     * Render theme settings meta box.
     *
     * @since 1.0.0
     */
    function business_insights_render_theme_settings_metabox($post, $metabox)
    {

        $post_id = $post->ID;
        $business_insights_post_meta_value = get_post_meta($post_id);

        // Meta box nonce for verification.
        wp_nonce_field(basename(__FILE__), 'business_insights_meta_box_nonce');
        // Fetch Options list.
        $page_layout = get_post_meta($post_id, 'business-insights-meta-select-layout', true);
        $page_image_layout = get_post_meta($post_id, 'business-insights-meta-image-layout', true);
        $business_insights_meta_banner_checkbox = get_post_meta($post_id, 'business-insights-meta-banner-checkbox', true);
        $business_insights_meta_checkbox = get_post_meta($post_id, 'business-insights-meta-checkbox', true);
        ?>

        <div class="business-insights-tab-main">

            <div class="business-insights-metabox-tab">
                <ul>
                    <li>
                        <a id="twp-tab-general" class="twp-tab-active" href="javascript:void(0)"><?php esc_html_e('Layout Settings', 'business-insights'); ?></a>
                    </li>
                </ul>
            </div>

            <div class="business-insights-tab-content">
                
                <div id="twp-tab-general-content" class="business-insights-content-wrap business-insights-tab-content-active">

                    <div class="business-insights-meta-panels">

                        <div class="business-insights-opt-wrap insights-checkbox-wrap">

                            <input id="business-insights-meta-banner-checkbox" name="business-insights-meta-banner-checkbox" type="checkbox" <?php if ($business_insights_meta_banner_checkbox) { ?> checked="checked" <?php } ?> />

                            <label for="business-insights-meta-banner-checkbox"><?php esc_html_e('Check To Disable Featured Page Banner Header With Title', 'business-insights'); ?></label>
                        </div>

                        <div class="business-insights-opt-wrap insights-checkbox-wrap">

                            <input id="business-insights-meta-checkbox" name="business-insights-meta-checkbox" type="checkbox" <?php if ($business_insights_meta_checkbox) { ?> checked="checked" <?php } ?> />

                            <label for="business-insights-meta-checkbox"><?php esc_html_e('Check To Use Featured Image As Banner Image', 'business-insights'); ?></label>
                        </div>

                         <div class="business-insights-opt-wrap business-insights-opt-wrap-alt">
                            <label><?php esc_html_e('Single Page/Post Layout', 'business-insights'); ?></label>
                            <select name="business-insights-meta-select-layout" id="business-insights-meta-select-layout">
                                <option value="right-sidebar" <?php selected('right-sidebar', $page_layout); ?>>
                                    <?php esc_html_e('Content - Primary Sidebar', 'business-insights') ?>
                                </option>
                                <option value="left-sidebar" <?php selected('left-sidebar', $page_layout); ?>>
                                    <?php esc_html_e('Primary Sidebar - Content', 'business-insights') ?>
                                </option>
                                <option value="no-sidebar" <?php selected('no-sidebar', $page_layout); ?>>
                                    <?php esc_html_e('No Sidebar', 'business-insights') ?>
                                </option>
                            </select>
                        </div>

                        <div class="business-insights-opt-wrap business-insights-opt-wrap-alt">
                            <label><?php esc_html_e('Single Page/Post Image Layout', 'business-insights'); ?></label>
                            <select name="business-insights-meta-image-layout" id="business-insights-meta-image-layout">
                                <option value="full" <?php selected('full', $page_image_layout); ?>>
                                    <?php esc_html_e('Full', 'business-insights') ?>
                                </option>
                                <option value="left" <?php selected('left', $page_image_layout); ?>>
                                    <?php esc_html_e('Left', 'business-insights') ?>
                                </option>
                                <option value="right" <?php selected('right', $page_image_layout); ?>>
                                    <?php esc_html_e('Right', 'business-insights') ?>
                                </option>
                                <option value="no-image" <?php selected('no-image', $page_image_layout); ?>>
                                    <?php esc_html_e('No Image', 'business-insights') ?>
                                </option>
                            </select>
                        </div>


                    </div>
                </div>

            </div>
        </div>

        <?php
    }

endif;


if (!function_exists('business_insights_save_theme_settings_meta')) :

    /**
     * Save theme settings meta box value.
     *
     * @since 1.0.0
     *
     * @param int $post_id Post ID.
     * @param WP_Post $post Post object.
     */
    function business_insights_save_theme_settings_meta($post_id, $post)
    {

        // Verify nonce.
        if (!isset($_POST['business_insights_meta_box_nonce']) || !wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['business_insights_meta_box_nonce'] ) ), basename(__FILE__))) {
            return;
        }

        // Bail if auto save or revision.
        if (defined('DOING_AUTOSAVE') || is_int(wp_is_post_revision($post)) || is_int(wp_is_post_autosave($post))) {
            return;
        }

        // Check the post being saved == the $post_id to prevent triggering this call for other save_post events.
        if ( isset($_POST['post_ID']) || empty($_POST['post_ID']) || sanitize_text_field( wp_unslash( $_POST['post_ID'] ) ) != $post_id) {
            return;
        }

        // Check permission.
        if ( isset( $_POST['post_type'] ) && 'page' === sanitize_text_field( wp_unslash( $_POST['post_type'] ) ) ) {
            if (!current_user_can('edit_page', $post_id)) {
                return;
            }
        } else if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        $business_insights_meta_banner_checkbox = isset($_POST['business-insights-meta-banner-checkbox']) ? sanitize_text_field( wp_unslash($_POST['business-insights-meta-banner-checkbox'] ) ) : '';
        update_post_meta($post_id, 'business-insights-meta-banner-checkbox', sanitize_text_field($business_insights_meta_banner_checkbox));

        $business_insights_meta_checkbox = isset($_POST['business-insights-meta-checkbox']) ? sanitize_text_field( wp_unslash($_POST['business-insights-meta-checkbox'] ) ) : '';
        update_post_meta($post_id, 'business-insights-meta-checkbox', sanitize_text_field($business_insights_meta_checkbox));

        $business_insights_meta_select_layout = isset($_POST['business-insights-meta-select-layout']) ? sanitize_text_field( wp_unslash($_POST['business-insights-meta-select-layout'] ) ) : '';
        if (!empty($business_insights_meta_select_layout)) {
            update_post_meta($post_id, 'business-insights-meta-select-layout', sanitize_text_field($business_insights_meta_select_layout));
        }
        $business_insights_meta_image_layout = isset($_POST['business-insights-meta-image-layout']) ? sanitize_text_field( wp_unslash($_POST['business-insights-meta-image-layout'] ) ) : '';
        if (!empty($business_insights_meta_image_layout)) {
            update_post_meta($post_id, 'business-insights-meta-image-layout', sanitize_text_field($business_insights_meta_image_layout));
        }

    }

endif;

add_action('save_post', 'business_insights_save_theme_settings_meta', 10, 3);