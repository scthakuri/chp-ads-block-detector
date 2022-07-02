<?php

/**
* Description: Include all the code to load all dependency
*
* @package chp-adsblocker-detector
* @since CHPADB 2.3
*/


namespace CHPADB\Includes;

/*****************************************************
 Restrict Direct Access
******************************************************/
if( ! defined( 'ABSPATH' ) ) exit(0);


class dependency{


    /**
     * Inilialize dependency
     *
     * @param string  null
     *
     * @return string null
     */
    public function init(){

        $modules = $this->get_modules();

        foreach($modules as $class){

            //check module exists or not
            $path = CHP_ADSB_DIR . "includes/$class.php";
            
            if( file_exists( $path ) ){
                $class_path = "\CHPADB\Includes\\$class";
                $module = new $class_path();
                $module->init();
                $GLOBALS[$class] = $module;
            }

        }

    }

    /**
     * Get all the dependency
     *
     * @param string  null
     *
     * @return string null
     */
    public function get_modules(){

        return array(
            'randomClass',
            'scripts',
            'settings',
            'ajax',
            'update'
        );

    }

}

?>