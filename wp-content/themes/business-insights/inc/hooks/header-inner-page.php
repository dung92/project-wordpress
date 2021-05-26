<?php
global $post;
if (!function_exists('business_insights_single_page_title')) :
    function business_insights_single_page_title()
    {
        global $post;
        $global_banner_image = get_header_image();
        
        // Check if single.
        if (is_singular()) {

            $banner_heading_single_post = get_post_meta($post->ID, 'business-insights-meta-banner-checkbox', true);
            if ($banner_heading_single_post) {
                return;
            }
            
            if (has_post_thumbnail($post->ID)) {
                $banner_image_single_post = get_post_meta($post->ID, 'business-insights-meta-checkbox', true);
                if ( $banner_image_single_post) {
                    $banner_image_array = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'business-insights-header-image');
                    $global_banner_image = $banner_image_array[0];
                }
            }
        }
        ?>

        <div class="wrapper page-inner-title inner-banner data-bg" data-background="<?php echo esc_url($global_banner_image); ?>">
            <header class="entry-header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10">
                            <?php if (is_singular()) { ?>
                                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                                
                                <?php if( !is_page() ){ ?>
                                    <div class="inner-meta-info">
                                        <?php business_insights_posted_details(); ?>
                                    </div>
                                <?php  } ?>
                                
                            <?php } elseif (is_404()) { ?>
                                <h1 class="entry-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'business-insights'); ?></h1>
                            <?php } elseif (is_archive()) {
                                the_archive_title('<h1 class="entry-title">', '</h1>'); ?>
                                <?php the_archive_description('<div class="taxonomy-description">', '</div>');
                            } elseif (is_search()) { ?>
                                <h1 class="entry-title"><?php printf(esc_html__('Search Results for: %s', 'business-insights'), '<span>' . get_search_query() . '</span>'); ?></h1>
                            <?php }
                            
                            /**
                             * Hook - business_insights_add_breadcrumb.
                             */
                            do_action('business_insights_action_breadcrumb');
                            ?>
                        </div>
                    </div>
                </div>
            </header><!-- .entry-header -->
            <?php 
            $enable_overlay_option = business_insights_get_option('enable_overlay_option');
            if ($enable_overlay_option == 1) { ?>
                <div class="overlay-bg overlay-bg-enable"></div>     
            <?php } ?>
        </div>

        <?php
    }
endif;
add_action('business-insights-page-inner-title', 'business_insights_single_page_title', 15);
