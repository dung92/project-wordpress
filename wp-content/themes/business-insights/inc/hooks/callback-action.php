<?php
if (!function_exists('business_insights_callback_section')) :
    /**
     * Tab callback Details
     *
     * @since business-insights 1.0.0
     *
     */
    function business_insights_callback_section()
    {
        $business_insights_callback_button_enable = business_insights_get_option('show_page_link_button');
        $business_insights_callback_button_text = business_insights_get_option('callback_button_text');
        $business_insights_callback_layout_option = business_insights_get_option('calback_layout_option');
        $business_insights_callback_button_url = business_insights_get_option('callback_button_link');
        $business_insights_callback_excerpt_number = absint(business_insights_get_option('number_of_content_home_callback'));
        $business_insights_callback_page = array();
        $business_insights_callback_page[] = absint(business_insights_get_option('select_callback_page'));
        if (1 != business_insights_get_option('show_our_callback_section')) {
            return null;
        }
        if (!empty($business_insights_callback_page)) {
            $business_insights_callback_page_args = array(
                'post_type' => 'page',
                'post__in' => $business_insights_callback_page,
                'orderby' => 'post__in'
            );
        }
        if (!empty($business_insights_callback_page_args)) {
            $business_insights_callback_page_query = new WP_Query($business_insights_callback_page_args);
            while ($business_insights_callback_page_query->have_posts()): $business_insights_callback_page_query->the_post();
                if (has_excerpt()) {
                    $business_insights_callback_main_content = get_the_excerpt();
                } else {
                    $business_insights_callback_main_content = business_insights_words_count($business_insights_callback_excerpt_number , get_the_content());
                }
                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                $url = $thumb['0'];
                ?>
                <!--CTA Starts-->
                <?php if ($business_insights_callback_layout_option == "center") {
                    $callback_text_alignment = "text-center";
                } elseif ($business_insights_callback_layout_option == "left"){
                    $callback_text_alignment = "text-left";
                } else {
                    $callback_text_alignment = "text-right";
                }?>
                <section class="section-cta section-block data-bg section-parallex <?php echo esc_attr($callback_text_alignment) ?>" data-background="<?php if (has_post_thumbnail()){ echo esc_url($url); } ?>">
                    <div class="container container-sm">
                        <div class="row">
                            <div class="col-sm-12">
                                <header class="article-header">
                                    <h2 class="entry-title entry-title-2">
                                        <?php the_title(); ?>
                                    </h2>
                                </header>

                                <div class="cta-details"><?php echo esc_html($business_insights_callback_main_content); ?></div>

                                <div class="cta-btns-group">
                                    <?php if (!empty($business_insights_callback_button_text)) { ?>
                                        <a href="<?php echo esc_url($business_insights_callback_button_url ); ?>" class="btn-link btn-link-primary"><?php echo esc_html($business_insights_callback_button_text); ?></a>
                                    <?php } ?>
                                    <?php if ($business_insights_callback_button_enable == 1) { ?>
                                        <a href="<?php the_permalink();?>" class="btn-link btn-link-secondary"><?php esc_html_e( 'View More', 'business-insights' ); ?></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                    $enable_calback_overlay = business_insights_get_option('enable_calback_overlay');
                    if ($enable_calback_overlay == 1) { ?>
                        <div class="overlay-bg overlay-bg-enable"></div>     
                    <?php } ?>
                </section>
                <!--CTA Ends-->
            <?php endwhile;
            wp_reset_postdata();
        } ?>
        <?php
    }
endif;
add_action('business_insights_action_front_page_callback', 'business_insights_callback_section', 40);