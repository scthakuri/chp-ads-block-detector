<div class="hamrocsit_adb_admin hamrocsit_adb_about-wrap">
    <div class="hamrocsit_adb_top-section">
        <img class="hamrocsit_adb_logo" src="<?php echo CHP_ADSB_URL . 'assets/img/icon.png'; ?>">
        <div class="hamrocsit_adb_content">
            <h1><?php esc_attr_e('CHP ADS Block Detector!', 'chp-adsblocker-detector'); ?></h1>
            <span>#<?php esc_attr_e('The Best ads block detector wordpress plugin', 'chp-adsblocker-detector'); ?></span>
        </div>
        <div class="hamrocsit_adb_version"><?php esc_attr_e('Version', 'chp-adsblocker-detector'); ?>:
            <b><?php echo CHP_ADSB_VERSION; ?></b>
        </div>
    </div>
    <div class="hamrocsit_adb_nav-tab-wrapper">
        <a target="_blank" href="https://chpadblock.com/pricing/"
            class="hamrocsit_adb_nav-tab pro"><?php esc_attr_e('Check Pro Version', 'chp-adsblocker-detector'); ?></a>
    </div>
</div>

<div class="hamrocsit_adb_content-setion">

    <div
        style="color: #000;background-color: #f8d7da;border-color: #f5c6cb;padding: 15px;border-radius: 5px;margin-bottom: 10px;max-width: 95%;text-align: center;font-weight: bold;">
        If not working with any extension then please check <a target="_blank"
            style="color:red; text-decoration:underline;"
            href="https://chpadblock.com/docs/support/not-working-with-ublock-extension/">Documentation</a>.</div>

    <div style="display: flex;">
        <table class="table" id="hamrocsit_adb_table">
            <thead>
                <tr>
                    <th colspan="2"><?php esc_attr_e('Settings', 'chp-adsblocker-detector'); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?php esc_attr_e('Enable', 'chp-adsblocker-detector'); ?>
                    </td>
                    <td>
                        <label class="checkbox_container">
                            <input type="checkbox"
                                <?php echo filter_var(@$settings->enable, FILTER_VALIDATE_BOOLEAN) ? 'checked' : null; ?>
                                name="enable" class="chpabd_form_settings include">
                            <span class="checkmark"></span>
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php esc_attr_e('Title', 'chp-adsblocker-detector'); ?>
                    </td>
                    <td>
                        <input type="text" value="<?php echo empty(@$settings->title) ? null : @$settings->title; ?>"
                            class="chpabd_form_settings include" name="title" placeholder="Title">
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php esc_attr_e('Content', 'chp-adsblocker-detector'); ?>
                    </td>
                    <td>
                        <?php echo wp_editor( @$settings->content , 'chp_ads_content', array(
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
                        <?php esc_attr_e('Width (in %)', 'chp-adsblocker-detector'); ?>
                    </td>
                    <td>
                        <input type="number" value="<?php echo @$settings->width; ?>"
                            class="chpabd_form_settings include" name="width" placeholder="Width in pixel">
                    </td>
                </tr>

                <tr>
                    <td>
                        <?php esc_attr_e('Show Refresh Button', 'chp-adsblocker-detector'); ?>
                    </td>
                    <td>
                        <label class="checkbox_container">
                            <input type="checkbox"
                                <?php echo filter_var(@$settings->btn1_show, FILTER_VALIDATE_BOOLEAN) ? 'checked' : null; ?>
                                name="btn1_show" class="chpabd_form_settings include">
                            <span class="checkmark"></span>
                        </label>
                    </td>
                </tr>

                <tr>
                    <td>
                        <?php esc_attr_e('Refresh Button (Text)', 'chp-adsblocker-detector'); ?>
                    </td>
                    <td>
                        <input type="text" value="<?php esc_attr_e($settings->btn1_text, 'chp-adsblocker-detector'); ?>"
                            class="chpabd_form_settings include" name="btn1_text"
                            placeholder="<?php esc_attr_e('Button Text', 'chp-adsblocker-detector'); ?>">
                    </td>
                </tr>

                <tr>
                    <td>
                        <?php esc_attr_e('Show Close Button', 'chp-adsblocker-detector'); ?>
                    </td>
                    <td>
                        <label class="checkbox_container">
                            <input type="checkbox"
                                <?php echo filter_var(@$settings->btn2_show, FILTER_VALIDATE_BOOLEAN) ? 'checked' : null; ?>
                                name="btn2_show" class="chpabd_form_settings include">
                            <span class="checkmark"></span>
                        </label>
                    </td>
                </tr>

                <tr>
                    <td>
                        <?php esc_attr_e('Close Button (Text)', 'chp-adsblocker-detector'); ?>
                    </td>
                    <td>
                        <input type="text" value="<?php esc_attr_e($settings->btn2_text, 'chp-adsblocker-detector'); ?>"
                            class="chpabd_form_settings include" name="btn2_text"
                            placeholder="<?php esc_attr_e('Button Text', 'chp-adsblocker-detector'); ?>">
                    </td>
                </tr>

                <tr>
                    <td>
                        <?php esc_attr_e('Include in Header', 'chp-adsblocker-detector'); ?>
                    </td>
                    <td>
                        <div style="display:block;margin-bottom:10px;min-height: 25px;">
                            <label class="checkbox_container">
                                <input type="checkbox"
                                    <?php echo filter_var(@$settings->header, FILTER_VALIDATE_BOOLEAN) ? 'checked' : null; ?>
                                    name="header" class="chpabd_form_settings include">
                                <span class="checkmark"></span>
                            </label>
                        </div>

                        <div class="notice notice-info" style="margin-left:0;">
                            <em>Make sure your theme supports <strong>wp_body_open</strong> hook. If not exists, this options will not work and render in footer.</em>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td>
                        <?php esc_attr_e('Minify JS', 'chp-adsblocker-detector'); ?>
                    </td>
                    <td>
                        <label class="checkbox_container">
                            <input type="checkbox"
                                <?php echo filter_var(@$settings->minify, FILTER_VALIDATE_BOOLEAN) ? 'checked' : null; ?>
                                name="minify" class="chpabd_form_settings include">
                            <span class="checkmark"></span>
                        </label>
                    </td>
                </tr>

                <tr>
                    <td>
                        <?php esc_attr_e('Branding', 'chp-adsblocker-detector'); ?>
                    </td>
                    <td>
                        <div style="display:block;margin-bottom:10px;min-height: 25px;">
                            <label class="checkbox_container">
                                <input type="checkbox" <?php echo filter_var(@$settings->branding, FILTER_VALIDATE_BOOLEAN) ? 'checked' : null; ?>
                                    name="branding" class="chpabd_form_settings include">
                                <span class="checkmark"></span>
                            </label>
                        </div>

                        <div class="notice notice-info" style="margin-left:0;">
                            <div><strong>Help CHP Adblock to grow allowing people to recognize which comment plugin you use.</strong></div>
                            <em>Please check this option on to help CHP Adblock get more popularity as your thank to the hard work we do for you. This option add Adblock icon and text on the adblock popup [Corner Fixed] which allow your site visitors recognize the name of the Adblock Plugin you use. <strong>This only show when popup open.</strong></em>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table" id="hamrocsit_adb_table" style="width:23%;margin-left:2%;">
            <thead>
                <tr>
                    <th><?php esc_attr_e('PRO Version Capability', 'chp-adsblocker-detector'); ?></th>
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
                    <td><?php esc_attr_e('Button Text Customizable', 'chp-adsblocker-detector'); ?></td>
                </tr>
                <tr>
                    <td><?php esc_attr_e('Overlay Effect Customizable', 'chp-adsblocker-detector'); ?></td>
                </tr>
                <tr>
                    <td><?php esc_attr_e('Dark and Light Theme', 'chp-adsblocker-detector'); ?></td>
                </tr>
                <tr>
                    <td><?php esc_attr_e('Control Body Scroll', 'chp-adsblocker-detector'); ?>l</td>
                </tr>
                <tr>
                    <td><?php esc_attr_e('Disable for individual pages and user roles', 'chp-adsblocker-detector'); ?></td>
                </tr>
                <tr>
                    <td><?php esc_attr_e('Customize according to theme color', 'chp-adsblocker-detector'); ?></td>
                </tr>
                <tr>
                    <td><?php esc_attr_e('Content Wrapper: Automatically Blur Content If Detected', 'chp-adsblocker-detector'); ?>
                    </td>
                </tr>
                <tr>
                    <td><?php esc_attr_e('Google Analytics Trackers', 'chp-adsblocker-detector'); ?></td>
                </tr>
                <tr>
                    <td><a target="_blank" href="https://chpadblock.com/docs/features/"><strong><?php esc_attr_e('And Many More . . .', 'chp-adsblocker-detector'); ?></strong></a>
                    </td>
                </tr>
            </tbody>
            <thead>
                <tr>
                    <th style="text-align:center;"><a target="_blank" href="https://chpadblock.com/pricing/"
                            style="    padding: 0;border: none;outline: none;box-shadow: none;background: transparent;color: #fff;text-align: center;text-decoration:none;"><?php esc_attr_e('Check PRO Version', 'chp-adsblocker-detector'); ?></a>
                    </th>
                </tr>
            </thead>
        </table>
    </div>

    <div class="chp_ads_button_row">
        <?php echo wp_nonce_field('update_chpadb_settings'); ?>
        <button class="button button-primary" type="button" id="chp_ads_save_settings"><?php esc_attr_e('Save Changes', 'chp-adsblocker-detector'); ?></button>
        <button class="button button-secondary" type="button" id="chp_ads_reset_settings"><?php esc_attr_e('Reset Changes', 'chp-adsblocker-detector'); ?></button>
    </div>
</div>