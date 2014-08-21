<?php

namespace Barryvdh\Composer;

class CleanupRules
{
    public static function getRules()
    {
        // Default patterns for common files
        $docs = 'README* CHANGELOG* FAQ* CONTRIBUTING* HISTORY* UPGRADING* UPGRADE* package* demo example examples doc docs readme*';
        $tests = '.travis.yml .scrutinizer.yml phpunit.xml* phpunit.php test tests Tests';
        $standard = "{$docs} {$tests}";

        return array(

            // Symfony components
            'symfony/browser-kit'                   => "{$standard}",
            'symfony/class-loader'                  => "{$standard}",
            'symfony/console'                       => "{$standard}",
            'symfony/css-selector'                  => "{$standard}",
            'symfony/debug'                         => "{$standard}",
            'symfony/dom-crawler'                   => "{$standard}",
            'symfony/event-dispatcher'              => "{$standard}",
            'symfony/filesystem'                    => "{$standard}",
            'symfony/finder'                        => "{$standard}",
            'symfony/http-foundation'               => "{$standard}",
            'symfony/http-kernel'                   => "{$standard}",
            'symfony/process'                       => "{$standard}",
            'symfony/routing'                       => "{$standard}",
            'symfony/security'                      => "{$standard}",
            'symfony/security-core'                 => "{$standard}",
            'symfony/translation'                   => "{$standard}",

            // Default Laravel 4 install
            'd11wtq/boris'                          => "{$standard}",
            'filp/whoops'                           => "{$standard}",
            'ircmaxell/password-compat'             => "{$standard}",
            'jeremeamia/SuperClosure'               => "{$standard}",
            'laravel/framework'                     => "{$standard} build",
            'monolog/monolog'                       => "{$standard}",
            'nesbot/carbon'                         => "{$standard}",
            'nikic/php-parser'                      => "{$standard} test_old",
            'patchwork/utf8'                        => "{$standard}",
            'phpseclib/phpseclib'                   => "{$standard}",
            'predis/predis'                         => "{$standard} bin",
            'stack/builder'                         => "{$standard}",
            'swiftmailer/swiftmailer'               => "{$standard} build* notes test-suite create_pear_package.php",

            // Common packages
            'anahkiasen/former'                     => "{$standard}",
            'anahkiasen/html-object'                => "{$docs} phpunit.xml* tests/*",
            'anahkiasen/underscore-php'             => "{$standard}",
            'anahkiasen/rocketeer'                  => "{$standard}",
            'barryvdh/laravel-debugbar'             => "{$standard}",
            'bllim/datatables'                      => "{$standard}",
            'cartalyst/sentry'                      => "{$standard}",
            'dflydev/markdown'                      => "{$standard}",
            'doctrine/annotations'                  => "{$standard} bin",
            'doctrine/cache'                        => "{$standard} bin",
            'doctrine/collections'                  => "{$standard}",
            'doctrine/common'                       => "{$standard} bin lib/vendor",
            'doctrine/dbal'                         => "{$standard} bin build* docs2 lib/vendor",
            'doctrine/inflector'                    => "{$standard}",
            'dompdf/dompdf'                         => "{$standard} www",
            'guzzle/guzzle'                         => "{$standard}",
            'guzzlehttp/guzzle'                     => "{$standard}",
            'guzzlehttp/oauth-subscriber'           => "{$standard}",
            'guzzlehttp/streams'                    => "{$standard}",
            'imagine/imagine'                       => "{$standard} lib/Imagine/Test",
            'intervention/image'                    => "{$standard} public",
            'jasonlewis/basset'                     => "{$standard}",
            'jeremeamia/SuperClosure'               => "{$standard} demo",
            'kriswallsmith/assetic'                 => "{$standard}",
            'leafo/lessphp'                         => "{$standard} Makefile package.sh",
            'league/stack-robots'                   => "{$standard}",
            'maximebf/debugbar'                     => "{$standard} demo",
            'mockery/mockery'                       => "{$standard}",
            'mrclay/minify'                         => "{$standard} MIN.txt min_extras min_unit_tests min/builder min/config* min/quick-test* min/utils.php min/groupsConfig.php min/index.php",
            'mustache/mustache'                     => "{$standard} bin",
            'oyejorge/less.php'                     => "{$standard}",
            'phenx/php-font-lib'                    => "{$standard} www",
            'phpdocumentor/reflection-docblock'     => "{$standard}",
            'phpoffice/phpexcel'                    => "{$standard} Examples unitTests changelog.txt",
            'rcrowe/twigbridge'                     => "{$standard}",
            'tijsverkoyen/css-to-inline-styles'     => "{$standard}",
            'twig/twig'                             => "{$standard}",
            'venturecraft/revisionable'             => "{$standard}",
            'willdurand/geocoder'                   => "{$standard}",

        );
    }

}
