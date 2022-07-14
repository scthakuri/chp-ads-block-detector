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
            $defaults = (array) \CHPADB\Includes\defaults();
            if(is_array($settings) && !empty($settings)){

                //sanitize post message
                $newSettings = array();
                foreach($settings as $k => $v){
                    if( isset( $settings[$k] ) ){
                        if( $k == 'content' ){
                            $newSettings[$k] = wp_kses_post($settings[$k]);
                        }else if( $k == 'branding' ){
                            $branding = sanitize_text_field($settings['branding']);
                            $branding = filter_var($branding, FILTER_VALIDATE_BOOLEAN) ? "yes" : "no";
                            $newSettings[$k] = $branding;
                        }else{
                            $newSettings[$k] = sanitize_text_field($settings[$k]);
                        }
                    }else{
                        $newSettings[$k] = $defaults[$k];
                    }
                }
                update_option( "chpadb_plugin_settings", json_encode($newSettings) );
                
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
