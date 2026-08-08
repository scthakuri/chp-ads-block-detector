<?php

/**
* Description: Live preview of the adblock popup inside the WordPress Customizer
*
* @package chp-adsblocker-detector
* @since CHPADB 4.0.4
*/

namespace CHPADB\Includes;

/*****************************************************
 Restrict Direct Access
******************************************************/
if( ! defined( 'ABSPATH' ) ) exit(0);

/**
 * Settings are stored as a single JSON-encoded blob in one option
 * ('chpadb_plugin_settings'), not as native WP options — the Customizer's
 * built-in `type => 'option'` array-path support expects the stored option
 * to already be a plain PHP array, so it can't read/write our fields
 * directly. Instead we use a custom setting type ('chpadb_option') and do
 * the read (customize_value_*) and write (customize_update_chpadb_option)
 * ourselves, going through the same sanitizer the settings-page AJAX save
 * already uses so both paths stay consistent.
 */
class Customizer{

    const OPTION_KEY = 'chpadb_plugin_settings';

    /**
     * Fields exposed for live preview. Keep this to genuinely visual
     * settings — technical toggles (minify, header injection, noscript,
     * branding) stay on the dedicated settings page.
     */
    public function fields(){
        return array(
            'enable'     => array( 'label' => __( 'Enable', 'chp-adsblocker-detector' ), 'type' => 'checkbox' ),
            'title'      => array( 'label' => __( 'Title', 'chp-adsblocker-detector' ), 'type' => 'text' ),
            'content'    => array( 'label' => __( 'Content', 'chp-adsblocker-detector' ), 'type' => 'textarea' ),
            'width'      => array( 'label' => __( 'Width (in %)', 'chp-adsblocker-detector' ), 'type' => 'number' ),
            'btn1_show'  => array( 'label' => __( 'Show Refresh Button', 'chp-adsblocker-detector' ), 'type' => 'checkbox' ),
            'btn1_text'  => array( 'label' => __( 'Refresh Button (Text)', 'chp-adsblocker-detector' ), 'type' => 'text' ),
            'btn2_show'  => array( 'label' => __( 'Show Close Button', 'chp-adsblocker-detector' ), 'type' => 'checkbox' ),
            'btn2_text'  => array( 'label' => __( 'Close Button (Text)', 'chp-adsblocker-detector' ), 'type' => 'text' ),
        );
    }

    /**
     * Inilialize customizer class
     *
     * @param string  null
     *
     * @return string null
     */
    public function init(){
        add_action( 'customize_register', [$this, 'register'] );
        add_action( 'wp_footer', [$this, 'force_preview'], 0 );

        // Fires once per field during customize_save — see save() below.
        add_action( 'customize_update_chpadb_option', [$this, 'save'], 10, 2 );

        // Fires once per field when the preview iframe renders — injects the
        // staged (unsaved) value so 'refresh' transport reloads actually
        // reflect in-progress edits instead of the last-saved option.
        add_action( 'customize_preview_chpadb_option', [$this, 'preview_field'] );
    }

    /**
     * Override one field of the decoded settings object with its staged
     * Customizer value for the duration of the preview request.
     *
     * @param \WP_Customize_Setting $setting
     * @return void
     */
    public function preview_field( $setting ){
        if( ! preg_match( '/^' . preg_quote( self::OPTION_KEY, '/' ) . '\[(.+)\]$/', $setting->id, $m ) )
            return;

        $key = $m[1];

        // NB: this filter runs on the plain array, before settings.php casts
        // it to an object on return — index access, not property access.
        add_filter( 'adb/modify/settings', function( $settings ) use ( $key, $setting ){
            $default = isset( $settings[$key] ) ? $settings[$key] : '';
            $settings[$key] = $setting->post_value( $default );
            return $settings;
        } );
    }

    /**
     * Register panel, section, settings and controls
     *
     * @param \WP_Customize_Manager $wp_customize
     * @return void
     */
    public function register( $wp_customize ){

        $wp_customize->add_panel( 'chpadb_customizer_panel', array(
            'title'    => __( 'Ads Block Detector', 'chp-adsblocker-detector' ),
            'priority' => 200,
        ) );

        $wp_customize->add_section( 'chpadb_customizer_section', array(
            'title' => __( 'Popup Settings', 'chp-adsblocker-detector' ),
            'panel' => 'chpadb_customizer_panel',
        ) );

        foreach( $this->fields() as $key => $field ){
            $id = self::OPTION_KEY . '[' . $key . ']';

            $wp_customize->add_setting( $id, array(
                'type'              => 'chpadb_option',
                'capability'        => 'manage_options',
                'transport'         => 'refresh',
                'sanitize_callback' => function( $value ) use ( $key ){
                    return \CHPADB\Includes\adbClass('ajax')->sanitize_array_values( $key, $value );
                },
            ) );

            // Customizer's default value() reads get_option() directly, which
            // won't decode our JSON blob — supply the real current value ourselves.
            add_filter( "customize_value_{$id}", function() use ( $key ){
                $settings = \CHPADB\Includes\adbClass('settings')->get();
                return isset( $settings->$key ) ? $settings->$key : '';
            } );

            $control_args = array(
                'label'   => $field['label'],
                'section' => 'chpadb_customizer_section',
                'type'    => $field['type'] === 'checkbox' ? 'checkbox' : ( $field['type'] === 'textarea' ? 'textarea' : $field['type'] ),
            );

            $wp_customize->add_control( $id, $control_args );
        }
    }

    /**
     * Persist a single field into the JSON settings blob.
     * Bound to the custom 'chpadb_option' setting type — WP core only
     * auto-persists 'option'/'theme_mod' types, so this fires instead for
     * every field on save.
     *
     * @param mixed $value
     * @param \WP_Customize_Setting $setting
     * @return void
     */
    public function save( $value, $setting ){
        if( ! preg_match( '/^' . preg_quote( self::OPTION_KEY, '/' ) . '\[(.+)\]$/', $setting->id, $m ) )
            return;

        $key = $m[1];

        $raw = get_option( self::OPTION_KEY );
        $current = $raw ? json_decode( $raw, true ) : array();
        if( ! is_array( $current ) ) $current = array();

        $current[$key] = $value;
        update_option( self::OPTION_KEY, json_encode( $current ) );
    }

    /**
     * The popup only appears when a real adblocker is detected client-side.
     * Inside the Customizer preview iframe the editing admin usually isn't
     * running one, so without this the live preview would just never show
     * anything. Force it open when previewing so edits are actually visible.
     *
     * @return void
     */
    public function force_preview(){
        if( ! is_customize_preview() ) return;
        ?>
        <script>
        document.addEventListener("DOMContentLoaded", function(){
            if( typeof chp_ads_blocker_detector === "function" ){
                chp_ads_blocker_detector(true);
            }
        });
        </script>
        <?php
    }
}
