<?php

/**
 * Plugin Name:       CHP Ads Block Detector
 * Plugin URI:        https://chpadblock.com
 * Description:       <code>CHP Ads Block Detector</code> plugin is developed in order to  detect most of the AdBlock extensions installed on the browser and show a popup to disable the extension. This plugin restricts the user to access the page unless the user will disable the extension for your website.
 * Version:           3.8.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Tested up to:      6.0
 * Author:            Suresh Chand
 * Author URI:        https://sureshchand.com.np
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       chp-adsblocker-detector
 * Domain Path:       /languages
 */

namespace CHPADB;

/*****************************************************
 Restrict Direct Access
******************************************************/
if( ! defined( 'ABSPATH' ) ) exit(0);
   
if( ! class_exists( 'adb' ) ){
   
    class adb{

        /**
         * Inilialize main class
         *
         * @param string  null
         *
         * @return string null
         */
        public function init(){

            //load language template
            add_action( 'plugins_loaded', [$this, 'setup_textdomain'] );
            add_filter( 'load_textdomain_mofile', [$this, 'load_lang'], 10, 2 );
            add_action( 'admin_notices', [$this, 'check_for_premium_version'] );

             //load all the constants
            $this->constants();
            add_action( 'upgrader_process_complete', [$this, 'update_settings'], 10, 2 );

            //load all require library
            require_once CHP_ADSB_DIR . 'vendor/autoload.php';

            //load all dependency
            $dependency = new \CHPADB\Includes\dependency;
            $dependency->init();
        }

        /**
         * Restore Old Settings
         */
        private function restore_old_settings(){
            if( ! empty( get_option( 'chp_adb_plugin_title' ) ) ){
                $defaults = \CHPADB\Includes\defaults();
                $settings = array(
                    'enable' => get_option( 'chp_adb_plugin_enable' ),
                    'title' => get_option( 'chp_adb_plugin_title' ),
                    'content' => get_option( 'chp_adb_plugin_content' ),
                    'btn1_show' => get_option( 'chp_adb_plugin_btn1_show' ),
                    'btn1_text' => get_option( 'chp_adb_plugin_btn1_text' ),
                    'btn2_show' => get_option( 'chp_adb_plugin_btn2_show' ),
                    'btn2_text' => get_option( 'chp_adb_plugin_btn2_text' ),
                    'width' => get_option( 'chp_adb_plugin_width' ),   
                    'top' => get_option( 'chp_adb_plugin_from_top' ),
                    'branding' => get_option( 'chp_adb_plugin_branding' )
                );
                $settings = wp_parse_args($settings, $defaults);
                update_option( "chpadb_plugin_settings", json_encode($settings) );

                //delete old options from database
                delete_option( 'chp_adb_plugin_enable' );
                delete_option( 'chp_adb_plugin_title' );
                delete_option( 'chp_adb_plugin_content' );
                delete_option( 'chp_adb_plugin_btn1_show' );
                delete_option( 'chp_adb_plugin_btn1_text' );
                delete_option( 'chp_adb_plugin_btn2_show' );
                delete_option( 'chp_adb_plugin_btn2_text' );
                delete_option( 'chp_adb_plugin_width' );
                delete_option( 'chp_adb_plugin_from_top' );
                delete_option( 'chp_adb_plugin_branding' );
            }
        }

        /**
         * Update Settings
         */
        public function update_settings($upgrader_object, $options){
            $basename = defined("CHP_ADSB_PLUGIN_NAME") ? CHP_ADSB_PLUGIN_NAME : plugin_basename( __FILE__ );
            if( $options['action'] == 'update' && $options['type'] == 'plugin' && isset( $options['plugins'] ) ) {
                foreach( $options['plugins'] as $plugin ) {
                    if( $plugin == $basename ) {
                        //restore old settings
                        $this->restore_old_settings();
                    }
                }
            }
        }

        /**
         * Plugin Deactivate link
         */
        private function plugin_action_link( $plugin, $action = 'deactivate' ) {
            if ( strpos( $plugin, '/' ) ) {
                $plugin = str_replace( '\/', '%2F', $plugin );
            }
            $url = sprintf( admin_url( 'plugins.php?action=' . $action . '&plugin=%s&plugin_status=all&paged=1&s' ), $plugin );
            $_REQUEST['plugin'] = $plugin;
            $url = wp_nonce_url( $url, $action . '-plugin_' . $plugin );
            return $url;
        }

        /**
         * Check for premium version
         */
        public function check_for_premium_version(){
            if( defined( "CHP_ADSB_VERSION_PRO" ) ){
                $url = $this->plugin_action_link("chp-ads-block-detector/chp-adsblocker-detector.php");
                echo sprintf('<div class="notice notice-error"><p>You have premium version of <strong>CHP ADS BLOCK DETECTOR</strong> Plugin. You can disable the free one. Click here to <a href="%s">deactivate a plugin.</a></p></div>', $url);
            }
        }

        /**
         * Load all the languages
         *
         * @param string  null
         *
         * @return string null
         */
        public function setup_textdomain(){
            load_plugin_textdomain( 'chp-adsblocker-detector', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
        }


        /**
         * Load all the languages
         *
         * @param string  null
         *
         * @return string null
         */
        public function load_lang($mofile, $domain){
            if ( 'chp-adsblocker-detector' === $domain ) {
                $locale = apply_filters( 'plugin_locale', determine_locale(), $domain );
                $mofile = WP_PLUGIN_DIR . '/' . dirname( plugin_basename( __FILE__ ) ) . '/languages/' . $domain . '-' . $locale . '.mo';
            }
            return $mofile;
        }

        /**
         * Load all the constants
         *
         * @param string  null
         *
         * @return string null
         */
        public function constants(){

            //load all the constants
            $consts = array(
                'CHP_ADSB_VERSION' => '3.8.1',
                'CHP_ADSB_DIR' => plugin_dir_path( __FILE__ ),
                'CHP_ADSB_URL' => plugin_dir_url( __FILE__ ),
                'CHP_ADSB_PLUGIN_NAME' => plugin_basename(__FILE__)
            );

            foreach($consts as $k => $c){
                
                //if not define then we define here
                if( ! defined( $k ) )
                    define($k, $c);

            }
            
        }

   }
   


    if ( 
        in_array( 
        'chp_adsblocker_detector_pro/chp_adsblocker_detector_pro.php', 
        apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) 
        ) 
    ) {
        
        add_action( 'admin_notices', function(){

            ?>
                <div class="notice notice-error">
                    <p><?php _e( 'You have premium version of <code>CHP Ads Block Detector</code>. You can disable or deactive free version!', 'chp-adsblocker-detector' ); ?></p>
                </div>
            <?php

        } );

    }else{

        /****************************************
        Creating object of Class
        *****************************************/
        $chpadb = new \CHPADB\adb();
        $chpadb->init();

        

        /**
         * On plugin activate
         *
         * @param string  null
         *
         * @return boolean
         */  
        register_activation_hook( __FILE__, function(){

            /****************************************
            Setup default settings
            *****************************************/
            $previous = get_option( 'chp_adb_plugin_title' );
            if( empty( $previous ) )
                \CHPADB\Includes\setDefaultValues();

        } );

        /****************************************
        Run uninstall hook
        *****************************************/ 
        register_deactivation_hook( __FILE__, function(){

            /****************************************
            Do Something on plugin deactivate
            *****************************************/



        } );
        

    }

}

/****************************************
PLUGIN Code End
*****************************************/ 