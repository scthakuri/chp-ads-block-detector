<div class="chp_ads_blocker_detector chp_ads_blocker_detector-about-wrap">
    <div class="chp_ads_blocker_detector-top-section">
        <img class="chp_ads_blocker_detector-logo" src="<?php echo CHP_ADSB_URL . 'assets/img/icon.png'; ?>">
        <div class="chp_ads_blocker_detector-content">
            <h1><?php _e('CHP ADS Block Detector!', 'chp-adsblocker-detector'); ?></h1>
            <span>#<?php _e('The Best ads block detector wordpress plugin', 'chp-adsblocker-detector'); ?></span>
        </div>
        <div class="chp_ads_blocker_detector-version"><?php _e('Version', 'chp-adsblocker-detector'); ?>:
            <b><?php echo CHP_ADSB_VERSION; ?></b>
        </div>
    </div>
    <div class="chp_ads_blocker_detector-nav-tab-wrapper">
        <a target="_blank" href="https://codehelppro.com/product/wordpress/plugin/chp-ads-block-detector-pro/"
            class="chp_ads_blocker_detector-nav-tab pro"><?php _e('Check Pro Version', 'chp-adsblocker-detector'); ?></a>
    </div>
</div>

<div class=" chp_ads_blocker_detector-content-setion">

    <div style="display: flex;">
        <table class="table" id="chp_ads_block_table">
            <thead>
                <tr>
                    <th colspan="2"><?php _e('Settings', 'chp-adsblocker-detector'); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?php _e('Enable', 'chp-adsblocker-detector'); ?>
                    </td>
                    <td>
                        <label class="checkbox_container">
                            <input type="checkbox"
                                <?php echo filter_var(get_option( 'chp_adb_plugin_enable' ), FILTER_VALIDATE_BOOLEAN) ? 'checked' : null; ?>
                                name="enable" class="chpabd_form_settings include">
                            <span class="checkmark"></span>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php _e('Title', 'chp-adsblocker-detector'); ?>
                    </td>
                    <td>
                        <input type="text"
                            value="<?php echo empty(get_option( 'chp_adb_plugin_title' )) ? null : get_option( 'chp_adb_plugin_title' ); ?>"
                            class="chpabd_form_settings include" name="title" placeholder="Title">
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php _e('Content', 'chp-adsblocker-detector'); ?>
                    </td>
                    <td>
                        <?php echo wp_editor( get_option( 'chp_adb_plugin_content' ) , 'chp_ads_content', array(
                                    'tinymce'       => array(
                                        'toolbar1'      => 'bold,italic,underline,link,unlink,undo,redo',
                                        'toolbar2'      => '',
                                        'toolbar3'      => '',
                                    ),
                                    'media_buttons' => false,
                                    'textarea_rows' => 4,
                                ) ); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php _e('Width (in %)', 'chp-adsblocker-detector'); ?>
                    </td>
                    <td>
                        <input type="number" value="<?php echo get_option( 'chp_adb_plugin_width' ); ?>"
                            class="chpabd_form_settings include" name="width" placeholder="Width in pixel">
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php _e('Position (in %)', 'chp-adsblocker-detector'); ?>
                    </td>
                    <td>
                        <label><?php _e('From Left', 'chp-adsblocker-detector'); ?> : </label>
                        <input type="number" value="<?php echo get_option( 'chp_adb_plugin_from_left' ); ?>"
                            style="width:20%; display:inline-block;margin-right:10px;"
                            class="chpabd_form_settings include" name="left"
                            placeholder="<?php _e('From Left', 'chp-adsblocker-detector'); ?>">

                        <label><?php _e('From Top', 'chp-adsblocker-detector'); ?> : </label>
                        <input type="number" value="<?php echo get_option( 'chp_adb_plugin_from_right' ); ?>"
                            style="width:20%; display:inline-block;margin-right:10px;"
                            class="chpabd_form_settings include" name="top"
                            placeholder="<?php _e('From Top', 'chp-adsblocker-detector'); ?>">
                    </td>
                </tr>

                <tr>
                    <td>
                        <?php _e('Show Refresh Button', 'chp-adsblocker-detector'); ?>
                    </td>
                    <td>
                        <label class="checkbox_container">
                            <input type="checkbox"
                                <?php echo filter_var(get_option( 'chp_adb_plugin_btn1_show' ), FILTER_VALIDATE_BOOLEAN) ? 'checked' : null; ?>
                                name="btn1_show" class="chpabd_form_settings include">
                            <span class="checkmark"></span>
                        </label>
                    </td>
                </tr>

                <tr>
                    <td>
                        <?php _e('Refresh Button (Text)', 'chp-adsblocker-detector'); ?>
                    </td>
                    <td>
                        <input type="text" value="<?php echo get_option( 'chp_adb_plugin_btn1_text' ); ?>"
                            class="chpabd_form_settings include" name="btn1_text"
                            placeholder="<?php _e('Button Text', 'chp-adsblocker-detector'); ?>">
                    </td>
                </tr>

                <tr>
                    <td>
                    <?php _e('Show Close Button', 'chp-adsblocker-detector'); ?>
                    </td>
                    <td>
                        <label class="checkbox_container">
                            <input type="checkbox"
                                <?php echo filter_var(get_option( 'chp_adb_plugin_btn2_show' ), FILTER_VALIDATE_BOOLEAN) ? 'checked' : null; ?>
                                name="btn2_show" class="chpabd_form_settings include">
                            <span class="checkmark"></span>
                        </label>
                    </td>
                </tr>

                <tr>
                    <td>
                    <?php _e('Close Button (Text)', 'chp-adsblocker-detector'); ?>
                    </td>
                    <td>
                        <input type="text" value="<?php echo get_option( 'chp_adb_plugin_btn2_text' ); ?>"
                            class="chpabd_form_settings include" name="btn2_text" placeholder="<?php _e('Button Text', 'chp-adsblocker-detector'); ?>">
                    </td>
                </tr>

                <tr>
                    <td>
                        <?php _e('Hide on Mobile Device', 'chp-adsblocker-detector'); ?>
                    </td>
                    <td>
                        <label class="checkbox_container">
                            <input type="checkbox"
                                <?php echo filter_var(get_option( 'chp_adb_plugin_hide_mobile' ), FILTER_VALIDATE_BOOLEAN) ? 'checked' : null; ?>
                                name="hide_mobile" class="chpabd_form_settings include">
                            <span class="checkmark"></span>
                        </label>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table" id="chp_ads_block_table" style="width:23%;margin-left:2%;">
            <thead>
                <tr>
                    <th><?php _e('PRO Version Capability', 'chp-adsblocker-detector'); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <img src="<?php echo CHP_ADSB_URL . 'assets/img/banner.png'; ?>"
                            style="width:109.5%;margin:-10px;height:100%;">
                    </td>
                </tr>
                <tr>
                    <td><?php _e('Button Text Customizable', 'chp-adsblocker-detector'); ?></td>
                </tr>
                <tr>
                    <td><?php _e('Overlay Effect Customizable', 'chp-adsblocker-detector'); ?></td>
                </tr>
                <tr>
                    <td><?php _e('Theme', 'chp-adsblocker-detector'); ?></td>
                </tr>
                <tr>
                    <td><?php _e('Control Body Scroll', 'chp-adsblocker-detector'); ?>l</td>
                </tr>
                <tr>
                    <td><?php _e('Disable for individual pages', 'chp-adsblocker-detector'); ?></td>
                </tr>
                <tr>
                    <td><?php _e('Disbale for woocommerce pages', 'chp-adsblocker-detector'); ?></td>
                </tr>
                <tr>
                    <td><?php _e('Customize according to theme color', 'chp-adsblocker-detector'); ?></td>
                </tr>
                <tr>
                    <td><strong><?php _e('And Many More . . .', 'chp-adsblocker-detector'); ?></strong></td>
                </tr>
            </tbody>
            <thead>
                <tr>
                    <th style="background:#ff0000;text-align:center;"><a target="_blank"
                            href="https://codehelppro.com/product/wordpress/plugin/chp-ads-block-detector-pro/"
                            style="    padding: 0;border: none;outline: none;box-shadow: none;background: transparent;color: #fff;text-align: center;text-decoration:none;"><?php _e('Check PRO Version', 'chp-adsblocker-detector'); ?></a></th>
                </tr>
            </thead>
        </table>
    </div>

    <div class="chp_ads_button_row">
        <button class="button button-primary" type="button" id="chp_ads_save_settings"><?php _e('Save Changes', 'chp-adsblocker-detector'); ?></button>
        <button class="button button-secondary" type="button" id="chp_ads_reset_settings"><?php _e('Reset Changes', 'chp-adsblocker-detector'); ?></button>
    </div>
</div>