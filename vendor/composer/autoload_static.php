<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3465d6574e083e95269eec1600ac251e
{
    public static $prefixLengthsPsr4 = array (
        'N' => 
        array (
            'Newsite\\Login\\' => 14,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Newsite\\Login\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src/classes/auth',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3465d6574e083e95269eec1600ac251e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3465d6574e083e95269eec1600ac251e::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
