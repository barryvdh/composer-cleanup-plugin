<?php

namespace Barryvdh\Composer;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Script\ScriptEvents;
use Composer\Script\PackageEvent;
use Composer\Util\Filesystem;
use Composer\Package\Package;
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

    public function activate(Composer $composer, IOInterface $io)
    {
        $this->composer = $composer;
        $this->io = $io;
        $this->config = $composer->getConfig();
        $this->filesystem = new Filesystem();
    }
    
    public static function getSubscribedEvents()
    {
        return array(
            ScriptEvents::POST_PACKAGE_INSTALL  => array(
                array('onPostPackageInstall', 0)
            ),
            ScriptEvents::POST_PACKAGE_UPDATE  => array(
                array('onPostPackageUpdate', 0)
            ),
        );
    }
    
    public function onPostPackageInstall(PackageEvent $event)
    {
        /** @var \Composer\Package\CompletePackage $package */
        $package = $event->getOperation()->getPackage();

        $this->cleanPackage($package);
    }
    
    public function onPostPackageUpdate(PackageEvent $event)
    {
        /** @var \Composer\Package\CompletePackage $package */
        $package = $event->getOperation()->getTargetPackage();

        $this->cleanPackage($package);
    }

    protected function cleanPackage(Package $package)
    {
        $vendorDir = $this->config->get('vendor-dir');
        $packageDir = $package->getName();

        //TODO; get rules from config file or $package->getExtra()
        $docs = 'README* CHANGELOG* FAQ* CONTRIBUTING* HISTORY* UPGRADING* UPGRADE* package* examples doc docs';
        $tests = '.travis.yml phpunit.xml* test tests Tests';
        $rule = "{$docs} {$tests}";

        if (!file_exists($vendorDir . '/' . $packageDir)) {
            return;
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
    }
}
