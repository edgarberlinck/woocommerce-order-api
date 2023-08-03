<?php

/*
Plugin Name: Woocommerce Order Api
Plugin URI: https://github.com/edgarberlinck/woocommerce-order-api.git
Description: A brief description of the Plugin.
Version: 1.0
Requires at least: 7.0.0
Requires PHP: 7.4.30
Author: Edgar Muniz Berlinck
Author URI: https://beacons.ai/edgarberlinck
License: MIT
*/

defined('ABSPATH') || exit;

if (
	!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins',
	get_option('active_plugins')))
) {
	exit;
}

if (!defined('WOOCOMMERCE_ORDER_API_PATH')) {
	define('WOOCOMMERCE_ORDER_API_PATH', plugin_dir_path(__FILE__));
}
if (!defined('WOOCOMMERCE_ORDER_API_DIR')) {
	define('WOOCOMMERCE_ORDER_API_DER', __FILE__);
}

class Woocommerce_Order_Api_Install {

	protected static $instance = null;

	public static function instance() {
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function __construct() {
		$this->include();
	}

	public function include() {
		require_once WOOCOMMERCE_ORDER_API_PATH . 'includes/wcoapi.php';
	}
}

function init_plugin_woocommerce_order_api() {
	Woocommerce_Order_Api_Install::instance();
}

add_action('plugin_loaded', 'init_plugin_woocommerce_order_api', 5);