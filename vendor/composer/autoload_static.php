<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8a46a27e22548562d8af8a5120ce5442
{
    public static $files = array (
        'a0edc8309cc5e1d60e3047b5df6b7052' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/functions_include.php',
        'c964ee0ededf28c96ebd9db5099ef910' => __DIR__ . '/..' . '/guzzlehttp/promises/src/functions_include.php',
        '37a3dc5111fe8f707ab4c132ef1dbc62' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/functions_include.php',
        '0e6d7bf4a5811bfa5cf40c5ccd6fae6a' => __DIR__ . '/..' . '/symfony/polyfill-mbstring/bootstrap.php',
        'd767e4fc2dc52fe66584ab8c6684783e' => __DIR__ . '/..' . '/adbario/php-dot-notation/src/helpers.php',
        '65fec9ebcfbb3cbb4fd0d519687aea01' => __DIR__ . '/..' . '/danielstjules/stringy/src/Create.php',
        'b067bc7112e384b61c701452d53a14a8' => __DIR__ . '/..' . '/mtdowling/jmespath.php/src/JmesPath.php',
        '66453932bc1be9fb2f910a27947d11b6' => __DIR__ . '/..' . '/alibabacloud/client/src/Functions.php',
        '9c9a81795c809f4710dd20bec1e349df' => __DIR__ . '/..' . '/joshcam/mysqli-database-class/MysqliDb.php',
        '94df122b6b32ca0be78d482c26e5ce00' => __DIR__ . '/..' . '/joshcam/mysqli-database-class/dbObject.php',
    );

    public static $prefixLengthsPsr4 = array (
        'c' => 
        array (
            'clagiordano\\weblibs\\configmanager\\' => 34,
        ),
        'T' => 
        array (
            'TencentCloud\\' => 13,
        ),
        'S' => 
        array (
            'Symfony\\Polyfill\\Mbstring\\' => 26,
            'Stringy\\' => 8,
        ),
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
            'Plume\\' => 6,
        ),
        'O' => 
        array (
            'OSS\\' => 4,
        ),
        'J' => 
        array (
            'JmesPath\\' => 9,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
            'GuzzleHttp\\Promise\\' => 19,
            'GuzzleHttp\\' => 11,
        ),
        'A' => 
        array (
            'AlibabaCloud\\Client\\' => 20,
            'AlibabaCloud\\' => 13,
            'Adbar\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'clagiordano\\weblibs\\configmanager\\' => 
        array (
            0 => __DIR__ . '/..' . '/clagiordano/weblibs-configmanager/src',
        ),
        'TencentCloud\\' => 
        array (
            0 => __DIR__ . '/..' . '/tencentcloud/tencentcloud-sdk-php/src/TencentCloud',
        ),
        'Symfony\\Polyfill\\Mbstring\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-mbstring',
        ),
        'Stringy\\' => 
        array (
            0 => __DIR__ . '/..' . '/danielstjules/stringy/src',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Plume\\' => 
        array (
            0 => __DIR__ . '/..' . '/plumephp/plume/src/Plume',
        ),
        'OSS\\' => 
        array (
            0 => __DIR__ . '/..' . '/aliyuncs/oss-sdk-php/src/OSS',
        ),
        'JmesPath\\' => 
        array (
            0 => __DIR__ . '/..' . '/mtdowling/jmespath.php/src',
        ),
        'GuzzleHttp\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src',
        ),
        'GuzzleHttp\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/promises/src',
        ),
        'GuzzleHttp\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/guzzle/src',
        ),
        'AlibabaCloud\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/alibabacloud/client/src',
        ),
        'AlibabaCloud\\' => 
        array (
            0 => __DIR__ . '/..' . '/alibabacloud/sdk/src',
        ),
        'Adbar\\' => 
        array (
            0 => __DIR__ . '/..' . '/adbario/php-dot-notation/src',
        ),
    );

    public static $fallbackDirsPsr4 = array (
        0 => __DIR__ . '/../..' . '/modules',
    );

    public static $classMap = array (
        'QcloudApi' => __DIR__ . '/..' . '/tencentcloud/tencentcloud-sdk-php/src/QcloudApi/QcloudApi.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8a46a27e22548562d8af8a5120ce5442::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8a46a27e22548562d8af8a5120ce5442::$prefixDirsPsr4;
            $loader->fallbackDirsPsr4 = ComposerStaticInit8a46a27e22548562d8af8a5120ce5442::$fallbackDirsPsr4;
            $loader->classMap = ComposerStaticInit8a46a27e22548562d8af8a5120ce5442::$classMap;

        }, null, ClassLoader::class);
    }
}
