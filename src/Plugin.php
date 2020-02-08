<?php

declare(strict_types = 1);

namespace AvtoDev\Composer\Cleanup;

use Composer\Composer;
use Composer\Script\Event;
use Composer\IO\IOInterface;
use Composer\Util\Filesystem;
use Composer\Plugin\PluginInterface;
use Composer\Installer\PackageEvents;
use Composer\EventDispatcher\EventSubscriberInterface;

final class Plugin implements PluginInterface, EventSubscriberInterface
{
    public const SELF_PACKAGE_NAME = 'avto-dev/composer-cleanup-plugin';

    /**
     * {@inheritdoc}
     */
    public function activate(Composer $composer, IOInterface $io): void
    {
        // Nothing to do here, as all features are provided through event listeners
    }

    /**
     * @return array<string, string>
     */
    public static function getSubscribedEvents(): array
    {
        return [
            PackageEvents::POST_PACKAGE_INSTALL => 'cleanup',
            PackageEvents::POST_PACKAGE_UPDATE  => 'cleanup',
        ];
    }

    /**
     * Cleanup executing.
     *
     * @param Event $composer_event
     *
     * @return void
     */
    public static function cleanup(Event $composer_event): void
    {
        $io       = $composer_event->getIO();
        $fs       = new Filesystem;
        $composer = $composer_event->getComposer();
        $rules    = Rules::getRules();

        $installation_manager = $composer->getInstallationManager();
        $packages             = $composer->getRepositoryManager()->getLocalRepository()->getPackages();

        $saved_size_bytes = 0;
        $start_time       = \microtime(true);

        $io->write(\sprintf('<info>%s:</info> Cleanup started...', self::SELF_PACKAGE_NAME));

        // Loop over all installed packages
        foreach ($packages as $package) {
            $package_name = $package->getName();

            // Try to extract defined targets for a package
            if (isset($rules[$package_name])) {
                $install_path = $installation_manager->getInstallPath($package);

                // Loop over defined targets for the package
                foreach (\explode(' ', \trim((string) \preg_replace('~\s+~', ' ', $rules[$package_name]))) as $target) {
                    // Skip targets which contains `..`
                    if (\mb_strpos($target, '..') !== false) {
                        continue;
                    }

                    // Iterate every found target
                    $paths = \glob($install_path . DIRECTORY_SEPARATOR . \ltrim($target, '\\/'), \GLOB_ERR);

                    if (\is_array($paths)) {
                        foreach ($paths as $path) {
                            try {
                                $path_size = $fs->size($path);

                                if ($fs->remove($path)) {
                                    $saved_size_bytes += $path_size;
                                }
                            } catch (\Throwable $e) {
                                $io->write(\sprintf(
                                    '<info>%s:</info> Error occurred: <error>%s</error>',
                                    self::SELF_PACKAGE_NAME,
                                    $e->getMessage()
                                ));
                            }
                        }
                    }
                }
            }
        }

        $io->write(\sprintf(
            '<info>%s:</info> ...done in %01.3f seconds (<comment>%d Kb</comment> saved)',
            self::SELF_PACKAGE_NAME,
            \microtime(true) - $start_time,
            $saved_size_bytes / 1024
        ));
    }
}
