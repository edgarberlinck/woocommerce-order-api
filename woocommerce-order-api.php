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

	public static function instance(): ?Woocommerce_Order_Api_Install {
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function __construct() {
		$this->include();
		$this->create_menus();
	}

	public function include() {
		require_once WOOCOMMERCE_ORDER_API_PATH . 'includes/wcoapi.php';
	}

	public function create_menus() {
		add_filter('woocommerce_settings_tabs_array', [$this, 'add_settings_tab'], 50);
		add_filter('woocommerce_settings_wcoapi', [$this, 'settings_page']);
		add_filter('woocommerce_update_options_wcoapi', [$this, 'update_settings']);
	}

	function add_settings_tab($tabs) {
		$tabs['wcoapi'] = esc_html('WC Order API', 'woocommerce-order-api');
		return $tabs;
	}

	function settings_page() {
		require_once WOOCOMMERCE_ORDER_API_PATH . 'templates/admin/woocommerce-order-api-settings.php';
	}

	function update_settings() {
		if (empty($_POST['_wcoapinounce']) || !wp_verify_nonce($_POST['_wcoapinounce'], 'wcoapi_woo_settings')) {
			return;
		}
//		Example data
//		prefixes {
//			order_paid_with_cash: 'U',
//			order_paid_with_credit: 'K'
//		}
		update_option('wcoapi_data', $_POST['wcoapi_data']);
	}
}

function init_plugin_woocommerce_order_api() {
	Woocommerce_Order_Api_Install::instance();
}

add_action('plugin_loaded', 'init_plugin_woocommerce_order_api', 5);