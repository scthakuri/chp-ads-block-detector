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
     * Sanitize Different Values
     */
    function sanitize_array_values( $k, $value ){
        if( $k == 'enable' || $k == 'btn1_show' || $k == 'btn2_show'){
            return rest_sanitize_boolean($value);
        }else if( $k == 'width' ){
            return intval($value);
        }else if( $k == 'content' ){
            return wp_kses_post($value);
        }else if( $k == 'servers' ){
            return sanitize_textarea_field($value);
        }else{
            return sanitize_text_field($value);
        }
    }

    /**
     * Recursive sanitation for an array
     * 
     * @param $array
     *
     * @return mixed
     */
    function recursive_sanitize_array_field($array) {
        foreach ( $array as $key => &$value ) {
            if ( is_array( $value ) ) {
                $value = $this->recursive_sanitize_text_field($value);
            }else {
                $value = $this->sanitize_array_values( $key, $value );
            }
        }

        return $array;
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
        if ( isset($_REQUEST['_wpnonce']) && wp_verify_nonce($_REQUEST['_wpnonce'], 'update_chpadb_settings' ) && current_user_can('manage_options') ){
            if( isset( $_POST['settings'] ) ){
                $settings = $this->recursive_sanitize_array_field($_POST['settings']);
                $defaults = (array) \CHPADB\Includes\defaults();
                if(is_array($settings) && !empty($settings)){
    
                    //sanitize post message
                    $newSettings = array();
                    foreach($settings as $k => $v){
                        if( isset( $settings[$k] ) ){
                            if( $k == 'content' ){
                                $newSettings[$k] = wp_kses_post($settings[$k]);
                            }else if( $k == 'servers' ){
                                $newSettings[$k] = sanitize_textarea_field($settings[$k]);
                            }else{
                                $newSettings[$k] = sanitize_text_field($settings[$k]);
                            }
                        }else{
                            $newSettings[$k] = $defaults[$k];
                        }
                    }
                    update_option( "chpadb_plugin_settings", json_encode($newSettings) );
                    
                    echo esc_attr('Settings save successfully', 'chp-adsblocker-detector');
                }else{
                    echo esc_attr('We got some issue on updating settings.', 'chp-adsblocker-detector');
                }
            }

            /****************************************
            Reset All the settings
            *****************************************/ 
            if( isset( $_POST['reset'] ) ){
                setDefaultValues();
                
                echo esc_attr('Settings reset successfully.', 'chp-adsblocker-detector');
            }
        }else{
            echo esc_attr('Unable to update settings.', 'chp-adsblocker-detector');
        }

        /****************************************
        End ajax request
        *****************************************/ 
        die();
    }

}
