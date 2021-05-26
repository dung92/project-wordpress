<?php

namespace WPDesk\ShopMagic\Event\Imitation;

use WPDesk\ShopMagic\Admin\Automation\AutomationFormFields\ProEventInfoField;
use WPDesk\ShopMagic\Event\EventFactory2;
use WPDesk\ShopMagic\Event\ImitationCommonEvent;

/**
 * Event that never fires and only shows info about PRO upgrades.
 */
final class SubscriptionProEvent extends ImitationCommonEvent {
	/**
	 * @inheritDoc
	 */
	public function get_name(): string {
		return __( 'WooCommerce Subscriptions Event', 'shopmagic-for-woocommerce' );
	}

	/**
	 * @inheritDoc
	 */
	public function get_description(): string {
		return '';
	}

	public function get_group_slug(): string {
		return EventFactory2::GROUP_SUBSCRIPTION;
	}

	public function get_fields(): array {
		$link = get_locale() === 'pl_PL' ? 'https://wpde.sk/sm-event-subscription-pro-pl' : 'https://wpde.sk/sm-event-subscription-pro';

		ob_start();
		?>

		<h3>
			<strong><?php _e( 'WooCommerce Subscriptions Integration (available in ShopMagic PRO)', 'shopmagic-for-woocommerce' ); ?></strong>
		</h3>

		<p><?php _e( 'Allows to create automations based on subscription events, such as payments or status changes.', 'shopmagic-for-woocommerce' ); ?></p>

		<p><strong><?php _e( 'Trigger actions by the following events:', 'shopmagic-for-woocommerce' ); ?></strong></p>

		<ul>
			<li>
				<span class="dashicons dashicons-yes"></span> <?php _e( 'New Subscription', 'shopmagic-for-woocommerce' ); ?>
			</li>
			<li>
				<span class="dashicons dashicons-yes"></span> <?php _e( 'Subscription Status Changed', 'shopmagic-for-woocommerce' ); ?>
			</li>
			<li>
				<span class="dashicons dashicons-yes"></span> <?php _e( 'Subscription Before Renewal', 'shopmagic-for-woocommerce' ); ?>
			</li>
			<li>
				<span class="dashicons dashicons-yes"></span> <?php _e( 'Subscription Before End', 'shopmagic-for-woocommerce' ); ?>
			</li>
			<li>
				<span class="dashicons dashicons-yes"></span> <?php _e( 'Subscription Trial End', 'shopmagic-for-woocommerce' ); ?>
			</li>
			<li>
				<span class="dashicons dashicons-yes"></span> <?php _e( 'Subscription Manual Trigger', 'shopmagic-for-woocommerce' ); ?>
			</li>
			<li><span class="dashicons dashicons-yes"></span> <?php _e( 'and more...', 'shopmagic-for-woocommerce' ); ?>
			</li>
		</ul>

		<p><strong><?php _e( 'Perform actions on subscriptions:', 'shopmagic-for-woocommerce' ); ?></strong></p>

		<ul>
			<li>
				<span class="dashicons dashicons-yes"></span> <?php _e( 'Subscription Change Status', 'shopmagic-for-woocommerce' ); ?>
			</li>
			<li>
				<span class="dashicons dashicons-yes"></span> <?php _e( 'Subscription Change Dates', 'shopmagic-for-woocommerce' ); ?>
			</li>
			<li>
				<span class="dashicons dashicons-yes"></span> <?php _e( 'Subscription Change to Manual', 'shopmagic-for-woocommerce' ); ?>
			</li>
			<li><span class="dashicons dashicons-yes"></span> <?php _e( 'and more...', 'shopmagic-for-woocommerce' ); ?>
			</li>
		</ul>

		<p><a class="button button-primary button-large" href="<?php echo $link; ?>"
			  target="_blank"><?php _e( 'Get WooCommerce Subscriptions integration &rarr;', 'shopmagic-for-woocommerce' ); ?></a>
		</p>

		<?php

		$description = ob_get_contents();
		ob_end_clean();

		$fields = [];

		$fields[] = ( new ProEventInfoField() )
				->set_description( $description );

		return $fields;
	}
}
