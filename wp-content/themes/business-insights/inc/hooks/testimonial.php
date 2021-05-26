<?php
if (!function_exists('business_insights_testimonial_args')) :
    /**
     * Testimonial Details
     *
     * @since business-insights 1.0.0
     *
     * @return array $qargs testimonial details.
     */
    function business_insights_testimonial_args()
    {
        $business_insights_testimonial_number = absint(business_insights_get_option('number_of_home_testimonial'));
        $business_insights_testimonial_from = esc_attr(business_insights_get_option('select_testimonial_from'));
        switch ($business_insights_testimonial_from) {
            case 'from-page':
                $business_insights_testimonial_page_list_array = array();
                for ($i = 1; $i <= $business_insights_testimonial_number; $i++) {
                    $business_insights_testimonial_page_list = business_insights_get_option('select_page_for_testimonial_' . $i);
                    if (!empty($business_insights_testimonial_page_list)) {
                        $business_insights_testimonial_page_list_array[] =  absint($business_insights_testimonial_page_list);
                    }
                }
                // Bail if no valid pages are selected.
                if (empty($business_insights_testimonial_page_list_array)) {
                    return;
                }
                /*page query*/
                $qargs = array(
                    'posts_per_page' => absint($business_insights_testimonial_number),
                    'orderby' => 'post__in',
                    'post_type' => 'page',
                    'post__in' => $business_insights_testimonial_page_list_array,
                );
                return $qargs;
                break;

            case 'from-category':
                $business_insights_testimonial_category = absint(business_insights_get_option('select_category_for_testimonial'));
                $qargs = array(
                    'posts_per_page' => absint($business_insights_testimonial_number),
                    'post_type' => 'post',
                    'cat' => $business_insights_testimonial_category,
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


if (!function_exists('business_insights_testimonial')) :
    /**
     * Testimonial
     *
     * @since business-insights 1.0.0
     *
     */
    function business_insights_testimonial()
    {
        $business_insights_testimonial_excerpt_number = absint(business_insights_get_option('number_of_content_home_testimonial'));
        if (1 != business_insights_get_option('show_testimonial_section')) {
            return null;
        }
        $business_insights_testimonial_args = business_insights_testimonial_args();
        $business_insights_testimonial_query = new WP_Query($business_insights_testimonial_args); ?>
        <section class="section-block section-testimonial text-center data-bg" data-background="<?php echo esc_url(business_insights_get_option('testimonial_section_background_image')); ?>">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <header class="article-header">
                            <h2 class="entry-title entry-title-2">
                                <?php echo wp_kses_post(business_insights_get_option('title_testimonial_section')); ?>
                            </h2>
                        </header>
                        <div class="clearfix"></div>
                        <div class="testimonial-container">
                            <div class="owl-carousel twp-testimonial testimonial-slide">
                                <?php
                                if ($business_insights_testimonial_query->have_posts()) :
                                    while ($business_insights_testimonial_query->have_posts()) : $business_insights_testimonial_query->the_post();
                                        if (has_post_thumbnail()) {
                                            $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'medium');
                                            $url = $thumb['0'];
                                        } else {
                                            $url = get_template_directory_uri() . '/images/no-image.jpg';
                                        }
                                        if (has_excerpt()) {
                                            $business_insights_testimonial_content = get_the_excerpt();
                                        } else {
                                            $business_insights_testimonial_content = business_insights_words_count($business_insights_testimonial_excerpt_number, get_the_content());
                                        }
                                        ?>
                                        <div class="testimonial-item">
                                            <div class="team-wrap">
                                                <div class="img-block bg-image twp-team-image">
                                                    <img src="<?php echo esc_url($url); ?>" alt="" class="img-circle"/>
                                                </div>
                                                <div class="testimonial-wrapper">
                                                    <h3 class="block-title">
                                                        <a href='<?php the_permalink(); ?>'><?php the_title(); ?></a>
                                                    </h3>
                                                    <p>
                                                        <?php echo wp_kses_post($business_insights_testimonial_content); ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    endwhile;
                                    wp_reset_postdata();
                                endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $enable_testimonial_overlay = business_insights_get_option('enable_testimonial_overlay');
            if ($enable_testimonial_overlay == 1) { ?>
                <div class="overlay-bg overlay-bg-enable"></div>
            <?php } ?>
        </section>
        <!-- End testimonial -->
        <?php
    }
endif;
add_action('business_insights_action_front_page_testimonial', 'business_insights_testimonial', 30);

