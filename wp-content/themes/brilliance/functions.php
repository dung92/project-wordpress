<?php if(!isset($content_width)) $content_width = 640;
define('CPOTHEME_ID', 'brilliance');
define('CPOTHEME_NAME', 'Brilliance');
define('CPOTHEME_VERSION', '1.2.8');
//Other constants
define('CPOTHEME_LOGO_WIDTH', '170');
define('CPOTHEME_USE_SLIDES', true);
define('CPOTHEME_USE_FEATURES', true);
define('CPOTHEME_USE_PORTFOLIO', true);
define('CPOTHEME_USE_SERVICES', true);
define('CPOTHEME_USE_CLIENTS', true);
define('CPOTHEME_USE_TESTIMONIALS', true);
define('CPOTHEME_THUMBNAIL_WIDTH', '400');
define('CPOTHEME_THUMBNAIL_HEIGHT', '400');
define('CPOTHEME_PREMIUM_NAME', 'Brilliance Pro');
define('CPOTHEME_PREMIUM_URL', 'http://www.cpothemes.com/theme/brilliance');
		
//Load Core; check existing core or load development core
$core_path = get_template_directory().'/core/';
$include_path = get_template_directory().'/includes/';
if(defined('CPOTHEME_CORE')) $core_path = CPOTHEME_CORELITE;

require_once $core_path.'init.php';
require_once($include_path.'setup.php');

// Add Welcome Screen & Epsilon Framework
if ( ! class_exists( 'CPO_Theme' ) ) {
	require get_template_directory() . '/includes/class-cpo-theme.php';
}

if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}