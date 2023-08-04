<?php
    $options = get_option('wcoapi_data') ? get_option('wcoapi_data') : get_default_data();
?>

<div id="woocommerce-order-api-settings">
    <div>
        <label>
	        <?php esc_html_e('Api Token', 'woocommerce-order-api') ?>
            <input name="wcoapi_data[token]"
                   value="<?php echo $options['token'] ?>"/>
        </label>
    </div>
	<?php wp_nonce_field('wcoapi_woo_settings', '_wcoapinounce') ?>
</div>