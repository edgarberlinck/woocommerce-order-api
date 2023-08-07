<?php
    $options = get_option('wcoapi_data') ? get_option('wcoapi_data') : get_default_data();
?>

<div id="woocommerce-order-api-settings">
    <div
       style="display: flex; flex-direction: row; gap: 1rem; align-items: center; margin-top: 1rem">

        <label for="wcoapi_data[token]">
            <?php esc_html_e('API Access Token', 'woocommerce-order-api') ?>
            <span class="woocommerce-help-tip" tabindex="0" aria-label="Chave de acesso a API, pode ser qualquer valor mas recomenda-se utilizar um GUI generator (https://guidgenerator.com/online-guid-generator.aspx)"></span>
        </label>

        <div style="display: flex; flex-direction: column">
            <input
               style="flex-grow: 1; padding: .7rem;"
               name="wcoapi_data[token]" value="<?php echo $options['token'] ?>" />
            <small>Chave de acesso a API, pode ser qualquer valor mas recomenda-se utilizar um <a target="_blank" href="https://guidgenerator.com/online-guid-generator.aspx">GUID generator</a></small>
        </div>

    </div>

	<?php wp_nonce_field('wcoapi_woo_settings', '_wcoapinounce') ?>
</div>