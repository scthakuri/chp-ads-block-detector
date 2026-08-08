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

    private $minify = true;
    private $settings;


    /**
     * Inilialize scripts class
     *
     * @param string  null
     *
     * @return string null
     */
    public function init(){
        $this->minify = apply_filters( "adb/minify/enable", true );
        add_action( 'admin_enqueue_scripts',  [$this, 'admin_scripts']);

        /****************************************
        Get user settings
        *****************************************/ 
        $this->settings = \CHPADB\Includes\adbClass('settings')->get();
        
        add_action( 'wp_head',  [$this, 'css'], 1);

        if( ! filter_var( @$this->settings->header, FILTER_VALIDATE_BOOLEAN ) ){
            add_action( 'wp_footer',  [$this, 'js'], 1);
        }else{
            if( has_action("wp_body_open") ){
                add_action( 'wp_body_open',  [$this, 'js'], 1);
            }else{
                add_action( 'wp_footer',  [$this, 'js'], 1);
            }
        }
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

        //plugin css and js code
        $version = filemtime( CHP_ADSB_DIR. 'assets/js/admin.js' );
        wp_enqueue_script( 'chp-ads-admin-js', CHP_ADSB_URL . 'assets/js/admin.js', array(), 
        $version, true );

        $version = filemtime( CHP_ADSB_DIR. 'assets/css/admin.css' );
        wp_enqueue_style( 'chp-ads-admin-css', CHP_ADSB_URL . 'assets/css/admin.css', array(), $version );
        wp_localize_script( 'chp-ads-admin-js', 'chpadb', array(
            'plugin_path' => CHP_ADSB_URL,
            'response' => __('Response!!!', 'chp-adsblocker-detector')
        ));
    }

    public function minify($content){
        $content = str_replace("\n", " ", $content);
        $content = preg_replace("/([0-9]*px(?!;))/", "$1 ", $content);
        $content = preg_replace('!\s+!', ' ', $content);
        return $content;
    }

    public function rclass($class){
        return \CHPADB\Includes\adbClass("randomClass")->generate_class($class);
    }

    public function css( ){
        //Check Whether plugin is active
        if( filter_var( @$this->settings->enable, FILTER_VALIDATE_BOOLEAN ) ){

            $header_part = CHP_ADSB_DIR . 'view/header_part.php';
            if( file_exists( $header_part ) ){
                ob_start();
                require_once $header_part;
                $content = ob_get_clean();
                if( wp_validate_boolean( $this->minify ) ){
                    $content = $this->minify($content);
                }
                echo wp_kses($content, array(
                    "style" => array()
                ));
            }
        }
    }

    public function js(){
        global $wp;
        //Check Whether plugin is active
        if( filter_var( @$this->settings->enable, FILTER_VALIDATE_BOOLEAN ) ){

            $branding = apply_filters('adb/branding', @$this->settings->branding);
            $brandingcode = getBrandingCode($branding);

            $iconAlernativeFile = CHP_ADSB_URL . 'assets/img/icon.png';
            $iconAlernativeFile = apply_filters( 'adb/change/icon', $iconAlernativeFile );
            $iconAlernativeAlt = apply_filters( 'adb/change/icon/alt', 'Ads Blocker Image Powered by Code Help Pro' );

            $iconClass = $this->rclass("icon");
            $iconCode = '<img class="'. esc_attr( $iconClass ) .'" src="'. esc_url($iconAlernativeFile) .'" alt="'. esc_attr( $iconAlernativeAlt ) .'">';
            $iconCode = apply_filters( 'adb/change/html/icon', $iconCode, $iconAlernativeFile, $iconAlernativeAlt );

            $footer_part = CHP_ADSB_DIR . 'view/footer_part.php';
            if( file_exists( $footer_part ) ){
                ob_start();
                require_once $footer_part;
                $content = ob_get_clean();
                echo \CHPADB\Includes\minify_html_code($content);
            }

            /** Add Noscript tag */
            if( filter_var( @$this->settings->noscript, FILTER_VALIDATE_BOOLEAN ) ){
                ob_start();
                require_once CHP_ADSB_DIR . 'view/noscript.php';;
                echo ob_get_clean();
            }
        }
    }

}