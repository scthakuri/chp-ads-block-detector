<?php
    /**
     * Hooks to enable or disbale google
     * ads detetcion method
     * 
     * @since 5.1.2
     */
    $googleAds = apply_filters('adb/checkby/googleads', false);
    $adsrequest = apply_filters('adb/adrequest/url', "https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js");
    $classAds = apply_filters('adb/checkby/classads', true);
    $debug = apply_filters('adb/debug/js', true);
    $onPageFullyLoaded = apply_filters('adb/onpageload', true);
?>

<div id="<?php echo esc_attr($this->rclass("modal")); ?>" class="<?php echo esc_attr($this->rclass("modal")); ?>">
    <div class="<?php echo esc_attr($this->rclass("content")); ?> <?php echo esc_attr($this->rclass('fadeInDown')); ?>" id="<?php echo esc_attr($this->rclass("content")); ?>">
        <div class="<?php echo esc_attr($this->rclass("body")); ?>" id="<?php echo esc_attr($this->rclass("body")); ?>">
            <div class="<?php echo esc_attr($this->rclass("theme")); ?> theme1">
                <div class="<?php echo esc_attr($this->rclass("body")); ?>">

                    <div class="<?php echo esc_attr($this->rclass("wrapper")); ?>">
                        <?php  
                            /**
                             * Get icon html
                             * 
                             * @since 5.1.0
                             */
                            echo wp_kses($iconCode, array(
                                "img" => array(
                                    "src" => array(),
                                    "alt" => array(),
                                    "class" => array()
                                )
                            ));
                        ?>
                    </div>

                    <h4 class="adblock_title"><?php echo esc_html($settings->title); ?></h4>
                    <div class="adblock_subtitle"><?php echo wp_kses_post($settings->content); ?></div>


                    <div class="<?php esc_attr($this->rclass("action")); ?>">
                        <?php if( wp_validate_boolean( $settings->btn2_show ) ): ?> 
                            <a class="<?php echo esc_attr($this->rclass("action-btn-close")); ?>" id="<?php echo esc_attr($this->rclass("close_btn_adblock")); ?>"><?php echo esc_attr($settings->btn2_text); ?></a> 
                        <?php endif; ?>
                        <?php if( wp_validate_boolean( $settings->btn1_show ) ): ?> 
                            <a class="<?php echo esc_attr($this->rclass("action-btn-ok")); ?>" onclick="reload()"><?php echo esc_attr($settings->btn1_text); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script><?php
    /**
     * Including Main scripts
     * 
     * @since 3.3.2
     */
    $includeFile = CHP_ADSB_DIR . sprintf('view/main_scripts%s.php', wp_validate_boolean( $this->minify ) ? "_min" : "");
    if( file_exists( $includeFile ) && !$debug ){
        require_once $includeFile;
    }else{
        require_once CHP_ADSB_DIR . 'view/main_scripts.php';
    }
?></script>