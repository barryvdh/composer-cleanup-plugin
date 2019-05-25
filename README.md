Composer Cleanup Plugin
=======================

Remove tests & documentation from the vendor dir. Based on [laravel-vendor-cleanup](https://github.com/barryvdh/laravel-vendor-cleanup) but implemented as a Composer Plugin instead of a Laravel command.

Usually disk size shouldn't be a problem, but when you have to use FTP to deploy or have very limited disk space,
you can use this package to cut down the vendor directory by deleting files that aren't used in production (tests/docs etc).

> **Note:** This package is still experimental, usage in production is not recommended.
> In normal circumstances, you shouldn't care about disk space! Try deploying with SSH/Git instead.

## Install

Require this package in your composer.json:

      "barryvdh/composer-cleanup-plugin": "0.2.x"
      
## Usage

This plugin will work automatically on any packages installed as `dist`. Therefore, if you are using it to build a package archive, simply run `composer install` with the `--prefer-dist` option.

## What does it do?

For every installed or updated package in the default list, in general:

1. Remove documentation, such as README files, docs folders, etc.
2. Remove tests, PHPUnit configs, and other build/CI configuration.

Some packages don't obey the general rules, and remove more/less files. Packages that do not have
rules added are ignored.

## Adding rules

Please submit a PR to [src/CleanupRules.php] to add more rules for packages.
Make sure you test them first, sometimes tests dirs are classmapped and will error when deleted.

[src/CleanupRules.php]:                               ./src/CleanupRules.php
