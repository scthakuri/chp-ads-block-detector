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
        add_action( 'admin_menu', [$this, 'manage_external_links'] );

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

    public function manage_external_links(){
        try {
            global $submenu;
            $url = 'https://chpadblock.com/';
            $supurl = 'https://chpadblock.com/docs/support/';
            $submenu['chp-adsblocker-detector'][1] = array( 'Support', 'manage_options', $supurl, 'Support' );
            $submenu['chp-adsblocker-detector'][2] = array( 'Buy Pro', 'manage_options', $url, 'Buy Pro' );
        } catch (\Throwable $th) {
            //throw $th;
        } catch (\Exception $th) {
            //throw $th;
        }
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
            __( 'ADS BLOCK', 'chp-adsblocker-detector' ),
            __( 'ADS BLOCK', 'chp-adsblocker-detector' ),
            'manage_options',
            'chp-adsblocker-detector',
            [$this, 'setting_page'],
            'dashicons-nametag',
            20
        );

        add_submenu_page(
            'chp-adsblocker-detector',
            __( 'Settings', 'chp-adsblocker-detector' ),
            __( 'Settings', 'chp-adsblocker-detector' ),
            'manage_options',
            'chp-adsblocker-detector',
            [$this, 'setting_page']
        );

        add_submenu_page(
            'chp-adsblocker-detector',
            __( 'Support', 'chp-adsblocker-detector' ),
            __( 'Support', 'chp-adsblocker-detector' ),
            'manage_options',
            'chpads-support',
            null
        );

        add_submenu_page(
            'chp-adsblocker-detector',
            __( 'Buy Pro', 'chp-adsblocker-detector' ),
            __( 'Buy Pro', 'chp-adsblocker-detector' ),
            'manage_options',
            'chpads-pro',
            null
        );
    }

    /**
     * Get all settings
     * 
     */
    public function get(){

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

        // if( empty($settings['branding']) ){
        //     $settings['branding'] = 'yes';
        // }

        if( empty( $settings['top'] ) ){
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
                'chp_adb_plugin_enable',
                '',
                [$this, 'ofs_null'],
                'chp_abd_settings',
                'chp_abd_settings_section'
            );

            add_settings_field(
                'chp_adb_plugin_title',
                '',
                [$this, 'ofs_null'],
                'chp_abd_settings',
                'chp_abd_settings_section'
            );

            add_settings_field(
                'chp_adb_plugin_content',
                '',
                [$this, 'ofs_null'],
                'chp_abd_settings',
                'chp_abd_settings_section'
            );

            add_settings_field(
                'chp_adb_plugin_btn1_show',
                '',
                [$this, 'ofs_null'],
                'chp_abd_settings',
                'chp_abd_settings_section'
            );
            
            add_settings_field(
                'chp_adb_plugin_width',
                '',
                [$this, 'ofs_null'],
                'chp_abd_settings',
                'chp_abd_settings_section'
            );

            add_settings_field(
                'chp_adb_plugin_from_top',
                '',
                [$this, 'ofs_null'],
                'chp_abd_settings',
                'chp_abd_settings_section'
            );

            add_settings_field(
                'chp_adb_plugin_btn2_show',
                '',
                [$this, 'ofs_null'],
                'chp_abd_settings',
                'chp_abd_settings_section'
            );

            add_settings_field(
                'chp_adb_plugin_btn1_text',
                '',
                [$this, 'ofs_null'],
                'chp_abd_settings',
                'chp_abd_settings_section'
            );

            add_settings_field(
                'chp_adb_plugin_btn2_text',
                '',
                [$this, 'ofs_null'],
                'chp_abd_settings',
                'chp_abd_settings_section'
            );

            add_settings_field(
                'chp_adb_plugin_branding',
                '',
                [$this, 'ofs_null'],
                'chp_abd_settings',
                'chp_abd_settings_section'
            );
    }

}