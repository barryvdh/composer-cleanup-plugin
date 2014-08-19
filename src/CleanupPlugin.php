<?php

namespace Barryvdh\Composer;

use Composer\Composer;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Script\ScriptEvents;
use Composer\Script\PackageEvent;

class CleanupPlugin implements PluginInterface, EventSubscriberInterface
{
    protected $composer;
    protected $io;
    
    public function activate(Composer $composer, IOInterface $io)
    {
        $this->composer = $composer;
        $this->io = $io;
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
        // TODO
    }
    
    public function onPostPackageUpdate(PackageEvent $event)
    {
        // TODO
    }
    
}