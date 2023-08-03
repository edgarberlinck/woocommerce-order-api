<?php
	function handle_get_orders($request) {

	}

	function register_rest_apis () {
		register_rest_route('wcoapi/v1/orders', 'handle_response', array(
			'method' => 'GET',
			'callback' => function ($request) { handle_get_orders($request); }
		));
	}

	add_action('rest_api_init', 'register_rest_apis');

