<?php
//    "wc-pending": "Pagamento pendente",
//    "wc-processing": "Em processamento",
//    "wc-on-hold": "Aguarda confirmação de pagamento",
//    "wc-completed": "Concluída",
//    "wc-cancelled": "Cancelada",
//    "wc-refunded": "Reembolsada",
//    "wc-failed": "Falhada",
//    "wc-checkout-draft": "Draft"
	function handle_get_orders($request): array {
		$options = get_option('wcoapi_data') ? get_option('wcoapi_data') : get_default_data();
		$token = $request->get_header('token');

		if (!isset($token) || $token != $options["token"])
			return array("status" => 403, "message" => "Your access token is invalid or not present.");

		$args = array(
			'status' => array('wc-processing', 'wc-pending'),
		);

		$orders = [];
		foreach (wc_get_orders( $args ) as $order_data) {
			$items = [];

			foreach ($order_data->get_items() as $order_items) {
				$items[] = $order_items->get_data();
			}

			$data = array(
				"order_info" => $order_data->get_data(),
				"order_items" => $items
			);

			$orders[] = $data;
		}

		return $orders;
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

