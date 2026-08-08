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

function rclass(){
    $settings = \CHPADB_PRO\Includes\adbpro('settings')->get();
    if( filter_var($settings->randomClass, FILTER_VALIDATE_BOOLEAN) ){
        if( isset( $GLOBALS['chpadbfree_class'] ) ){
            return $GLOBALS['chpadbfree_class'];
        }else{
            return "hamrocsit";
        }
    }

    return null;
}

function adbClass($class){
    if( isset($GLOBALS[$class]) ){
        return $GLOBALS[$class];
    }else{
        $class_path = "\CHPADB\Includes\\$class";
        return new $class_path();
    }
}


function setDefaultValues(){
    $options = defaults();
    update_option( 'chpadb_plugin_settings', json_encode($options) );
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
        'width' => '40',
        'top' => '5',
        'left' => '0',
        'hidemobile' => false,
        'branding' => 'yes',
        "minify" => true,
        "header" => false,
        "noscript" => true
    );
}

/**
 * Minify HTML Code
 */
function minify_html_code($buffer){
    if ( substr( ltrim( $buffer ), 0, 5) == '<?xml' )
        return $buffer;

    $minify_javascript = "false";
    $minify_html_comments = "yes";
    $minify_html_xhtml = "no";
    $minify_html_relative = "no";
    $minify_html_scheme = "no";
    $minify_html_utf8 = "no";

    $mod = '/s';
    if ( $minify_html_utf8 == 'yes' && mb_detect_encoding($buffer, 'UTF-8', true) )
        $mod = '/u';

    $buffer = str_replace(array (chr(13) . chr(10), chr(9)), array (chr(10), ''), $buffer);
    $buffer = str_ireplace(array ('<script', '/script>', '<pre', '/pre>', '<textarea', '/textarea>', '<style', '/style>'), array ('M1N1FY-ST4RT<script', '/script>M1N1FY-3ND', 'M1N1FY-ST4RT<pre', '/pre>M1N1FY-3ND', 'M1N1FY-ST4RT<textarea', '/textarea>M1N1FY-3ND', 'M1N1FY-ST4RT<style', '/style>M1N1FY-3ND'), $buffer);
    $split = explode('M1N1FY-3ND', $buffer);
    $buffer = ''; 

    for ($i=0; $i<count($split); $i++) {
        $ii = strpos($split[$i], 'M1N1FY-ST4RT');
        if ($ii !== false) {
            $process = substr($split[$i], 0, $ii);
            $asis = substr($split[$i], $ii + 12);
            if (substr($asis, 0, 7) == '<script') {
                $split2 = explode(chr(10), $asis);
                $asis = '';
                for ($iii = 0; $iii < count($split2); $iii ++) {
                    if ($split2[$iii])
                        $asis .= trim($split2[$iii]) . chr(10);
                    if ( $minify_javascript != 'no' )
                        if (strpos($split2[$iii], '//') !== false && substr(trim($split2[$iii]), -1) == ';' )
                            $asis .= chr(10);
                }
                if ($asis)
                    $asis = substr($asis, 0, -1);
                if ( $minify_html_comments != 'no' )
                    $asis = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $asis);
                if ( $minify_javascript != 'no' )
                    $asis = str_replace(array (';' . chr(10), '>' . chr(10), '{' . chr(10), '}' . chr(10), ',' . chr(10)), array(';', '>', '{', '}', ','), $asis);
            } else if (substr($asis, 0, 6) == '<style') {
                $asis = preg_replace(array ('/\>[^\S ]+' . $mod, '/[^\S ]+\<' . $mod, '/(\s)+' . $mod), array('>', '<', '\\1'), $asis);
                if ( $minify_html_comments != 'no' )
                    $asis = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $asis);
                $asis = str_replace(array (chr(10), ' {', '{ ', ' }', '} ', '( ', ' )', ' :', ': ', ' ;', '; ', ' ,', ', ', ';}'), array('', '{', '{', '}', '}', '(', ')', ':', ':', ';', ';', ',', ',', '}'), $asis);
            }
        } else {
            $process = $split[$i];
            $asis = '';
        }
        $process = preg_replace(array ('/\>[^\S ]+' . $mod, '/[^\S ]+\<' . $mod, '/(\s)+' . $mod), array('>', '<', '\\1'), $process);
        if ( $minify_html_comments != 'no' )
            $process = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->' . $mod, '', $process);
        $buffer .= $process.$asis;
    }

    $buffer = str_replace(array (chr(10) . '<script', chr(10) . '<style', '*/' . chr(10), 'M1N1FY-ST4RT'), array('<script', '<style', '*/', ''), $buffer);

    if ( $minify_html_xhtml == 'yes' && strtolower( substr( ltrim( $buffer ), 0, 15 ) ) == '<!doctype html>' )
        $buffer = str_replace( ' />', '>', $buffer );
    if ( $minify_html_relative == 'yes' )
        $buffer = str_replace( array ( 'https://' . $_SERVER['HTTP_HOST'] . '/', 'http://' . $_SERVER['HTTP_HOST'] . '/', '//' . $_SERVER['HTTP_HOST'] . '/' ), array( '/', '/', '/' ), $buffer );
    if ( $minify_html_scheme == 'yes' )
        $buffer = str_replace( array( 'http://', 'https://' ), '//', $buffer );

    return $buffer;
}

function getBrandingCode($enable=true){
    if( filter_var($enable, FILTER_VALIDATE_BOOLEAN) ){

        $rclass = \CHPADB\Includes\adbClass('scripts');

        $brandingURLArray = array("https://chpadblock.com/", "https://toolkitspro.com");
        $brandingURLAlt = array("Best Wordpress Adblock Detecting Plugin | CHP Adblock", "100% Free SEO Tools - Tool Kits PRO");
        $random = array_rand($brandingURLArray);
        $brandingURL = $brandingURLArray[$random];
        $brandingText = $brandingURLAlt[$random];
        return sprintf('<div class="%s"><a id="%s" href="%s" target="_blank" rel="noopener noreferrer"><span class="%s" style="color: rgb(9, 13, 22);">Powered By</span> <div class="%s"><img src="%sassets/img/d.svg" alt="%s" /></div></a></div>', $rclass->rclass("chp_branding"), $rclass->rclass("chp_branding"), $brandingURL, $rclass->rclass("powered_by"), $rclass->rclass("chp_brading_svg"), CHP_ADSB_URL, $brandingText);
    }

    return false;
}