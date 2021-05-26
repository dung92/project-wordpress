<?php
/**
 * Welcome Page View
 *
 * Welcome page content i.e. HTML/CSS/PHP.
 *
 * @since 	1.0.0
 * @package SHOPMAGIC
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="wrap about-wrap">

	<h1><?php printf( __( 'ShopMagic %s' ), SHOPMAGIC_VERSION ); ?></h1>

	<div class="about-text">
		<?php _e( 'WooCommerce marketing automation to make you more money', 'shopmagic-for-woocommerce' ); ?>
	</div>

	<div class="point-releases">
		<h3><?php _e( 'Getting Started', 'shopmagic-for-woocommerce' ); ?></h3>

		<p><strong><?php _e( 'Step #1:', 'shopmagic-for-woocommerce' ); ?></strong> <?php printf( __( 'Start by creating a %snew Automation &rarr;%s', 'shopmagic-for-woocommerce' ), '<a href="' . admin_url( 'post-new.php?post_type=shopmagic_automation' ) . '" target="blank">', '</a>' ); ?></p>
        <p><strong><?php _e( 'Step #2:', 'shopmagic-for-woocommerce' ); ?></strong> <?php _e( 'Choose an Event to trigger your automation. Example: Order Completed.', 'shopmagic-for-woocommerce' ); ?></p>
        <p><strong><?php _e( 'Step #3:', 'shopmagic-for-woocommerce' ); ?></strong> <?php _e( 'Choose an Action you\'d like to happen. Example: Send Email. Now write a follow-up email to their order.', 'shopmagic-for-woocommerce' ); ?></p>
        <p><strong><?php _e( 'You Got It!', 'shopmagic-for-woocommerce' ); ?></strong> <?php _e( 'So now when a customer makes a purchase, ShopMagic will send them an automatic email congratulating them and thanking them for their purchase.', 'shopmagic-for-woocommerce' ); ?></p>
	</div>

    <div class="feature-section has-3-columns is-fullwidth">
	    <div class="column">
	        <h3><?php _e( 'How to set up your first automation', 'shopmagic-for-woocommerce' ); ?></h3>

            <iframe width="310" height="174" src="https://www.youtube.com/embed/pSgCunkz02Q" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
	    </div>

        <div class="column">
            <h3><?php _e( 'How to send automated thank you emails', 'shopmagic-for-woocommerce' ); ?></h3>

            <iframe width="310" height="174" src="https://www.youtube.com/embed/-vImrWtAEZ0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        </div>

        <div class="column">
            <h3><?php _e( 'How to design customized order confirmation emails', 'shopmagic-for-woocommerce' ); ?></h3>

            <iframe width="310" height="174" src="https://www.youtube.com/embed/7rPE32DUq1o" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        </div>

        <p>&nbsp;</p>
    </div>

    <?php if ( ! $this->is_pro_active ) : ?>
        <div class="feature-section has-1-columns">
            <h2><?php _e( 'Do more with ShopMagic PRO', 'shopmagic-for-woocommerce' ); ?></h2>

            <p class="lead-description"><?php _e( 'We\'ve built a powerful platform that works to accomplish automation for your store in order to help you make more money and scale your business.', 'shopmagic-for-woocommerce' ); ?></p>
        </div>

	    <div class="feature-section has-3-columns is-fullwidth">
            <div class="column">
                <h2 class="dashicons dashicons-clock"></h2>

                <h3><?php _e( 'Delayed Actions', 'shopmagic-for-woocommerce' ); ?></h3>

                <p><?php _e( 'Allows automations delay by minutes, hours, days or weeks after the original event or last action.', 'shopmagic-for-woocommerce' ); ?></h2></p>
            </div>

            <div class="column">
                <h2 class="dashicons dashicons-thumbs-up"></h2>

                <h3><?php _e( 'Review Requests', 'shopmagic-for-woocommerce' ); ?></h3>

                <p><?php _e( 'Adds review requests with direct links to products purchased in order for customers to review.', 'shopmagic-for-woocommerce' ); ?></h2></p>
            </div>

            <div class="column">
                <h2 class="dashicons dashicons-tag"></h2>

                <h3><?php _e( 'Customer Coupons', 'shopmagic-for-woocommerce' ); ?></h3>

                <p><?php _e( 'Adds ability to create personalized coupon codes for customers and send them automatically.', 'shopmagic-for-woocommerce' ); ?></h2></p>
            </div>
	    </div>

        <div class="feature-section has-4-columns is-fullwidth">
            <div class="column">
                <h2 class="dashicons dashicons-email-alt"></h2>

                <h3><?php _e( 'Add to Mailing List', 'shopmagic-for-woocommerce' ); ?></h3>

                <p><?php _e( 'Adds ability to subscribe customers to mailing lists in ActiveCampaign and AWeber upon checkout.', 'shopmagic-for-woocommerce' ); ?></h2></p>
            </div>

            <div class="column">
                <h2 class="dashicons dashicons-buddicons-groups"></h2>

                <h3><?php _e( 'After Purchase Upsells', 'shopmagic-for-woocommerce' ); ?></h3>

                <p><?php _e( 'Allows to redirect customers after purchase to a custom thank you page and show an upsell.', 'shopmagic-for-woocommerce' ); ?></h2></p>
            </div>

            <div class="column">
                <h2 class="dashicons dashicons-cart"></h2>

                <h3><?php _e( 'Abandoned Carts', 'shopmagic-for-woocommerce' ); ?></h3>

                <p><?php _e( 'Allows to save customer details on a partial WooCommerce purchase and send abandoned cart emails.', 'shopmagic-for-woocommerce' ); ?></h2></p>

                <p><small><span class="dashicons dashicons-admin-tools"></span> <?php _e( 'In development', 'shopmagic-for-woocommerce' ); ?></small></p>
            </div>

            <div class="column">
                <h2 class="dashicons dashicons-products"></h2>

                <h3><?php _e( 'Recent Order Popups', 'shopmagic-for-woocommerce' ); ?></h3>

                <p><?php _e( 'Display popups on the frontend of your store each time a sale is made to encourage trust.', 'shopmagic-for-woocommerce' ); ?></p>

                <p><small><span class="dashicons dashicons-admin-tools"></span> <?php _e( 'In development', 'shopmagic-for-woocommerce' ); ?></small></p>
            </div>
	    </div>

		<?php
		if ( get_locale() === 'pl_PL' ) {
			$url = 'https://www.wpdesk.pl/sklep/shopmagic/';
		} else {
			$url = 'https://shopmagic.app/pricing/';
		}
		?>

        <div class="feature-section has-1-columns">
            <p>&nbsp;</p>
            <div class="lead-description"><a class="button button-primary button-hero" href="<?php echo $url; ?>?utm_source=welcome-screen&utm_medium=button&utm_campaign=shopmagic-welcome" target="blank" class="proButton"><?php _e( 'Get ShopMagic PRO', 'shopmagic-for-woocommerce' ); ?></a></div>
            <p>&nbsp;</p>
        </div>
    <?php endif; ?>

    <div class="feature-section has-1-columns">
        <h2><?php _e( 'Sign up to get ShopMagic updates!', 'shopmagic-for-woocommerce' ); ?></h2>

        <p class="lead-description"><?php _e( 'We\'ll email you periodically when we release new addons and add new features!', 'shopmagic-for-woocommerce' ); ?></h2></p>

        <?php
            $current_user = wp_get_current_user();
        ?>

        <div id="mc_embed_signup">
            <form action="https://wpdesk.us18.list-manage.com/subscribe/post?u=d0f59e3be11615f6d268de27a&amp;id=6f98888b09" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                <div id="mc_embed_signup_scroll">
                    <table class="form-table" role="presentation">
                        <tbody>
                            <tr>
                                <th scope="row">
                                    <label for="mce-EMAIL"><?php _e( 'Your e-mail', 'shopmagic-for-woocommerce' ); ?></label>
                                </th>

                                <td>
                                    <input type="email" value="<?php echo $current_user->user_email; ?>" name="EMAIL" class="regular-text required email" id="mce-EMAIL" placeholder="<?php _e( 'Enter your e-mail...', 'shopmagic-for-woocommerce' ); ?>">

                                    <p class="description"><?php _e( 'You will be asked to confirm your email in the next step.', 'shopmagic-for-woocommerce' ); ?></p>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <?php /* real people should not fill this in and expect good things - do not remove this or risk form bot signups  */ ?>
                    <span style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_d0f59e3be11615f6d268de27a_b8cd3a76cc" tabindex="-1" value=""></span>

                    <input type="submit" value="<?php _e( 'Sign me up!', 'shopmagic-for-woocommerce' ); ?>" name="subscribe" id="mc-embedded-subscribe" class="button button-primary button-large">
                </div>
            </form>
        </div>
    </div>
</div>
