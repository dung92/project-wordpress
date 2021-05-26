<?php
if (!function_exists('business_insights_blog')) :
    /**
     * blog
     *
     * @since business_insights 1.0.0
     *
     */
    function business_insights_blog()
    {
        $business_insights_blog_excerpt_number = absint(business_insights_get_option('number_of_content_home_latest_blog'));
        $business_insights_blog_category = esc_attr(business_insights_get_option('select_category_for_latest_blog'));
        if (1 != business_insights_get_option('show_latest_blog_section')) {
            return null;
        }
        ?>
        <section class="section-block section-blog">
            <div class="container">
                <header class="article-header">
                    <h2 class="entry-title entry-title-2">
                        <?php echo esc_html(business_insights_get_option('title_latest_blog_section')); ?>
                    </h2>
                </header>
            </div>
            <div class="container">
                <div class="row">
                    <?php
                        $business_insights_home_blog_args = array(
                            'post_type' => 'post',
                            'posts_per_page' => 3,
                            'cat' => $business_insights_blog_category,
                        );
                        $business_insights_home_about_post_query = new WP_Query($business_insights_home_blog_args);
                        if ($business_insights_home_about_post_query->have_posts()) :
                            while ($business_insights_home_about_post_query->have_posts()) : $business_insights_home_about_post_query->the_post();
                                if (has_post_thumbnail()) {
                                    $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'large');
                                    $url = $thumb['0'];
                                } else {
                                    $url = '';
                                }
                                if (has_excerpt()) {
                                    $business_insights_blog_content = get_the_excerpt();
                                } else {
                                    $business_insights_blog_content = business_insights_words_count($business_insights_blog_excerpt_number, get_the_content());
                                }
                                ?>
                                    <div class="col-md-4 col-sm-4">
                                        <div class="blog-post-item">
                                            <div class="blog-post-img">
                                                <a href="<?php the_permalink(); ?>">
                                                    <img src="<?php echo esc_url($url); ?>">
                                                </a>
                                            </div>
                                            <div class="blog-post-detail">
                                                <span class="blog-post-date"> <?php echo esc_attr(get_the_date('M j, Y')); ?></span>
                                                <h3 class="block-title">
                                                    <a href="<?php the_permalink(); ?>"><?php the_title();?></a>
                                                </h3>
                                                <p class="blog-post-desc"><?php echo wp_kses_post($business_insights_blog_content); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                wp_reset_postdata();
                            endwhile;
                        endif;
                        ?>
                </div>
            </div>
        </section>
        <?php
    }
endif;
add_action('business_insights_action_front_page_blog', 'business_insights_blog', 70);