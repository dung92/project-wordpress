<?php
if (!function_exists('business_insights_process_args')) :
    /**
     * Tab Intro Details
     *
     * @since business-insights 1.0.0
     *
     * @return array $qargs Intro details.
     */
    function business_insights_process_args()
    {
        $business_insights_process_page_list_array = array();
        for ($i = 1; $i <= 6; $i++) {
            $business_insights_process_page_list = business_insights_get_option('select_page_for_process_' . $i);
            if (!empty($business_insights_process_page_list)) {
                $business_insights_process_page_list_array[] = absint($business_insights_process_page_list);
            }
        }
        // Bail if no valid pages are selected.
        if (empty($business_insights_process_page_list_array)) {
            return;
        }
        /*page query*/
        $qargs = array(
            'posts_per_page' => 6,
            'orderby' => 'post__in',
            'post_type' => 'page',
            'post__in' => $business_insights_process_page_list_array,
        );
        return $qargs;
    }
endif;

if (!function_exists('business_insights_process')) :
    /**
     * Banner Intro
     *
     * @since business-insights 1.0.0
     *
     */
    function business_insights_process()
    {
        $business_insights_process_excerpt_number = absint(business_insights_get_option('number_of_content_home_process'));
        $business_insights_process_main_title = '';
        if (1 != business_insights_get_option('show_our_process_section')) {
            return null;
        } ?>
        <!-- page-section:starts -->

            <section class="section-block section-process">
                <div class="container">
                    <header class="article-header">
                        <h2 class="entry-title entry-title-2">
                            <?php echo wp_kses_post(business_insights_get_option('title_process_section')); ?>
                        </h2>
                    </header>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="item-block-wrapper">
                        <?php $business_insights_process_args = business_insights_process_args();
                        $business_insights_process_query = new WP_Query($business_insights_process_args);
                        $j = 1;
                        if ($business_insights_process_query->have_posts()) :
                            while ($business_insights_process_query->have_posts()) : $business_insights_process_query->the_post();
                                if (has_excerpt()) {
                                    $business_insights_process_content = get_the_excerpt();
                                } else {
                                    $business_insights_process_content = business_insights_words_count($business_insights_process_excerpt_number, get_the_content());
                                }
                                $business_insights_process_icon = business_insights_get_option('number_of_home_process_icon_' . $j);
                                ?>
                                    <div class="col-md-4 col-sm-4">
                                        <div class="item-block item-block-1">
                                            <div class="icon btn-link-secondary">
                                                <i class="icon <?php echo esc_attr($business_insights_process_icon); ?>"></i>
                                            </div>
                                            <div class="feature-content">
                                                <h3 class="block-title"><a href= "<?php the_permalink();?>"><?php the_title(); ?></a></h3>
                                                <p><?php echo esc_html($business_insights_process_content); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                $j++;
                            endwhile;
                            wp_reset_postdata();
                        endif; ?>
                        </div>
                    </div>
                </div>
            </section>


        <?php
    }
endif;
add_action('business_insights_action_process_Section', 'business_insights_process',  60);
