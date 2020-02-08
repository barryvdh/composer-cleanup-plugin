<?php

declare(strict_types = 1);

namespace AvtoDev\Composer\Cleanup;

class Rules
{
    /**
     * Get cleanup rules as array, where key is package name, and value is whitespace separated directories or file
     * names, which must be deleted.
     *
     * Values can contains asterisk (`*` - zero or more characters) and question mark (`?` - exactly one character).
     *
     * @see <https://www.php.net/manual/en/function.glob.php#refsect1-function.glob-parameters>
     *
     * @return array<string, string>
     */
    public static function getRules(): array
    {
        $docs     = 'README.* CHANGELOG.* FAQ* CONTRIBUTING.* HISTORY* UPGRADING* UPGRADE* LICENSE* ' .
                    'CODE_OF_CONDUCT* NOTICE* SECURITY* docs readme* changelog* ChangeLog* TODO*';
        $settings = '.php_cs .php_cs.dist .gitignore phpcs.* .editorconfig .gush.yml .styleci.yml';
        $dot_git  = '.github .gitlab';
        $js       = 'package* *.js yarn.lock';
        $tests    = 'tests test phpunit.xml* phpstan.* phpbench.* psalm.* .travis.yml build.xml .scrutinizer.yml ' .
                    'phive.xml';

        return [
            'aws/aws-sdk-php'                       => "{$docs} src/data",
            'binarytorch/larecipe'                  => "{$docs} {$dot_git} {$js}",
            'clue/stream-filter'                    => "{$docs} {$settings} {$tests} examples",
            'dnoegel/php-xdg-base-dir'              => $docs,
            'doctrine/annotations'                  => "{$docs} {$tests}",
            'doctrine/inflector'                    => "{$docs} {$tests}",
            'doctrine/instantiator'                 => "{$docs} {$dot_git} {$tests}",
            'doctrine/lexer'                        => $docs,
            'dragonmantank/cron-expression'         => "{$docs} {$settings} {$tests}",
            'egulias/email-validator'               => "{$docs} {$tests}",
            'enqueue/amqp-ext'                      => $docs,
            'enqueue/amqp-tools'                    => $docs,
            'enqueue/dsn'                           => $docs,
            'erusev/parsedown'                      => $docs,
            'erusev/parsedown-extra'                => "{$docs} {$tests}",
            'fideloper/proxy'                       => $docs,
            'filp/whoops'                           => $docs,
            'friendsofphp/php-cs-fixer'             => "{$docs} {$tests} doc *.sh",
            'fzaninotto/faker'                      => "{$docs} {$dot_git} .travis " . \implode(' ',
                    \array_map(static function (string $locale): string {
                        return "src/Faker/Provider/{$locale}";
                    }, self::getFzaninottoFakerLocales())
                ),
            'guzzlehttp/guzzle'                     => "{$docs} {$settings}",
            'guzzlehttp/promises'                   => "{$docs} Makefile",
            'guzzlehttp/psr7'                       => $docs,
            'hamcrest/hamcrest-php'                 => "{$docs} {$settings} {$tests} .travis",
            'http-interop/http-factory-guzzle'      => "{$docs} {$tests}",
            'jakub-onderka/php-console-color'       => "{$docs} {$tests}",
            'jakub-onderka/php-console-highlighter' => "{$docs} {$tests} examples",
            'johnkary/phpunit-speedtrap'            => "{$docs} {$tests}",
            'justinrainbow/json-schema'             => "{$docs} {$tests} demo",
            'kevinrob/guzzle-cache-middleware'      => "{$docs} {$dot_git} {$tests}",
            'laravel/tinker'                        => "{$docs} {$settings}",
            'league/flysystem'                      => $docs,
            'league/flysystem-aws-s3-v3'            => $docs,
            'mockery/mockery'                       => "{$docs} {$tests} docker Makefile",
            'monolog/monolog'                       => $docs,
            'mtdowling/jmespath.php'                => "{$docs} {$tests} Makefile",
            'myclabs/deep-copy'                     => "{$docs} {$dot_git}",
            'nesbot/carbon'                         => "{$docs} {$dot_git} {$tests} .multi-tester.yml",
            'nunomaduro/collision'                  => "{$docs} {$tests}",
            'ocramius/package-versions'             => "{$docs} {$dot_git} {$tests}",
            'opis/closure'                          => $docs,
            'paragonie/random_compat'               => "{$docs} {$tests} *.sh",
            'paragonie/sodium_compat'               => "{$docs} {$tests} *.sh plasm-*.* dist",
            'phar-io/manifest'                      => "{$docs} {$tests} examples",
            'php-cs-fixer/diff'                     => "{$docs} {$tests}",
            'php-http/client-common'                => "{$docs} {$settings}",
            'php-http/discovery'                    => $docs,
            'php-http/guzzle6-adapter'              => $docs,
            'php-http/httplug'                      => $docs,
            'php-http/message'                      => $docs,
            'php-http/message-factory'              => $docs,
            'php-http/promise'                      => $docs,
            'phpdocumentor/reflection-common'       => "{$docs} {$tests}",
            'phpdocumentor/reflection-docblock'     => "{$docs} {$tests}",
            'phpdocumentor/type-resolver'           => "{$docs} {$dot_git} {$tests}",
            'phpstan/phpstan'                       => $docs,
            'phpunit/php-code-coverage'             => "{$docs} {$dot_git} {$tests}",
            'phpunit/php-file-iterator'             => "{$docs} {$dot_git} {$tests}",
            'phpunit/php-timer'                     => "{$docs} {$dot_git} {$tests}",
            'phpunit/php-token-stream'              => "{$docs} {$dot_git} {$tests}",
            'phpunit/phpunit'                       => "{$docs} {$settings} {$dot_git} {$tests}",
            'psy/psysh'                             => "{$docs} {$tests} test vendor-bin Makefile",
            'queue-interop/amqp-interop'            => "{$docs} {$tests}",
            'queue-interop/queue-interop'           => "{$docs} {$tests}",
            'ramsey/uuid'                           => $docs,
            'sebastian/code-unit-reverse-lookup'    => "{$docs} {$tests}",
            'sebastian/comparator'                  => "{$docs} {$dot_git} {$tests}",
            'sebastian/diff'                        => "{$docs} {$dot_git} {$tests}",
            'sebastian/environment'                 => "{$docs} {$dot_git} {$tests}",
            'sebastian/exporter'                    => "{$docs} {$dot_git} {$tests}",
            'sebastian/object-enumerator'           => "{$docs} {$dot_git} {$tests}",
            'sebastian/object-reflector'            => "{$docs} {$dot_git} {$tests}",
            'sebastian/recursion-context'           => "{$docs} {$dot_git} {$tests}",
            'sebastian/resource-operations'         => "{$docs} {$dot_git} {$tests}",
            'sebastian/version'                     => $docs,
            'sentry/sentry'                         => $docs,
            'sentry/sentry-laravel'                 => "{$docs} {$tests} Makefile",
            'spiral/goridge'                        => "{$docs} {$tests} examples *.go go.mod go.sum *.xml",
            'spiral/roadrunner'                     => "{$docs} {$dot_git} {$tests} cmd osutil service util *.mod *.go *.xml Makefile *.sh",
            'swiftmailer/swiftmailer'               => "{$docs} {$dot_git} {$tests}",
            'symfony/psr-http-message-bridge'       => "{$docs} {$tests}",
            'symfony/service-contracts'             => "{$docs} {$tests}",
            'symfony/translation'                   => "{$docs} {$tests} Tests",
            'symfony/translation-contracts'         => "{$docs} {$tests} Test",
            'symfony/var-dumper'                    => "{$docs} {$tests} Tests",
            'theseer/tokenizer'                     => "{$docs} {$tests}",
        ];
    }

