<?php
    /**
     * Hooks to enable or disbale google
     * ads detetcion method
     * 
     * @since 5.1.2
     */
    $debug = apply_filters('adb/debug/js', false);
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

                    <h4 class="adblock_title"><?php echo esc_html(@$this->settings->title); ?></h4>
                    <div class="adblock_subtitle"><?php echo wp_kses_post(@$this->settings->content); ?></div>


                    <div class="<?php esc_attr($this->rclass("action")); ?>">
                        <?php if( wp_validate_boolean( @$this->settings->btn2_show ) ): ?> 
                            <a class="<?php echo esc_attr($this->rclass("action-btn-close")); ?>" id="<?php echo esc_attr($this->rclass("close_btn_adblock")); ?>"><?php echo esc_attr(@$this->settings->btn2_text); ?></a> 
                        <?php endif; ?>
                        <?php if( wp_validate_boolean( @$this->settings->btn1_show ) ): ?> 
                            <a class="<?php echo esc_attr($this->rclass("action-btn-ok")); ?>" onclick="window.location.href=window.location.href"><?php echo esc_attr(@$this->settings->btn1_text); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo $brandingcode; ?>
</div>

<script><?php
    /**
     * Including Main scripts
     * 
     * @since 3.3.2
     */
    ob_start();
    require_once CHP_ADSB_DIR . 'view/main_scripts.php';
    $content = ob_get_clean();
    if( @$this->settings->minify == null || filter_var(@$this->settings->minify, FILTER_VALIDATE_BOOLEAN) ){
        $hunter = new \CHPADB\Includes\Obfuscator($content);
        $hunter->setExpiration('+5 day');

        $parse = parse_url( site_url() );
        $domain_name = $parse['host'];
        $hunter->addDomainName($domain_name);

        $content = $hunter->Obfuscate();
    }
    echo $content;
?></script>