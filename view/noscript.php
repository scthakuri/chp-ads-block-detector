<noscript>
    <div class="<?php echo esc_attr($this->rclass("modal")); ?> <?php echo esc_attr($this->rclass("show")); ?>">
        <div class="<?php echo esc_attr($this->rclass("content")); ?> <?php echo esc_attr($this->rclass('fadeInDown')); ?>">
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
                            <?php if( wp_validate_boolean( @$this->settings->btn1_show ) ): ?> 
                                <a class="<?php echo esc_attr($this->rclass("action-btn-ok")); ?>" href="<?php echo add_query_arg( $wp->query_vars, home_url( $wp->request ) ); ?>"><?php echo esc_attr(@$this->settings->btn1_text); ?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php echo $brandingcode; ?>
    </div>
<noscript>