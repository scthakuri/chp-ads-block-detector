<?php


/**
* Description: Include all the functions
*
* @package chp-adsblocker-detector
* @since CHPADB 2.3
*/

namespace CHPADB\Includes;

/*****************************************************
 Restrict Direct Access
******************************************************/
if( ! defined( 'ABSPATH' ) ) exit(0);


function setDefaultValues(){
    $options = defaults();
    update_option( 'chp_adb_plugin_enable', $options->enable );
    update_option( 'chp_adb_plugin_title', $options->title );
    update_option( 'chp_adb_plugin_content', $options->content );

    update_option( 'chp_adb_plugin_btn1_show', $options->btn1_show );
    update_option( 'chp_adb_plugin_btn1_text', $options->btn1_text );

    update_option( 'chp_adb_plugin_btn2_show', $options->btn2_show );
    update_option( 'chp_adb_plugin_btn2_text', $options->btn2_text );

    update_option( 'chp_adb_plugin_width', $options->width );
    update_option( 'chp_adb_plugin_from_left', $options->left );
    update_option( 'chp_adb_plugin_from_right', $options->top );

    update_option( 'chp_adb_plugin_hide_mobile', $options->hidemobile );
}



function defaults(){
    return (object) array(
        'enable' => true,
        'content' => '<p>We have detected that you are using extensions to block ads. Please support us by disabling these ads blocker.</p>',
        'title' => 'Ads Blocker Detected!!!',
        'btn1_show' => true,
        'btn2_show' => false,
        'btn1_text' => __('Refresh', 'chp-adsblocker-detector'),
        'btn2_text' => __('Close', 'chp-adsblocker-detector'),
        'width' => '30',
        'top' => '20',
        'left' => '35',
        'hidemobile' => false
    );
}