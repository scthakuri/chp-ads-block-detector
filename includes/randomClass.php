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

        /**
         * Base64 output can contain "+", "/" and "=" which aren't valid,
         * unescaped, in a CSS class/id token - strip anything that isn't
         * a letter or digit instead of only substituting "=".
         */
        $output = preg_replace('/[^a-zA-Z0-9]/', '', $output);
        $output = preg_replace('/[0-9]+/', '', $output);
        $output = trim(strtolower($output));

        /**
         * Break up the pure-alphanumeric shape with an underscore. These
         * generated strings are reused both as CSS class/id tokens AND as
         * JS variable names (view/main_scripts.php), so the separator must
         * be valid in both - a hyphen breaks JS identifiers, "_" doesn't.
         * Ad-block-detector-bypass extensions have been seen blanket-hiding
         * any element whose id/class matches /^[a-zA-Z0-9]{32,}$/, which a
         * long uninterrupted alphanumeric string always trips regardless of
         * its actual (randomized) value.
         */
        $mid = (int) floor(strlen($output) / 2);
        $output = substr($output, 0, $mid) . '_' . substr($output, $mid);

        return $output;
    }

}