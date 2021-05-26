<?php
if (!function_exists('business_insights_intro_section')) :
    /**
     * Tab intro Details
     *
     * @since business-insights 1.0.0
     *
     */
    function business_insights_intro_section()
    {
        $business_insights_intro_button_enable = business_insights_get_option('show_page_link_button');
        $business_insights_intro_button_text = business_insights_get_option('intro_button_text');
        $business_insights_intro_button_url = business_insights_get_option('intro_button_link');
        $business_insights_intro_excerpt_number = absint(business_insights_get_option('number_of_content_home_intro'));
        $business_insights_intro_page = array();
        $business_insights_intro_page[] = absint(business_insights_get_option('select_intro_page'));
        if (1 != business_insights_get_option('show_our_intro_section')) {
            return null;
        }
        if (!empty($business_insights_intro_page)) {
            $business_insights_intro_page_args = array(
                'post_type' => 'page',
                'post__in' => $business_insights_intro_page,
                'orderby' => 'post__in'
            );
        }
        if (!empty($business_insights_intro_page_args)) {
            $business_insights_intro_page_query = new WP_Query($business_insights_intro_page_args);
            while ($business_insights_intro_page_query->have_posts()): $business_insights_intro_page_query->the_post();
                if (has_excerpt()) {
                    $business_insights_intro_main_content = get_the_excerpt();
                } else {
                    $business_insights_intro_main_content = business_insights_words_count($business_insights_intro_excerpt_number , get_the_content());
                }
                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                $url = $thumb['0'];
                ?>
                <!--intro section Starts-->
                <section class="section-block section-about">
                    <div class="container">
                        <?php $align_image_intro_section = business_insights_get_option('align_image_intro_section');
                            if ($align_image_intro_section == 'img-right') {
                                $section_img_align = 'row-rtl';
                            } else {
                                $section_img_align = '';
                            }
                         ?>
                        <div class="row row-table <?php echo esc_attr($section_img_align); ?>">
                            <div class="col-md-7 col-sm-12">
                                <div class="intro-wrapper">
                                    <?php if (has_post_thumbnail()){ ?> 
                                        <img src="<?php echo esc_url($url); ?>">
                                    <?php } ?>
                                    <div class="intro-content">
                                        <header class="article-header">
                                            <h2 class="entry-title entry-title-1"><?php the_title(); ?></h2>
                                        </header>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 col-sm-12">
                                <div class="intro-details">
                                        <?php echo wp_kses_post($business_insights_intro_main_content); ?>
                                        <div class="btn-group clearfix">
                                            <?php if (!empty($business_insights_intro_button_text)) { ?>
                                                    <a href="<?php echo esc_url($business_insights_intro_button_url ); ?>" class="btn-link btn-link-small btn-link-primary">
                                                        <?php echo esc_html($business_insights_intro_button_text); ?>
                                                    </a>
                                                <?php } ?>
                                                <?php if ($business_insights_intro_button_enable == 1) { ?>
                                                    <a href="<?php the_permalink();?>" class="btn-link btn-link-small btn-link-secondary">
                                                        <?php _e( 'View More', 'business-insights' ); ?>
                                                    </a>
                                            <?php } ?>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!--intro section Ends-->
            <?php endwhile;
            wp_reset_postdata();
        } ?>
        <?php
    }
endif;
add_action('business_insights_action_front_page_intro', 'business_insights_intro_section', 20);