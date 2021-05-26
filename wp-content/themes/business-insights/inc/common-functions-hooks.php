<?php
if (!function_exists('business_insights_the_custom_logo')):
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * @since Business Insights 1.0.0
 */
function business_insights_the_custom_logo() {
	if (function_exists('the_custom_logo')) {
		the_custom_logo();
	}
}
endif;

if (!function_exists('business_insights_body_class')):

/**
 * body class.
 *
 * @since 1.0.0
 */
function business_insights_body_class($business_insights_body_class) {
	global $post;
	$global_layout       = business_insights_get_option('global_layout');
	$input               = '';
	$home_content_status = business_insights_get_option('home_page_content_status');
	if (1 != $home_content_status) {
		$input = 'home-content-not-enabled';
	}
	// Check if single.
	if ($post && is_singular()) {
		$post_options = get_post_meta($post->ID, 'business-insights-meta-select-layout', true);
		if (empty($post_options)) {
			$global_layout = esc_attr(business_insights_get_option('global_layout'));
		} else {
			$global_layout = esc_attr($post_options);
		}
	}
	if ($global_layout == 'left-sidebar') {
		$business_insights_body_class[] = 'left-sidebar '.esc_attr($input);
	} elseif ($global_layout == 'no-sidebar') {
		$business_insights_body_class[] = 'no-sidebar '.esc_attr($input);
	} else {
		$business_insights_body_class[] = 'right-sidebar '.esc_attr($input);

	}
	return $business_insights_body_class;
}
endif;

add_action('body_class', 'business_insights_body_class');

add_action('business_insights_action_sidebar', 'business_insights_add_sidebar');

/**
 * Returns word count of the sentences.
 *
 * @since Business Insights 1.0.0
 */
if (!function_exists('business_insights_words_count')):
function business_insights_words_count($length = 25, $business_insights_content = null) {
	$length          = absint($length);
	$source_content  = preg_replace('`\[[^\]]*\]`', '', $business_insights_content);
	$trimmed_content = wp_trim_words($source_content, $length, '');
	return $trimmed_content;
}
endif;

if (!function_exists('business_insights_simple_breadcrumb')):

/**
 * Simple breadcrumb.
 *
 * @since 1.0.0
 */
function business_insights_simple_breadcrumb() {

	if (!function_exists('breadcrumb_trail')) {

		require_once get_template_directory().'/assets/libraries/breadcrumbs/breadcrumbs.php';
	}

	$breadcrumb_args = array(
		'container'   => 'div',
		'show_browse' => false,
	);
	breadcrumb_trail($breadcrumb_args);

}

endif;



if ( ! function_exists( 'business_insights_ajax_pagination' ) ) :
    /**
     * Outputs the required structure for ajax loading posts on scroll and click
     *
     * @since 1.0.0
     * @param $type string Ajax Load Type
     */
    function business_insights_ajax_pagination($type) {
        ?>
        <div class="load-more-posts" data-load-type="<?php echo esc_attr($type);?>">
            <a href="#" class="btn-link btn-link-load">
                <span class="ajax-loader"></span>
                <?php esc_html_e('Load More Posts', 'business-insights')?>
                <i class="ion-ios-arrow-right"></i>
            </a>
        </div>
        <?php
    }
endif;

if ( ! function_exists( 'business_insights_load_more' ) ) :
    /**
     * Ajax Load posts Callback.
     *
     * @since 1.0.0
     *
     */
    function business_insights_load_more() {

        check_ajax_referer( 'business-insights-load-more-nonce', 'nonce' );

        $output['more_post'] = false;
        $output['content'] = array();

        $args['post_type'] = ( isset( $_GET['post_type']) && !empty($_GET['post_type'] ) ) ? sanitize_text_field( wp_unslash( $_GET['post_type'] ) ) : 'post';
        $args['post_status'] = 'publish';

        if( isset( $_GET['page'] ) ){
            $args['paged'] = sanitize_text_field( wp_unslash( $_GET['page'] ) );
        }else{
            $args['paged'] = '';
        }

        if( isset( $_GET['cat'] ) && isset( $_GET['taxonomy'] ) ){
            $args['tax_query'] = array(
                array(
                    'taxonomy' => sanitize_text_field( wp_unslash( $_GET['taxonomy'] ) ),
                    'field'    => 'slug',
                    'terms'    => array( sanitize_text_field( wp_unslash( $_GET['cat'] ) ) ),
                ),
            );
        }

        if( isset($_GET['search']) ){
            $args['s'] = sanitize_text_field( wp_unslash( $_GET['search'] ) );
        }

        if( isset($_GET['author']) ){
            $args['author_name'] = sanitize_text_field( wp_unslash( $_GET['author'] ) );
        }

        if( isset($_GET['year']) || isset($_GET['month']) || isset($_GET['day']) ){

            $date_arr = array();

            if( !empty($_GET['year']) ){
                $date_arr['year'] = (int) sanitize_text_field( wp_unslash( $_GET['year'] ) );
            }
            if( !empty($_GET['month']) ){
                $date_arr['month'] = (int) sanitize_text_field( wp_unslash( $_GET['month'] ) );
            }
            if( !empty($_GET['day']) ){
                $date_arr['day'] = (int) sanitize_text_field( wp_unslash( $_GET['day'] ) );
            }

            if( !empty($date_arr) ){
                $args['date_query'] = array( $date_arr );
            }
        }

        $loop = new WP_Query( $args );
        if($loop->max_num_pages > $args['paged']){
            $output['more_post'] = true;
        }
        if ( $loop->have_posts() ):
            while ( $loop->have_posts() ): $loop->the_post();
                ob_start();
                get_template_part('template-parts/content', get_post_format());
                $output['content'][] = ob_get_clean();
            endwhile;wp_reset_postdata();
            wp_send_json_success($output);
        else:
            $output['more_post'] = false;
            wp_send_json_error($output);
        endif;
        wp_die();
    }
