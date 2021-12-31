<?php

/**
* Description: Include all the code required to handle ajax
*
* @package chp-adsblocker-detector
* @since CHPADB 2.3
*/


namespace CHPADB\Includes;

/*****************************************************
 Restrict Direct Access
******************************************************/
if( ! defined( 'ABSPATH' ) ) exit(0);


class ajax{


    /**
     * Inilialize ajax class
     *
     * @param string  null
     *
     * @return string null
     */
    public function init(){

        //Handling ajax
        add_action("wp_ajax_chp_abd_action", [$this, 'chp_abd_action']);
        
    }


    /**
     * Handling ajax
     *
     * @param string  null
     *
     * @return string null
     */
    public function chp_abd_action( ){

        /****************************************
        Save All the settings
        *****************************************/ 
        if( isset( $_POST['settings'] ) ){
            $settings = $_POST['settings'];
            if(is_array($settings) && !empty($settings)){
                /****************************************
                update settings of plugin
                *****************************************/
                $enable = sanitize_text_field($settings['enable']);
                $title = sanitize_text_field($settings['title']);
                $btn1_show = sanitize_text_field($settings['btn1_show']);
                $btn1_text = sanitize_text_field($settings['btn1_text']);

                $btn2_show = sanitize_text_field($settings['btn2_show']);
                $btn2_text = sanitize_text_field($settings['btn2_text']);

                $content = wp_kses_post($settings['content']);

                $fromLeft = sanitize_text_field($settings['left']);
                $fromTop = sanitize_text_field($settings['top']);

                $width = sanitize_text_field($settings['width']);
                

                if( ! is_bool( $enable ) )
                    update_option( 'chp_adb_plugin_enable', $enable );

                if( ! empty( $title ) )
                    update_option( 'chp_adb_plugin_title', $title );

                if( ! is_bool( $btn1_show ) )
                    update_option( 'chp_adb_plugin_btn1_show', $btn1_show );

                if( ! empty( $btn1_text ) )
                    update_option( 'chp_adb_plugin_btn1_text', $btn1_text );

                if( ! is_bool( $btn2_show ) )
                    update_option( 'chp_adb_plugin_btn2_show', $btn2_show );

                if( ! empty( $btn2_text ) )
                    update_option( 'chp_adb_plugin_btn2_text', $btn2_text );

                if( ! empty( $content ) )
                    update_option( 'chp_adb_plugin_content', $content );
                
                if( ! is_bool( $fromLeft ) )
                    update_option( 'chp_adb_plugin_from_left', $fromLeft );
                
                if( ! is_bool( $fromTop ) )
                    update_option( 'chp_adb_plugin_from_right', $fromTop );

                if( ! is_bool( $width ) )
                    update_option( 'chp_adb_plugin_width', $width );
                
                echo __('Settings save successfully', 'chp-adsblocker-detector');
            }else{
                echo __('We got some issue on updating settings.', 'chp-adsblocker-detector');
            }
        }


        /****************************************
        Reset All the settings
        *****************************************/ 
        if( isset( $_POST['reset'] ) ){
            setDefaultValues();
            
            echo __('Settings reset successfully.', 'chp-adsblocker-detector');
        }

        /****************************************
        End ajax request
        *****************************************/ 
        die();
    }

}
