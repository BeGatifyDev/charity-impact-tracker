<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit2d5f4cc9d1912fd2e67e87fbbcf2a946
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'CIT\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'CIT\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2d5f4cc9d1912fd2e67e87fbbcf2a946::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2d5f4cc9d1912fd2e67e87fbbcf2a946::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit2d5f4cc9d1912fd2e67e87fbbcf2a946::$classMap;

        }, null, ClassLoader::class);
    }
}
