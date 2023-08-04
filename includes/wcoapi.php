<?php
//    "wc-pending": "Pagamento pendente",
//    "wc-processing": "Em processamento",
//    "wc-on-hold": "Aguarda confirmação de pagamento",
//    "wc-completed": "Concluída",
//    "wc-cancelled": "Cancelada",
//    "wc-refunded": "Reembolsada",
//    "wc-failed": "Falhada",
//    "wc-checkout-draft": "Draft"
	function handle_get_orders($request) {
		$options = get_option('wcoapi_data') ? get_option('wcoapi_data') : get_default_data();
		$token = $request->get_header('token');

		if (!isset($token) || $token != $options["token"])
			return array("status" => 403, "message" => "you shall not pass!");

		$args = array(
			'status' => array('wc-processing', 'wc-pending'),
		);
		return wc_get_orders( $args );
	}


	function register_rest_apis () {
		register_rest_route('wcoapi/v1', 'orders', array(
			'method' => 'GET',
			'callback' => 'handle_get_orders',
//			'permission_callback' => function() {
//				return false;
//			}
		));
	}

	add_action('rest_api_init', 'register_rest_apis');

