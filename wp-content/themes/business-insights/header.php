<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business Insights
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php if ( function_exists( 'wp_body_open' ) ) {
    wp_body_open();
}
?>

<?php if ((business_insights_get_option('enable_preloader')) == 1) { ?>
    <div class="preloader">
        <div class="preloader-wrapper">
            <div class="loader">
            </div>
        </div>
    </div>
<?php } ?>
<!-- full-screen-layout/boxed-layout -->
<?php if (business_insights_get_option('homepage_layout_option') == 'full-width') {
    $business_insights_homepage_layout = 'full-screen-layout';
} elseif (business_insights_get_option('homepage_layout_option') == 'boxed') {
    $business_insights_homepage_layout = 'boxed-layout';
} ?>
<div id="page" class="site site-bg <?php echo esc_attr($business_insights_homepage_layout); ?>">
    <a class="skip-link screen-reader-text" href="#main"><?php esc_html_e('Skip to content', 'business-insights'); ?></a>
<?php if (business_insights_get_option('move_logo_to_center') != 1) {
    $business_insights_logo_align = 'header-left';
} else {
    $business_insights_logo_align = 'header-center';
} ?>
    <header id="masthead" class="site-header <?php echo esc_attr($business_insights_logo_align); ?>" role="banner">
        <div class="header-middle">
            <div class="container">
                <div class="row equal-row">
                    <div class="col-md-4 col-sm-12">
                        <div class="site-branding">
                            <div class="twp-site-branding">
                                <?php
                                business_insights_the_custom_logo();
                                if (is_front_page() && is_home()) : ?>
                                    <span class="site-title primary-font">
                                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                                </span>
                                <?php else : ?>
                                    <span class="site-title primary-font">
                                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                                </span>
                                <?php
                                endif;
                                    $description = get_bloginfo('description', 'display');
                                    if ($description || is_customize_preview()) : ?>
                                        <p class="site-description"><?php echo esc_html($description); ?></p>
                                    <?php
                                    endif;
                                 ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    $top_header_location = business_insights_get_option('top_header_location');
                    $top_header_telephone = business_insights_get_option('top_header_telephone');
                    $top_header_email = business_insights_get_option('top_header_email');
                    ?>
                    <?php if ((!empty ($top_header_location)) || (!empty ($top_header_telephone)) || (!empty ($top_header_email))) { ?>
                    <div class="col-md-8 col-sm-12">
                        <div class="meta-info-wrapper">
                            <?php if (!empty($top_header_telephone)) { ?>
                            <div class="meta-info-col">
                                <div class="meta-info meta-info-tel">
                                    <div class="meta-info-child meta-info-icon">
                                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 464.993 464.993" style="enable-background:new 0 0 464.993 464.993;" xml:space="preserve"> <g> <path d="M420.333,34.843C392.042,12.374,354.528,0,314.7,0c-39.829,0-77.345,12.374-105.635,34.843 c-28.798,22.871-44.658,53.435-44.658,86.062c0,57.425,49.55,106.388,118.672,118.226c1.412,18.275-5.145,36.457-18.065,49.501 c-2.131,2.15-2.759,5.371-1.594,8.165s3.895,4.613,6.922,4.613c36.819,0,68.419-26.381,75.696-62.233 c32.012-5.464,61.188-19.345,82.664-39.423c23.402-21.881,36.291-49.883,36.291-78.849 C464.993,88.278,449.133,57.714,420.333,34.843z M338.297,225.194c-3.906,0.539-6.728,4.011-6.457,7.943 c0.004,0.058,0.009,0.115,0.014,0.172c-3.813,24.555-21.627,44.101-44.489,50.697c8.909-15.113,12.616-33.044,10.159-50.768 c0.003-0.035,0.005-0.069,0.008-0.104c0.271-3.934-2.551-7.404-6.456-7.944c-64.705-8.943-111.668-52.802-111.668-104.286 C179.407,62.509,240.1,15,314.7,15s135.293,47.509,135.293,105.904C449.993,172.399,403.018,216.259,338.297,225.194z"/> <path d="M264.365,112.904c-4.411,0-8,3.589-8,8s3.589,8,8,8s8-3.589,8-8S268.776,112.904,264.365,112.904z"/> <path d="M365.036,112.904c-4.411,0-8,3.589-8,8s3.589,8,8,8s8-3.589,8-8S369.448,112.904,365.036,112.904z"/> <path d="M314.7,112.904c-4.411,0-8,3.589-8,8s3.589,8,8,8s8-3.589,8-8S319.112,112.904,314.7,112.904z"/> <path d="M320.412,364.089c-21.68-21.679-44.469-39.643-45.428-40.396c-2.985-2.346-7.252-2.092-9.938,0.593l-28.422,28.423 l-92.282-92.283c-2.928-2.927-7.677-2.929-10.606,0c-2.929,2.93-2.929,7.678,0,10.607l97.585,97.586 c1.406,1.406,3.314,2.196,5.303,2.196s3.896-0.79,5.304-2.196l28.955-28.956c7.964,6.538,23.893,20.004,38.923,35.034 c15.068,15.067,28.587,31.068,35.104,39.008c-12.627,12.522-38.239,34.346-57.346,36.107 c-37.341,3.457-107.579-38.325-170.818-101.563C53.506,285.009,11.741,214.765,15.181,177.429 c1.761-19.106,23.586-44.72,36.107-57.345c7.94,6.517,23.94,20.035,39.009,35.104c15.015,15.015,28.49,30.954,35.033,38.923 l-28.955,28.954c-2.929,2.93-2.929,7.678,0,10.606l16.147,16.148c2.929,2.928,7.678,2.928,10.606,0 c2.929-2.93,2.929-7.678,0-10.606l-10.844-10.845l28.422-28.422c2.685-2.686,2.94-6.953,0.593-9.938 c-0.754-0.959-18.718-23.748-40.397-45.428c-21.679-21.679-44.468-39.643-45.428-40.396c-2.891-2.272-7.003-2.114-9.712,0.377 c-1.737,1.598-42.57,39.498-45.519,71.491c-3.881,42.121,38.675,115.584,105.894,182.804 c64.385,64.383,134.493,106.14,177.305,106.138c1.886,0,3.721-0.081,5.497-0.244c31.993-2.95,69.895-43.783,71.492-45.52 c2.49-2.707,2.65-6.82,0.377-9.713C360.056,408.558,342.092,385.768,320.412,364.089z"/> </g> </svg>
                                    </div>
                                    <div class="meta-info-child meta-info-detail">
                                        <h5 class="meta-info-title secondary-font"><?php esc_html_e( 'Telephone', 'business-insights' ); ?></h5>
                                        <a href="tel:<?php echo preg_replace( '/\D+/', '', esc_attr($top_header_telephone) ); ?>">
                                            <?php echo esc_attr($top_header_telephone); ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if (!empty($top_header_email)) { ?>
                            <div class="meta-info-col">
                                <div class="meta-info meta-info-email">
                                    <div class="meta-info-child meta-info-icon">
                                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"> <g> <g> <path d="M504.396,87.657h-79.583c-4.199,0-7.604,3.405-7.604,7.604s3.405,7.604,7.604,7.604h59.891L256,310.442L27.296,102.865 h362.031c4.199,0,7.604-3.405,7.604-7.604s-3.405-7.604-7.604-7.604H7.604C3.405,87.657,0,91.062,0,95.261v321.477 c0,4.199,3.405,7.604,7.604,7.604h496.792c4.199,0,7.604-3.405,7.604-7.604V95.261C512,91.061,508.595,87.657,504.396,87.657z M27.355,409.134l53.268-48.342c3.109-2.823,3.343-7.631,0.52-10.741c-2.823-3.109-7.631-3.343-10.741-0.52l-55.195,50.09V112.431 l158.217,143.601L95.45,326.798c-3.109,2.823-3.343,7.631-0.52,10.741s7.631,3.343,10.741,0.52l79.068-71.757l66.149,60.039 c1.451,1.317,3.281,1.974,5.112,1.974s3.661-0.658,5.111-1.974l66.15-60.04l157.385,142.833H27.355z M496.792,399.621 L338.575,256.032l158.217-143.601V399.621z"/> </g> </g> </svg>
                                    </div>
                                    <div class="meta-info-child meta-info-detail">
                                        <h5 class="meta-info-title secondary-font"><?php esc_html_e( 'Email', 'business-insights' ); ?></h5>
                                        <a href="mailto:<?php echo esc_attr( $top_header_email); ?>">
                                            <?php echo esc_attr( antispambot($top_header_email)); ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if (!empty($top_header_location)) { ?>
                            <div class="meta-info-col">
                                <div class="meta-info meta-info-map">
                                    <div class="meta-info-child meta-info-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"> <g> <g> <path d="M437.02,74.98C388.667,26.628,324.38,0,256,0S123.333,26.628,74.98,74.98C26.627,123.332,0,187.62,0,256 s26.628,132.667,74.98,181.02C123.332,485.373,187.62,512,256,512s132.667-26.628,181.02-74.98 C485.373,388.668,512,324.38,512,256S485.372,123.333,437.02,74.98z M49.656,131.369c28.081,6.666,58.108,11.902,89.403,15.629 c-7.388,31.55-11.532,66.062-12.046,101.49H15.15C16.426,206.57,28.357,166.49,49.656,131.369z M15.15,263.511h111.861 c0.597,41.868,6.171,82.042,16.152,117.692c-29.271,3.351-57.468,8.01-83.994,13.912C31.913,356.724,16.604,311.313,15.15,263.511 z M85.603,426.397c-5.8-5.8-11.264-11.847-16.391-18.112c24.852-5.27,51.155-9.431,78.373-12.464 c4.544,13.935,9.798,27.063,15.728,39.188c11.966,24.464,26.031,43.499,41.463,56.529 C159.959,481.885,118.791,459.585,85.603,426.397z M248.489,496.433c-26.686-3.775-51.901-27.585-71.681-68.025 c-5.192-10.616-9.838-22.058-13.923-34.169c27.859-2.634,56.567-4.078,85.604-4.292V496.433z M158.315,379.596 c-10.048-34.912-15.672-74.585-16.279-116.085h106.452v111.413h0.001C217.888,375.146,187.637,376.724,158.315,379.596z M248.488,248.489h-106.45c0.521-34.965,4.663-68.945,12.047-99.83c30.595,3.135,62.266,4.856,94.403,5.088V248.489z M248.489,138.722c-30.829-0.225-61.205-1.84-90.575-4.775c4.067-14.411,8.873-28.02,14.376-40.592 c1.664-3.801-0.068-8.23-3.868-9.893c-3.804-1.665-8.229,0.068-9.893,3.868c-6.082,13.894-11.341,28.99-15.736,44.979 c-29.47-3.444-57.798-8.242-84.398-14.331c8.032-11.448,17.114-22.282,27.208-32.376c33.178-33.177,74.33-55.474,119.131-65.132 c-10.441,8.844-20.288,20.479-29.348,34.799c-2.218,3.505-1.175,8.145,2.332,10.363c3.505,2.217,8.145,1.174,10.363-2.332 c21.771-34.409,43.816-45.367,60.408-47.734V138.722z M496.85,248.489H384.988c-0.508-35.642-4.624-70.055-11.994-101.496 c31.276-3.727,61.285-8.962,89.349-15.624C483.643,166.49,495.574,206.569,496.85,248.489z M426.397,85.603 c10.093,10.094,19.176,20.928,27.207,32.375c-26.585,6.085-54.896,10.882-84.35,14.326c-5.511-20.004-12.398-38.61-20.568-55.313 c-11.966-24.464-26.031-43.499-41.463-56.529C352.041,30.115,393.209,52.415,426.397,85.603z M335.192,83.592 c7.451,15.234,13.784,32.161,18.932,50.351c-29.383,2.937-59.772,4.553-90.612,4.779V15.567 C290.198,19.343,315.412,43.153,335.192,83.592z M263.511,153.746c32.151-0.232,63.838-1.954,94.448-5.092 c7.367,30.774,11.49,64.647,12.004,99.835H263.511V153.746z M263.511,496.439V389.947c29.012,0.214,57.695,1.655,85.532,4.284 c-7.603,22.578-17.038,42.561-27.844,58.636C308.853,471.237,289.197,492.818,263.511,496.439z M426.397,426.397 c-33.191,33.19-74.362,55.491-119.183,65.143c9.34-7.899,18.208-18.024,26.455-30.293c12.237-18.205,22.595-40.322,30.755-65.426 c27.215,3.033,53.516,7.193,78.365,12.464C437.661,414.549,432.197,420.597,426.397,426.397z M452.83,395.116 c-26.526-5.902-54.725-10.562-83.997-13.913c3.861-13.841,7.092-28.464,9.639-43.744c0.683-4.092-2.081-7.962-6.173-8.644 c-4.101-0.69-7.962,2.082-8.644,6.173c-2.587,15.515-5.972,30.471-10.044,44.6c-29.298-2.867-59.524-4.442-90.1-4.664V263.511 h106.451c-0.187,12.572-0.833,25.109-1.944,37.365c-0.374,4.131,2.672,7.784,6.803,8.159c0.231,0.021,0.46,0.03,0.687,0.03 c3.842,0,7.118-2.932,7.472-6.834c1.151-12.703,1.819-25.696,2.007-38.721H496.85C495.396,311.313,480.087,356.724,452.83,395.116 z"></path> </g> </g> </svg>
                                    </div>
                                    <div class="meta-info-child meta-info-detail">
                                        <h5 class="meta-info-title secondary-font"><?php esc_html_e( 'Location', 'business-insights' ); ?></h5>
                                        <?php echo esc_html($top_header_location); ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <a href="javascript:void(0)" class="close-popup-1 hidden-sm hidden-md hidden-lg"></a>
                            <a class="twp-nulanchor" href="javascript:void(0)"></a>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div id="nav-affix" class="top-header">
            <div class="container">
                <nav class="main-navigation" role="navigation">
                    
                    <a href="javascript:void(0)" class="skip-link-menu-start-2"></a>

                    <a href="javascript:void(0)" class="toggle-menu" aria-controls="primary-menu" aria-expanded="false">
                        <span class="screen-reader-text"><?php esc_html_e('Primary Menu', 'business-insights'); ?></span>
                        <i class="ham"></i>
                    </a>

                    <?php wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id' => 'primary-menu',
                        'container' => 'div',
                        'container_class' => 'menu'
                    )); ?>
                    
                    <a href="javascript:void(0)" class="skip-link-menu-end"></a>

                    <div class="nav-right">
                        <?php if (1 == business_insights_get_option ('enable_search_option')) { ?>
                            <a href="javascript:void(0)" class="icon-search header-icon">
                                <i class="icon_search"></i>
                            </a>
                        <?php } ?>

                        <a href="javascript:void(0)" class="icon-location header-icon hidden-sm hidden-md hidden-lg">
                            <i class="icon_pin_alt"></i>
                        </a>

                        <div class="social-icons">
                            <?php
                            wp_nav_menu(
                                array('theme_location' => 'social',
                                    'link_before' => '<span>',
                                    'link_after' => '</span>',
                                    'menu_id' => 'social-menu',
                                    'fallback_cb' => false,
                                    'menu_class' => false
                                )); ?>
                        </div>
                    </div>
                </nav><!-- #site-navigation -->
            </div>
        </div>

    </header>
    <!-- #masthead -->
    <div class="popup-search">
        
        <div class="table-align">
            <div class="table-align-cell v-align-middle">
                <a href="javascript:void(0)" class="skpi-link-search-start"></a>
                <a href="javascript:void(0)" class="close-popup"></a>
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>


    <?php
    if (! is_page_template( 'front-page-template.php' )) {
        if (is_front_page() || is_home()) {
            do_action('business_insights_action_slider_post');
        } else {
            do_action('business-insights-page-inner-title');
        }
    }
    ?>

    <div id="content" class="site-content">