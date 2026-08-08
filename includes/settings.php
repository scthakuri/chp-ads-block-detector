<?php

/**
* Description: Include all the code required to settings scripts
*
* @package chp-adsblocker-detector
* @since CHPADB 2.3
*/


namespace CHPADB\Includes;

/*****************************************************
 Restrict Direct Access
******************************************************/
if( ! defined( 'ABSPATH' ) ) exit(0);


class settings{


    /**
     * Inilialize scripts class
     *
     * @param string  null
     *
     * @return string null
     */
    public function init(){

        //adding plguin settings label
        add_filter('plugin_action_links_' . CHP_ADSB_PLUGIN_NAME, [$this, 'plugin_links'], 10, 2  );

        //adding admin menu
        add_action( 'admin_menu', [$this, 'admin_menu'] );

        //register settings
        add_action('admin_init', [$this, 'settings']);
    }

    /**
     * Adding plugin settings label
     *
     * @param string  null
     *
     * @return string null
     */
    function plugin_links($links, $file){

        /****************************************
        Insert Settings link
        *****************************************/
        $links[] = '<a style="color:#009688;font-weight:bold;" href="admin.php?page=chp-adsblocker-detector">'.__('Settings','chp-adsblocker-detector').'</a>';
        $links[] = '<a style="color:red;font-weight:bold;" target="_blank" href="https://chpadblock.com/pricing/">'.__('BUY PRO!!','chp-adsblocker-detector').'</a>';
        return $links;

    }

    /**
     * Adding admin menu
     *
     * @param string  null
     *
     * @return string null
     */
    public function admin_menu( ){
        add_menu_page(
            __( 'Adblock', 'chp-adsblocker-detector' ),
            __( 'Adblock', 'chp-adsblocker-detector' ),
            'manage_options',
            'chp-adsblocker-detector',
            [$this, 'setting_page'],
            'dashicons-nametag',
            20
        );
    }

    /**
     * Get all settings
     * 
     */
    public function get(){

        $defaults = (array) \CHPADB\Includes\defaults();
        $settings = get_option( 'chpadb_plugin_settings' );

        if( $settings && !empty( $settings ) ){
            $settings = json_decode($settings, true);
        }else{
            $settings = array();
        }

        
        if( !isset($settings['top']) || empty( $settings['top'] ) ){
            $settings['top'] = "5";
        }

        $settings = wp_parse_args($settings, $defaults);
        return (object) apply_filters('adb/modify/settings', $settings);
    }


    /**
     * Settings html page
     *
     * @param string  null
     *
     * @return string null
     */
    public function setting_page( ){

        $settings = $this->get();

        if( file_exists ( CHP_ADSB_DIR. 'view/settings.php' ) )
            require_once CHP_ADSB_DIR. 'view/settings.php';

    }


    /**
     * register settings
     *
     * @param string  null
     *
     * @return string null
     */
    public function settings(){
        register_setting('chp_abd_settings', 'registred_chp_abd_settings');
            add_settings_section(
                'chp_abd_settings_section',
                '',
                [$this, 'ofs_null'],
                'chp_abd_settings'
            );

            add_settings_field(
                'chpadb_plugin_settings',
                '',
                [$this, 'ofs_null'],
                'chp_abd_settings',
                'chp_abd_settings_section'
            );
    }

}