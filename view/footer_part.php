<?php
    /**
     * Hooks to enable or disbale google
     * ads detetcion method
     * 
     * @since 5.1.2
     */
    $googleAds = apply_filters('adb/checkby/googleads', true);
    $imageAds = apply_filters('adb/checkby/imageads', true);
    $debug = apply_filters('adb/debug/js', false);
    $checkinterval = apply_filters('adb/check/interval', 0);
    $branding = apply_filters('adb/branding', true);
    $onPageFullyLoaded = apply_filters('adb/onpageload', true);



    $brandingcode = sprintf('<div class="chp_branding%s"></div>', $this->randnum, $this->randnum);
    if( $branding ){
        $brandingURLArray = array("https://codehelppro.com/product/wordpress/plugin/chp-ads-block-detector-pro/", "https://hamrocsit.com");
        $brandingURL = $brandingURLArray[array_rand($brandingURLArray)];
        $brandingcode = sprintf('<div class="chp_branding%s"><a id="chp_branding%s" href="%s" target="_blank" rel="noopener noreferrer"><span class="chp_brading_powered_by" style="color: rgb(9, 13, 22);">Powered By</span> <div class="chp_brading_svg"><img src="%sassets/img/branding.svg" alt="CHP Adblock Detector Plugin | Codehelppro" /></div></a></div>', $this->randnum, $this->randnum, $brandingURL, CHP_ADSB_URL);
    }

    /**
     * Enable or Disable Image Ads Request
     * 
     * @since 5.1.2
     */
    if( $imageAds ){
        echo '<div class="demo-wrapper" style="display:none;"><div class="ads"><img id="chp-ads-image" src="images/ads.jpg" height="250" width="300" alt=""></div></div>';
    }else{
        echo '<div class="demo-wrapper" style="display:none;"><div id="chp-ads-image"></div></div>';
    }
?>
<!-- The Modal -->
<div id="chp_ads_block_modal_new<?php echo $this->randnum; ?>" class="chp_ads_block_modal<?php echo $this->randnum; ?> fadeInDown">
    <div class="chp_ads_block_modal_content" id="chp_ads_block_modal_content">
        <div class="chp_ads_block_pro_body" id="chp_ads_block_pro_body">
            <div class="chp_ads_block_detector_theme theme1">
                <div class="chp_ads_block_pro_body">

                    <div class="chp_ads_blocker_wrapper">
                        <?php  
                            /**
                             * Get icon html
                             * 
                             * @since 5.1.0
                             */
                            echo $iconCode;
                        ?>
                    </div>

                    <h4 class="adblock_title"><?php echo $settings->title; ?></h4>
                    <div class="adblock_subtitle"><?php echo $settings->content; ?></div>


                    <div class="chp_ads_blocker_detector-action">
                        <?php if( filter_var( $settings->btn2_show, FILTER_VALIDATE_BOOLEAN ) ): ?> <a
                            class="chp_ads_blocker_detector-action-btn-close<?php echo $this->randnum; ?>" id="close_btn_adblock<?php echo $this->randnum; ?>"><?php echo $settings->btn2_text; ?></a> <?php endif; ?>
                        <?php if( filter_var( $settings->btn1_show, FILTER_VALIDATE_BOOLEAN ) ): ?> <a
                            class="chp_ads_blocker_detector-action-btn-ok"
                            onclick="reload()"><?php echo $settings->btn1_text; ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo $brandingcode; ?>
</div>

<script>
    <?php
        /**
         * Including Main scripts
         * 
         * @since 3.3.2
         */
        ob_start();
        require_once CHP_ADSB_DIR . 'view/main_scripts.php';
        $content = ob_get_clean();
        $content = \JShrink\Minifier::minify($content);
        echo $content;
    ?>
</script>