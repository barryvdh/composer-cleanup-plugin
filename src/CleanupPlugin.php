<?php

namespace Barryvdh\Composer;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Script\ScriptEvents;
use Composer\Script\CommandEvent;
use Composer\Util\Filesystem;
use Composer\Package\BasePackage;
use Symfony\Component\Finder\Finder;

class CleanupPlugin implements PluginInterface, EventSubscriberInterface
{
    /** @var  \Composer\Composer $composer */
    protected $composer;
    /** @var  \Composer\IO\IOInterface $io */
    protected $io;
    /** @var  \Composer\Config $config */
    protected $config;
    /** @var  \Composer\Util\Filesystem $filesystem */
    protected $filesystem;
    /** @var  array $rules */
    protected $rules;

    /**
     * {@inheritDoc}
     */
    public function activate(Composer $composer, IOInterface $io)
    {
        $this->composer = $composer;
        $this->io = $io;
        $this->config = $composer->getConfig();
        $this->filesystem = new Filesystem();
        $this->rules = CleanupRules::getRules();
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            ScriptEvents::POST_INSTALL_CMD  => array(
                array('onPostInstallUpdateCmd', 0)
            ),
            ScriptEvents::POST_UPDATE_CMD  => array(
                array('onPostInstallUpdateCmd', 0)
            ),

        );
    }

    /**
     * Function to run after a package has been updated
     *
     * @param CommandEvent $event
     */
    public function onPostInstallUpdateCmd(CommandEvent $event)
    {
        /** @var \Composer\Repository\WritableRepositoryInterface $repository */
        $repository = $this->composer->getRepositoryManager()->getLocalRepository();

        /** @var \Composer\Package\CompletePackage $package */
        foreach($repository->getPackages() as $package){
            if ($package instanceof BasePackage) {
                $this->cleanPackage($package);
            }
        }
    }

    /**
     * Clean a package, based on its rules.
     *
     * @param BasePackage  $package  The package to clean
     * @return bool True if cleaned
     */
    protected function cleanPackage(BasePackage $package)
    {
        $vendorDir = $this->config->get('vendor-dir');
        $targetDir = $package->getTargetDir();
        $packageName = $package->getName();
        $packageDir = $targetDir ? $packageName . '/' . $targetDir : $packageName ;

        $rule = isset($this->rules[$packageName]) ? $this->rules[$packageName] : null;

        if (!$rule || !file_exists($vendorDir . '/' . $packageDir)) {
            return false;
        }

        foreach (explode(' ', $rule) as $pattern) {
            try {
                $finder = Finder::create()->name($pattern)->in( $vendorDir . '/' . $packageDir);

                /** @var \SplFileInfo $file */
                foreach (iterator_to_array($finder) as $file) {
                    $this->filesystem->remove($file);
                }

            } catch (\Exception $e) {
                $this->io->write("Could not parse $packageDir ($pattern): ".$e->getMessage());
            }
        }

        return true;
    }
}
