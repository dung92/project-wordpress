<?php
/**
 * CSS related hooks.
 *
 * This file contains hook functions which are related to CSS.
 *
 * @package Business Insights
 */

if (!function_exists('business_insights_trigger_custom_css_action')):

    /**
     * Do action theme custom CSS.
     *
     * @since 1.0.0
     */
    function business_insights_trigger_custom_css_action()
    {
        global $business_insights_google_fonts;
        $business_insights_enable_banner_overlay = business_insights_get_option('enable_overlay_option');
        $business_insights_enable_slider_overlay = business_insights_get_option('enable_slider_overlay');
        $business_insights_enable_calback_overlay = business_insights_get_option('enable_calback_overlay');
        $business_insights_enable_testimonial_overlay = business_insights_get_option('enable_testimonial_overlay');
        $business_insights_site_title_font = business_insights_get_option('site_title_font');

        ?>
        <style type="text/css">
            <?php
            if ($business_insights_enable_banner_overlay == 1) { ?>
                body .inner-banner .overlay-bg-enable{
                    filter: alpha(opacity=54);
                    opacity: 0.54;
                }
            <?php } ?>

            <?php
            if ($business_insights_enable_slider_overlay == 1) { ?>
                body .single-slide:after{
                    filter: alpha(opacity=54);
                    opacity: 0.54;
                }
                body .single-slide:after{
                   content: "";
                }
            <?php } ?>
            <?php
            if ($business_insights_enable_calback_overlay == 1) { ?>
                body .section-cta .overlay-bg-enable{
                    filter: alpha(opacity=54);
                    opacity: 0.54;
                }
            <?php } ?>
            <?php
            if ($business_insights_enable_testimonial_overlay == 1) { ?>
            body .section-testimonial .overlay-bg-enable{
                filter: alpha(opacity=64);
                opacity: 0.64;
            }
            <?php } ?>


            <?php
            if (!empty ($business_insights_site_title_font)) { ?>
                @media only screen and (min-width: 992px) {
                    .site-branding .site-title a {
                        font-size: <?php echo esc_html($business_insights_site_title_font); ?>px !important;
                    }
                }
            <?php } ?>


        </style>

    <?php }

endif;