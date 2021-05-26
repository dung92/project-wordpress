<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Business Insights
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="twp-article-wrapper clearfix">
    <?php if (!is_single()) { ?>
        <header class="article-header text-center">
            <div class="post-category secondary-font">
                <span class="meta-span">
                    <?php business_insights_entry_category(); ?>
                </span>
            </div>
            <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
            <div class="entry-meta text-uppercase">
                <?php business_insights_posted_details(); ?>
            </div><!-- .entry-meta -->
        </header>
    <?php } ?>

        <div class="entry-content twp-entry-content">
            <div class="twp-text-align">

                <?php if( is_single() ){
                    the_content();

                    if (!class_exists('Booster_Extension_Class')) {

                        wp_link_pages(array(
                            'before' => '<div class="page-links">'.esc_html__('Pages:', 'business-insights'),
                            'after'  => '</div>',
                        ));

                    }

                }else{

                     the_excerpt(); ?>
                    <?php
                    $read_more_text = esc_html(business_insights_get_option('read_more_button_text'));
                    if (!empty($read_more_text)) {
                        ?><a href="<?php the_permalink(); ?>" class="btn-link btn-link-primary"><?php echo esc_html($read_more_text); ?><i class="ion-ios-arrow-right"></i></a><?php
                    }

                } ?>

            </div>
        </div><!-- .entry-content -->
        <?php if (is_single()) { ?>
            <div class="single-meta">
            <?php if (has_category('',$post->ID)) { ?>
                <footer class="entry-footer">
                    <?php business_insights_entry_category(); ?>
                </footer><!-- .entry-footer -->
            <?php } ?>
            <?php if(has_tag()) { ?>
                <div class="post-tags">
                    <?php business_insights_entry_tags(); ?>
                </div>
            <?php } ?>
            </div>
        <?php } ?>
    </div>
</article><!-- #post-## -->
