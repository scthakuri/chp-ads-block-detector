<?php
    /**
     * Hooks to enable or disbale google
     * ads detetcion method
     * 
     * @since 5.1.2
     */
    $googleAds = apply_filters('adb/checkby/googleads', true);
    $adsrequest = apply_filters('adb/adrequest/url', "https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js");
    $imageAds = apply_filters('adb/checkby/imageads', true);
    $classAds = apply_filters('adb/checkby/classads', true);
    $debug = apply_filters('adb/debug/js', true);
    $branding = apply_filters('adb/branding', ($settings->branding == 'yes'));
    $onPageFullyLoaded = apply_filters('adb/onpageload', true);

    $brandingcode = '';
    if( $branding ){
        $brandingURLArray = array("https://hamrocsit.com", "https://chpadblock.com/");
        $brandingURL = $brandingURLArray[array_rand($brandingURLArray)];
        $brandingcode = sprintf('<div class="%s"><a id="%s" href="%s" target="_blank" rel="noopener noreferrer"><span class="%s" style="color: rgb(9, 13, 22);">Powered By</span> <div class="%s"><img src="%sassets/img/d.svg" alt="Best Wordpress Adblock Detecting Plugin | CHP Adblock" /></div></a></div>', $this->rclass("chp_branding"), $this->rclass("chp_branding"), $brandingURL, $this->rclass("powered_by"), $this->rclass("chp_brading_svg"), CHP_ADSB_URL);
    }
?>

<div id="<?php echo $this->rclass("modal"); ?>" class="<?php echo $this->rclass("modal"); ?>">
    <div class="<?php echo $this->rclass("content"); ?> <?php echo $this->rclass('fadeInDown'); ?>" id="<?php echo $this->rclass("content"); ?>">
        <div class="<?php echo $this->rclass("body"); ?>" id="<?php echo $this->rclass("body"); ?>">
            <div class="<?php echo $this->rclass("theme"); ?> theme1">
                <div class="<?php echo $this->rclass("body"); ?>">

                    <div class="<?php echo $this->rclass("wrapper"); ?>">
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


                    <div class="<?php $this->rclass("action"); ?>">
                        <?php if( filter_var( $settings->btn2_show, FILTER_VALIDATE_BOOLEAN ) ): ?> <a
                            class="<?php echo $this->rclass("action-btn-close"); ?>" id="<?php echo $this->rclass("close_btn_adblock"); ?>"><?php echo $settings->btn2_text; ?></a> <?php endif; ?>
                        <?php if( filter_var( $settings->btn1_show, FILTER_VALIDATE_BOOLEAN ) ): ?> <a
                            class="<?php echo $this->rclass("action-btn-ok"); ?>"
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