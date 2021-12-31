<?php

/**
* Description: Include all the code required requires to include scripts
*
* @package chp-adsblocker-detector
* @since CHPADB 2.3
*/


namespace CHPADB\Includes;

/*****************************************************
 Restrict Direct Access
******************************************************/
if( ! defined( 'ABSPATH' ) ) exit(0);


class scripts extends \CHPADB\adb{


    /**
     * Inilialize scripts class
     *
     * @param string  null
     *
     * @return string null
     */
    public function init(){

        add_action( 'admin_enqueue_scripts',  [$this, 'admin_scripts']);

        
        add_action( 'wp_footer',  [$this, 'js'], 100);
        add_action( 'wp_head',  [$this, 'css'], 100);

    }


    /**
     * Include all admin scripts
     *
     * @param string  null
     *
     * @return string null
     */
    public function admin_scripts(){

        //color picker scripts
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );

        //alert css
        wp_enqueue_script( 'chp-ads-alerty-js', CHP_ADSB_URL . 'assets/js/alerty.js', array(), '1.0', true );
        wp_enqueue_style( 'chp-ads-alerty-css', CHP_ADSB_URL . 'assets/css/alerty.css', array(), '1.0', true );

        //plugin css and js code
        $version = filemtime( CHP_ADSB_DIR. 'assets/js/admin.js' );
        wp_enqueue_script( 'chp-ads-admin-js', CHP_ADSB_URL . 'assets/js/admin.js', array(), 
        $version, true );

        $version = filemtime( CHP_ADSB_DIR. 'assets/css/admin.css' );
        wp_enqueue_style( 'chp-ads-admin-css', CHP_ADSB_URL . 'assets/css/admin.css', array(), $version );
        wp_localize_script( 'chp-ads-admin-js', 'chpadb', array(
            'plugin_path' => CHP_ADSB_URL,
            'response' => __('Response!!!', 'chp-adsblocker-detector')
        ) );

    }

    public function css( ){

        //get user settings
        $settings = array(
            'enable' => get_option( 'chp_adb_plugin_enable' ),
            'title' => get_option( 'chp_adb_plugin_title' ),
            'content' => get_option( 'chp_adb_plugin_content' ),
            'btn1_show' => get_option( 'chp_adb_plugin_btn1_show' ),
            'btn1_text' => get_option( 'chp_adb_plugin_btn1_text' ),
            'btn2_show' => get_option( 'chp_adb_plugin_btn2_show' ),
            'btn2_text' => get_option( 'chp_adb_plugin_btn2_text' ),
            'width' => get_option( 'chp_adb_plugin_width' ),   
            'top' => get_option( 'chp_adb_plugin_from_right' ),   
            'left' => get_option( 'chp_adb_plugin_from_left' ),          
        );

        $settings = empty($settings) ? \CHPADB\Includes\defaults() : $settings;
        $settings = (object) wp_parse_args($settings, \CHPADB\Includes\defaults());

        //modifiy the output
        $settings = (object) apply_filters('adb/modify/settings', (array) $settings);
        
        //Check Whether plugin is active
        if( filter_var( $settings->enable, FILTER_VALIDATE_BOOLEAN ) ){

            $header_part = CHP_ADSB_DIR . 'view/header_part.php';
            if( file_exists( $header_part ) ){

                require_once $header_part;

            }
        }

    }

    public function js(){

        /****************************************
        Get user settings
        *****************************************/ 
        $settings = array(
            'enable' => get_option( 'chp_adb_plugin_enable' ),
            'title' => get_option( 'chp_adb_plugin_title' ),
            'content' => get_option( 'chp_adb_plugin_content' ),
            'btn1_show' => get_option( 'chp_adb_plugin_btn1_show' ),
            'btn1_text' => get_option( 'chp_adb_plugin_btn1_text' ),
            'btn2_show' => get_option( 'chp_adb_plugin_btn2_show' ),
            'btn2_text' => get_option( 'chp_adb_plugin_btn2_text' )          
        );

        $settings = empty($settings) ? \CHPADB\Includes\defaults() : $settings;
        $settings = (array) wp_parse_args($settings, \CHPADB\Includes\defaults());

        //modifiy the output
        $settings = apply_filters('adb/modify/settings', $settings);
        
        //Check Whether plugin is active
        if( filter_var( $settings['enable'], FILTER_VALIDATE_BOOLEAN ) ){

            $iconAlernativeFile = CHP_ADSB_URL . 'assets/img/icon.png';
            $iconAlernativeFile = apply_filters( 'adb/change/icon', $iconAlernativeFile );
            $iconAlernativeAlt = apply_filters( 'adb/change/icon/alt', 'Ads Blocker Image Powered by Code Help Pro' );

            $iconCode = '<img class="chp_ads_blocker_detector-icon" src="'.$iconAlernativeFile.'" alt="'.$iconAlernativeAlt.'">';
            $iconCode = apply_filters( 'adb/change/html/icon', $iconCode, $iconAlernativeFile, $iconAlernativeAlt );

            $footer_part = CHP_ADSB_DIR . 'view/footer_part.php';
            if( file_exists( $footer_part ) ){

                require_once $footer_part;

            }
        }
    }

}