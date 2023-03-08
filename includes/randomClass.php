<?php


/**
* Description: Include all the code to for banned ads block by country
* @package chp-ads-block-detector-pro
* @since CHPADB_PRO 3.5
*/

namespace CHPADB\Includes;

/*****************************************************
 Restrict Direct Access
******************************************************/
if( ! defined( 'ABSPATH' ) ) exit(0);

class randomClass{

    /**
     * Generate random string
     * 
     * @since 3.3.3
     */
    private function generateRandomString($length = 10) {
        $characters = 'abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function init(){
        $GLOBALS['chpadblock_rand_classes'] = $this->generateRandomString(5);
        $GLOBALS['chpadblock_equal_rand_classes'] = $this->generateRandomString(5);
    }

    public function get_from_global(){
        if( isset( $GLOBALS['chpadblock_rand_classes'] ) )
            return $GLOBALS['chpadblock_rand_classes'];
        return false;
    }

    /**
     * simple method to encrypt or decrypt a plain text string
     * initialization vector(IV) has to be the same when encrypting and decrypting
     * 
     * @param string $action: can be 'encrypt' or 'decrypt'
     * @param string $string: string to encrypt or decrypt
     *
     * @return string
     */
    public function encrypt_decrypt($string, $action="encrypt") {
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'Ib2jd0z1qqH8scPIrQVaOKWHFtaMWX6ZqgJsDw9aTGblCFJ1Fd';
        $secret_iv = 'Ib2jd0z1qqH8scPIrQVaOKWHFtaMWX6ZqgJsDw9aTGblCFJ1Fd';
        // hash
        $key = hash('sha256', $secret_key);

        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if( $action == 'decrypt' ) {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }

    public function get(){
        $classes = $this->get_from_global();
        if( $classes ){
            return $classes;
        }else{
            $settings = \CHPADB_PRO\Includes\adbpro('settings')->get();
            $rclass = $settings && property_exists($settings, "randomClassfail") ? $settings->randomClassfail : home_url();
            return $this->encrypt_decrypt($rclass);
        }
    }

    public function get_equal_rnd(){
        if( isset( $GLOBALS['chpadblock_equal_rand_classes'] ) )
            return $GLOBALS['chpadblock_equal_rand_classes'];
        return $this->encrypt_decrypt(home_url());
    }

    public function generate_class($class){
        $rclass = $this->get();
        $output = $this->encrypt_decrypt("{$rclass}______{$class}______{$rclass}");
        $equalreplace = $this->get_equal_rnd();
        $output = str_replace("=", $equalreplace, $output);
        $output = preg_replace('!\s+!', ' ', $output);
        $output = preg_replace('/\s+/', '_', $output);
        $output = preg_replace('/[0-9]+/', '', $output);
        return trim(strtolower($output));
    }

}