    /**
     * @return array<string>
     */
    protected static function getFzaninottoFakerLocales(): array
    {
        return [
            'el_GR', 'en_SG', 'fa_IR', 'ja_JP', 'mn_MN', 'pl_PL', 'vi_VN', 'zh_CN', 'sk_SK',
            'ar_JO', 'en_AU', 'en_UG', 'fi_FI', 'hu_HU', 'ka_GE', 'ms_MY', 'pt_BR', 'sr_RS',
            'ar_SA', 'cs_CZ', 'en_CA', 'hy_AM', 'kk_KZ', 'nb_NO', 'pt_PT', 'sv_SE', 'zh_TW',
            'at_AT', 'da_DK', 'en_ZA', 'fr_BE', 'id_ID', 'ko_KR', 'ne_NP', 'ro_MD', 'tr_TR',
            'en_HK', 'es_AR', 'fr_CA', 'nl_BE', 'ro_RO', 'th_TH', 'fr_CH', 'lt_LT', 'nl_NL',
            'de_AT', 'en_IN', 'es_ES', 'es_PE', 'fr_FR', 'is_IS', 'lv_LV', 'de_CH', 'en_NG',
            'bg_BG', 'de_DE', 'en_NZ', 'es_VE', 'he_IL', 'it_CH', 'me_ME', 'sl_SI', 'bn_BD',
            'el_CY', 'en_PH', 'et_EE', 'hr_HR', 'it_IT', 'sr_Cyrl_RS', 'sr_Latn_RS',
        ];
    }
}
