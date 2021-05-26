<?php

namespace WPDesk\ShopMagic\Integration;

use WPDesk\ShopMagic\Admin\Settings\CartAdSettings;
use WPDesk\ShopMagic\Admin\Settings\TwilioAdSettings;
use WPDesk\ShopMagic\Helper\PluginInstaller;
use WPDesk\ShopMagic\Helper\WordPressPluggableHelper;

final class AdFreePlugins {
	public function hooks() {
		( new PluginInstaller(
			CartAdSettings::plugin_slug(),
			CartAdSettings::ajax_install_action(),
			CartAdSettings::nonce()
		) )->hook();

		( new PluginInstaller(
			TwilioAdSettings::plugin_slug(),
			TwilioAdSettings::ajax_install_action(),
			TwilioAdSettings::nonce()
		) )->hook();

		add_filter( 'shopmagic/core/settings/tabs', [ $this, 'append_settings' ] );
	}

	/**
	 * @internal
	 */
	public function append_settings( $tabs ) {
		if ( ! WordPressPluggableHelper::is_plugin_active( CartAdSettings::plugin_slug() ) ) {
			$tabs[ CartAdSettings::get_tab_slug() ] = new CartAdSettings();
		}
		if ( ! WordPressPluggableHelper::is_plugin_active( TwilioAdSettings::plugin_slug() ) ) {
			$tabs[ TwilioAdSettings::get_tab_slug() ] = new TwilioAdSettings();
		}

		return $tabs;
	}
}
