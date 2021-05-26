<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Business Insights
 */
?>
</div><!-- #content -->

<footer id="colophon" class="site-footer" role="contentinfo">
    <?php $business_insights_footer_widgets_number = business_insights_get_option('number_of_footer_widget');
    if ($business_insights_footer_widgets_number != 0) {?>
                <?php
                if (1 == $business_insights_footer_widgets_number) {
                    $col = 'col-md-12';
                } elseif (2 == $business_insights_footer_widgets_number) {
                    $col = 'col-md-6';
                } elseif (3 == $business_insights_footer_widgets_number) {
                    $col = 'col-md-4';
                } elseif (4 == $business_insights_footer_widgets_number) {
                    $col = 'col-md-3';
                } else {
                    $col = 'col-md-3';
                }
                if (is_active_sidebar('footer-col-one') || is_active_sidebar('footer-col-two') || is_active_sidebar('footer-col-three') || is_active_sidebar('footer-col-four')) {?>
                    <div class="footer-widget">
                        <div class="container">
                            <div class="row">
                                <?php if (is_active_sidebar('footer-col-one') && $business_insights_footer_widgets_number > 0):?>
                                    <div class="contact-list <?php echo $col;?>">
                                        <?php dynamic_sidebar('footer-col-one');?>
                                    </div>
                                <?php endif;?>
                                <?php if (is_active_sidebar('footer-col-two') && $business_insights_footer_widgets_number > 1):?>
                                    <div class="contact-list <?php echo $col;?>">
                                        <?php dynamic_sidebar('footer-col-two');?>
                                    </div>
                                <?php endif;?>
                                <?php if (is_active_sidebar('footer-col-three') && $business_insights_footer_widgets_number > 2):?>
                                    <div class="contact-list <?php echo $col;?>">
                                        <?php dynamic_sidebar('footer-col-three');?>
                                    </div>
                                <?php endif;?>
                                <?php if (is_active_sidebar('footer-col-four') && $business_insights_footer_widgets_number > 3):?>
                                    <div class="contact-list <?php echo $col;?>">
                                        <?php dynamic_sidebar('footer-col-four');?>
                                    </div>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                <?php }?>
    <?php }?>
    <div class="copyright-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="site-info">
                        <h4 class="site-copyright secondary-font">
                            <?php
                            $business_insights_copyright_text = wp_kses_post(business_insights_get_option('copyright_text'));
                            if (!empty($business_insights_copyright_text)) {
                                echo wp_kses_post(business_insights_get_option('copyright_text'));
                            }
                            ?>
                            <?php printf(esc_html__('Theme: %1$s by %2$s', 'business-insights'), 'Business Insights', '<a href="http://themeinwp.com/" target = "_blank" rel="designer">Themeinwp </a>');?>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
<div class="scroll-up alt-bgcolor">
    <i class="arrow_carrot-up"></i>
</div>
<?php wp_footer();?>
</body>
</html>