endif;
add_action( 'wp_ajax_business_insights_load_more', 'business_insights_load_more' );
add_action( 'wp_ajax_nopriv_business_insights_load_more', 'business_insights_load_more' );


if (!function_exists('business_insights_custom_posts_navigation')):
/**
 * Posts navigation.
 *
 * @since 1.0.0
 */
function business_insights_custom_posts_navigation() {

	$pagination_type = business_insights_get_option('pagination_type');

	switch ($pagination_type) {

		case 'default':
			the_posts_navigation();
			break;

		case 'numeric':
			the_posts_pagination();
			break;

        case 'infinite_scroll_load':
            business_insights_ajax_pagination('scroll');
            break;

		default:
			break;
	}

}
endif;

add_action('business_insights_action_posts_navigation', 'business_insights_custom_posts_navigation');

if (!function_exists('business_insights_excerpt_length') && !is_admin()):

/**
 * Excerpt length
 *
 * @since  Business Insights 1.0.0
 *
 * @param null
 * @return int
 */
function business_insights_excerpt_length($length) {
	$excerpt_length = business_insights_get_option('excerpt_length_global');
	if (empty($excerpt_length)) {
		$excerpt_length = $length;
	}
	return absint($excerpt_length);

}

add_filter('excerpt_length', 'business_insights_excerpt_length', 999);
endif;


if (!function_exists('business_insights_get_link_url')):

/**
 * Return the post URL.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since 1.0.0
 *
 * @return string The Link format URL.
 */
function business_insights_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content($content);

	return ($has_url)?$has_url:apply_filters('the_permalink', get_permalink());
}

endif;

if (!function_exists('business_insights_fonts_url')):

/**
 * Return fonts URL.
 *
 * @since 1.0.0
 * @return string Fonts URL.
 */
function business_insights_fonts_url() {
	$fonts_url = '';
	$fonts     = array();

	$business_insights_primary_font   = business_insights_get_option('primary_font');
	$business_insights_secondary_font = business_insights_get_option('secondary_font');

	$business_insights_fonts   = array();
	$business_insights_fonts[] = $business_insights_primary_font;
	$business_insights_fonts[] = $business_insights_secondary_font;

	$business_insights_fonts_stylesheet = '//fonts.googleapis.com/css?family=';

	$i = 0;
	for ($i = 0; $i < count($business_insights_fonts); $i++) {

		if ('off' !== sprintf(_x('on', '%s font: on or off', 'business-insights'), $business_insights_fonts[$i])) {
			$fonts[] = $business_insights_fonts[$i];
		}

	}

	if ($fonts) {
		$fonts_url = add_query_arg(array(
				'family' => urldecode(implode('|', $fonts)),
			), 'https://fonts.googleapis.com/css');
	}

	return $fonts_url;
}

endif;

/*Recomended plugin*/
if (!function_exists('business_insights_recommended_plugins')):

/**
 * Recommended plugins
 *
 */
function business_insights_recommended_plugins() {
	$business_insights_plugins = array(
        array(
            'name'     => __('Elementor Page Builder', 'business-insights'),
            'slug'     => 'elementor',
            'required' => false,
        ),
        array(
            'name'     => __('Contact Form 7', 'business-insights'),
            'slug'     => 'contact-form-7',
            'required' => false,
        ),
	);
	$business_insights_plugins_config = array(
		'dismissable' => true,
	);

	tgmpa($business_insights_plugins, $business_insights_plugins_config);
}
endif;
add_action('tgmpa_register', 'business_insights_recommended_plugins');


function business_insights_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }

    return $title;
}

add_filter( 'get_the_archive_title', 'business_insights_archive_title' );

if( class_exists( 'Booster_Extension_Class' ) ){

    add_filter('booster_extemsion_content_after_filter','business_insights_content_pagination');

}

if( !function_exists('business_insights_content_pagination') ):

    function business_insights_content_pagination($after_content){

        $pagination_single = wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'business-insights' ),
                    'after'  => '</div>',
                    'echo' => false
                ) );

        $after_content =  $pagination_single.$after_content;

        return $after_content;

    }

endif;