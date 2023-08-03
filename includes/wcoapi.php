<?php
	add_action('rest_api_init', function () {
		register_rest_route('wcoapi/v1/orders', 'handle_response', array(
			'method' => 'GET',
			'callback' => 'handle_get_orders'
		));
	});

	function handle_get_orders($request) {

	}