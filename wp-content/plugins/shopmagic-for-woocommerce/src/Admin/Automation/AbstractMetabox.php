<?php

namespace WPDesk\ShopMagic\Admin\Automation;

use ShopMagicVendor\WPDesk\View\Renderer\Renderer;
use ShopMagicVendor\WPDesk\View\Renderer\SimplePhpRenderer;
use ShopMagicVendor\WPDesk\View\Resolver\DirResolver;

class AbstractMetabox {
	/**
	 * @return Renderer
	 */
	protected function get_renderer() {
		return new SimplePhpRenderer( new DirResolver( __DIR__ . DIRECTORY_SEPARATOR . 'templates' ) );
	}
}
