<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd96e58e23a911a3ea876c423e7342f96
{
    public static $prefixLengthsPsr4 = array (
        'V' => 
        array (
            'Valitron\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Valitron\\' => 
        array (
            0 => __DIR__ . '/..' . '/vlucas/valitron/src/Valitron',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd96e58e23a911a3ea876c423e7342f96::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd96e58e23a911a3ea876c423e7342f96::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd96e58e23a911a3ea876c423e7342f96::$classMap;

        }, null, ClassLoader::class);
    }
}
