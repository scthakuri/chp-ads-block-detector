<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf838456e91ae97678e86032c6630686b
{
    public static $files = array (
        '63d76c66deba5ecff337ec6136543297' => __DIR__ . '/../..' . '/includes/functions.php',
    );

    public static $prefixesPsr0 = array (
        'J' => 
        array (
            'JShrink' => 
            array (
                0 => __DIR__ . '/..' . '/tedivm/jshrink/src',
            ),
        ),
    );

    public static $classMap = array (
        'CHPADB\\Includes\\ajax' => __DIR__ . '/../..' . '/includes/ajax.php',
        'CHPADB\\Includes\\dependency' => __DIR__ . '/../..' . '/includes/dependency.php',
        'CHPADB\\Includes\\scripts' => __DIR__ . '/../..' . '/includes/scripts.php',
        'CHPADB\\Includes\\settings' => __DIR__ . '/../..' . '/includes/settings.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInitf838456e91ae97678e86032c6630686b::$prefixesPsr0;
            $loader->classMap = ComposerStaticInitf838456e91ae97678e86032c6630686b::$classMap;

        }, null, ClassLoader::class);
    }
}
