<?php

namespace Barryvdh\Composer;

class CleanupRules
{
    public static function getRules()
    {
        // Default patterns for common files
        $docs = 'README* CHANGELOG* FAQ* CONTRIBUTING* HISTORY* UPGRADING* UPGRADE* package* demo example examples doc docs readme*';
        $tests = '.travis.yml .scrutinizer.yml phpunit.xml* phpunit.php test tests Tests';

        return array(

            // Symfony components
            'symfony/browser-kit'                   => array($docs, $tests),
            'symfony/class-loader'                  => array($docs, $tests),
            'symfony/console'                       => array($docs, $tests),
            'symfony/css-selector'                  => array($docs, $tests),
            'symfony/debug'                         => array($docs, $tests),
            'symfony/dom-crawler'                   => array($docs, $tests),
            'symfony/event-dispatcher'              => array($docs, $tests),
            'symfony/filesystem'                    => array($docs, $tests),
            'symfony/finder'                        => array($docs, $tests),
            'symfony/http-foundation'               => array($docs, $tests),
            'symfony/http-kernel'                   => array($docs, $tests),
            'symfony/process'                       => array($docs, $tests),
            'symfony/routing'                       => array($docs, $tests),
            'symfony/security'                      => array($docs, $tests),
            'symfony/security-core'                 => array($docs, $tests),
            'symfony/translation'                   => array($docs, $tests),

            // Default Laravel 4 install
            'd11wtq/boris'                          => array($docs, $tests),
            'filp/whoops'                           => array($docs, $tests),
            'ircmaxell/password-compat'             => array($docs, $tests),
            'jeremeamia/SuperClosure'               => array($docs, $tests, 'demo'),
            'laravel/framework'                     => array($docs, $tests, 'build'),
            'monolog/monolog'                       => array($docs, $tests),
            'nesbot/carbon'                         => array($docs, $tests),
            'nikic/php-parser'                      => array($docs, $tests, 'test_old'),
            'patchwork/utf8'                        => array($docs, $tests),
            'phpseclib/phpseclib'                   => array($docs, $tests),
            'predis/predis'                         => array($docs, $tests, 'bin'),
            'stack/builder'                         => array($docs, $tests),
            'swiftmailer/swiftmailer'               => array($docs, $tests, 'build* notes test-suite create_pear_package.php'),

            // Common packages
            'anahkiasen/former'                     => array($docs, $tests),
            'anahkiasen/html-object'                => array($docs, 'phpunit.xml* tests/*'),
            'anahkiasen/underscore-php'             => array($docs, $tests),
            'anahkiasen/rocketeer'                  => array($docs, $tests),
            'barryvdh/laravel-debugbar'             => array($docs, $tests),
            'barryvdh/laravel-ide-helper'           => array($docs, $tests),
            'bllim/datatables'                      => array($docs, $tests),
            'cartalyst/sentry'                      => array($docs, $tests),
            'dflydev/markdown'                      => array($docs, $tests),
            'doctrine/annotations'                  => array($docs, $tests, 'bin'),
            'doctrine/cache'                        => array($docs, $tests, 'bin'),
            'doctrine/collections'                  => array($docs, $tests),
            'doctrine/common'                       => array($docs, $tests, 'bin lib/vendor'),
            'doctrine/dbal'                         => array($docs, $tests, 'bin build* docs2 lib/vendor'),
            'doctrine/inflector'                    => array($docs, $tests),
            'dompdf/dompdf'                         => array($docs, $tests, 'www'),
            'guzzle/guzzle'                         => array($docs, $tests),
            'guzzlehttp/guzzle'                     => array($docs, $tests),
            'guzzlehttp/oauth-subscriber'           => array($docs, $tests),
            'guzzlehttp/streams'                    => array($docs, $tests),
            'imagine/imagine'                       => array($docs, $tests, 'lib/Imagine/Test'),
            'intervention/image'                    => array($docs, $tests, 'public'),
            'jasonlewis/basset'                     => array($docs, $tests),
            'kriswallsmith/assetic'                 => array($docs, $tests),
            'leafo/lessphp'                         => array($docs, $tests, 'Makefile package.sh'),
            'league/stack-robots'                   => array($docs, $tests),
            'maximebf/debugbar'                     => array($docs, $tests, 'demo'),
            'mccool/laravel-auto-presenter'         => array($docs, $tests),
            'mockery/mockery'                       => array($docs, $tests),
            'mrclay/minify'                         => array($docs, $tests, 'MIN.txt min_extras min_unit_tests min/builder min/config* min/quick-test* min/utils.php min/groupsConfig.php min/index.php'),
            'mustache/mustache'                     => array($docs, $tests, 'bin'),
            'oyejorge/less.php'                     => array($docs, $tests),
            'phenx/php-font-lib'                    => array($docs, $tests. 'www'),
            'phpdocumentor/reflection-docblock'     => array($docs, $tests),
            'phpoffice/phpexcel'                    => array($docs, $tests, 'Examples unitTests changelog.txt'),
            'rcrowe/twigbridge'                     => array($docs, $tests),
            'simplepie/simplepie'                   => array($docs, $tests, 'build compatibility_test ROADMAP.md'),
            'tijsverkoyen/css-to-inline-styles'     => array($docs, $tests),
            'twig/twig'                             => array($docs, $tests),
            'venturecraft/revisionable'             => array($docs, $tests),
            'willdurand/geocoder'                   => array($docs, $tests),
        );
    }

}
