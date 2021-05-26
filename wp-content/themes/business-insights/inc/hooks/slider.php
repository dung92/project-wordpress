<?php
if (!function_exists('business_insights_banner_slider_args')) :
    /**
     * Banner Slider Details
     *
     * @since Business Insights 1.0.0
     *
     * @return array $qargs Slider details.
     */
    function business_insights_banner_slider_args()
    {
        $business_insights_banner_slider_number = absint(business_insights_get_option('number_of_home_slider'));
        $business_insights_banner_slider_from = esc_attr(business_insights_get_option('select_slider_from'));
        switch ($business_insights_banner_slider_from) {
            case 'from-page':
                $business_insights_banner_slider_page_list_array = array();
                for ($i = 1; $i <= $business_insights_banner_slider_number; $i++) {
                    $business_insights_banner_slider_page_list = business_insights_get_option('select_page_for_slider_' . $i);
                    if (!empty($business_insights_banner_slider_page_list)) {
                        $business_insights_banner_slider_page_list_array[] = absint($business_insights_banner_slider_page_list);
                    }
                }
                // Bail if no valid pages are selected.
                if (empty($business_insights_banner_slider_page_list_array)) {
                    return;
                }
                /*page query*/
                $qargs = array(
                    'posts_per_page' => absint($business_insights_banner_slider_number),
                    'post_type' => 'page',
                    'post__in' => $business_insights_banner_slider_page_list_array,
                );
                return $qargs;
                break;

            case 'from-category':
                $business_insights_banner_slider_category = absint(business_insights_get_option('select_category_for_slider'));
                $qargs = array(
                    'posts_per_page' => absint($business_insights_banner_slider_number),
                    'post_type' => 'post',
                    'cat' => absint($business_insights_banner_slider_category),
                );
                return $qargs;
                break;

            default:
                break;
        }
        ?>
        <?php
    }
endif;


if (!function_exists('business_insights_banner_slider')) :
    /**
     * Banner Slider
     *
     * @since Business Insights 1.0.0
     *
     */
    function business_insights_banner_slider()
    {
        $business_insights_slider_button_text = esc_html(business_insights_get_option('button_text_on_slider'));
        $business_insights_slider_excerpt_number = absint(business_insights_get_option('number_of_content_home_slider'));
        if (1 != business_insights_get_option('show_slider_section')) {
            return null;
        }
        $business_insights_banner_slider_args = business_insights_banner_slider_args();
        $business_insights_banner_slider_query = new WP_Query($business_insights_banner_slider_args); ?>
        <section class="twp-slider-wrapper">
            <div class="twp-slider">
                <?php
                if ($business_insights_banner_slider_query->have_posts()) :
                    while ($business_insights_banner_slider_query->have_posts()) : $business_insights_banner_slider_query->the_post();
                        if (has_excerpt()) {
                            $business_insights_slider_content = get_the_excerpt();
                        } else {
                            $business_insights_slider_content = business_insights_words_count($business_insights_slider_excerpt_number, get_the_content());
                        }
                        ?>
                        <div class="single-slide">
                            <?php if (has_post_thumbnail()) {
                                $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                                $url = $thumb['0'];  ?>
                                <div class="slide-bg bg-image animated">
                                    <img src="<?php echo esc_url($url); ?>">
                                </div>
                            <?php } ?>
                            <div class="slide-text animated secondary-textcolor">
                                <div class="table-align">
                                    <div class="table-align-cell v-align-bottom">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-10 col-sm-12">
                                                    <div class="layer layer-fadeInLeft">
                                                        <h2 class="slide-title"><?php the_title(); ?></h2>
                                                    </div>
                                                    <div class="layer layer-fadeInRight visible hidden-xs">
                                                        <?php if ($business_insights_slider_excerpt_number != 0) { ?>
                                                            <?php echo wp_kses_post($business_insights_slider_content); ?>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="layer layer-fadeInUp">
                                                        <a href="<?php the_permalink(); ?>"
                                                           class="btn-link btn-link-primary">
                                                            <?php echo esc_html($business_insights_slider_button_text); ?>
                                                            <i class="ion-ios-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif; ?>
            </div>
        </section>
        <!-- end slider-section -->
        <?php
    }
endif;
add_action('business_insights_action_slider_post', 'business_insights_banner_slider', 10);