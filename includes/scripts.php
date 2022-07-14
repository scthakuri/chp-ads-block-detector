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

    public function minify($content){
        $content = str_replace("\n", " ", $content);
        $content = preg_replace("/([0-9]*px(?!;))/", "$1 ", $content);
        $content = preg_replace('!\s+!', ' ', $content);
        return $content;
    }

    private function rclass($class){
        return \CHPADB\Includes\adbClass("randomClass")->generate_class($class);
    }

    public function css( ){

        //get user settings
        $settings = \CHPADB\Includes\adbClass('settings')->get();
        
        //Check Whether plugin is active
        if( filter_var( $settings->enable, FILTER_VALIDATE_BOOLEAN ) ){

            $header_part = CHP_ADSB_DIR . 'view/header_part.php';
            if( file_exists( $header_part ) ){
                ob_start();
                require_once $header_part;
                $content = ob_get_clean();
                $content = $this->minify($content);
                echo $content;
            }
        }

    }

    private function request_servers(){
        $servers = array("https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js", "https://ads.facebook.com", "https://advice-ads.s3.amazonaws.com");
        $servers = apply_filters("chp/adb/request/servers", $servers);
        $output = '';
        foreach($servers as $s){
            $output .= sprintf('"%s", ', $s);
        }
        $output = trim($output);
        $output = rtrim($output, ",");
        return $output;
    }

    public function js(){

        /****************************************
        Get user settings
        *****************************************/ 
        $settings = \CHPADB\Includes\adbClass('settings')->get();
        
        //Check Whether plugin is active
        if( filter_var( $settings->enable, FILTER_VALIDATE_BOOLEAN ) ){

            $iconAlernativeFile = CHP_ADSB_URL . 'assets/img/icon.png';
            $iconAlernativeFile = apply_filters( 'adb/change/icon', $iconAlernativeFile );
            $iconAlernativeAlt = apply_filters( 'adb/change/icon/alt', 'Ads Blocker Image Powered by Code Help Pro' );

            $iconClass = $this->rclass("icon");
            $iconCode = '<img class="'.$iconClass.'" src="'.$iconAlernativeFile.'" alt="'.$iconAlernativeAlt.'">';
            $iconCode = apply_filters( 'adb/change/html/icon', $iconCode, $iconAlernativeFile, $iconAlernativeAlt );

            $footer_part = CHP_ADSB_DIR . 'view/footer_part.php';
            if( file_exists( $footer_part ) ){

                require_once $footer_part;

            }
        }
    }

}