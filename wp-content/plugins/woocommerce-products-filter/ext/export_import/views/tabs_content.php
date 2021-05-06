<?php
if (!defined('ABSPATH'))
    die('No direct access allowed');
?>

<section id="tabs-export_import">
    <div class="woof-tabs woof-tabs-style-line">
        <div class="woof-control-section">

            <h5><?php _e('Import data', 'woocommerce-products-filter') ?></h5>

            <div class="woof-control-container">
                <div class="woof-control">
                    <textarea style="width: 100%; height: 100px;"  id="woof_import_settings" ></textarea><br />
                    <input type="button" id="woof_do_import" class="woof-button" style="margin: 5px 0;" value="<?php _e('Import placed data', 'woocommerce-products-filter') ?>">
                </div>
                <div class="woof-description">
                    <p class="description"><?php _e('WARNING: this action will overwrite all current WOOF settings. Insert WOOF settings data you need to import! Here you can import only WOOF settings and nothing more! If your site don`t have taxonomies WOOF will not create them (you should create taxonomies before).', 'woocommerce-products-filter') ?> </p>
                </div>
            </div>

        </div><!--/ .woof-control-section-->		
        <div class="woof-control-section">

            <h5><?php _e('Export data', 'woocommerce-products-filter') ?></h5>

            <div class="woof-control-container">
                <div class="woof-control">
                    <textarea readonly="readonly" style="width: 100%; height: 100px;"  id="woof_export_settings" ></textarea><br />
                    <input type="button" id="woof_get_export" class="woof-button" style="margin: 5px 0;" value="<?php _e('Generate data for export', 'woocommerce-products-filter') ?>">
                </div>
                <div class="woof-description">
                    <p class="description"><?php _e('Here is generated WOOF settings data for export. You can only export WOOF settings and not taxonomies or other site data. For taxonomies, products and other  use special third-party plugins.', 'woocommerce-products-filter') ?> </p>
                </div>
            </div>

        </div><!--/ .woof-control-section-->			

    </div>
</section>

