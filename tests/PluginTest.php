<?php

declare(strict_types = 1);

namespace AvtoDev\Composer\Cleanup\Tests;

use AvtoDev\Composer\Cleanup\Plugin;
use Composer\Installer\PackageEvents;

/**
 * @covers \AvtoDev\Composer\Cleanup\Plugin
 */
class PluginTest extends AbstractTestCase
{
    /**
     * @return void
     */
    public function testConstants(): void
    {
        $this->assertSame('avto-dev/composer-cleanup-plugin', Plugin::SELF_PACKAGE_NAME);
    }

    /**
     * @return void
     */
    public function testGetSubscribedEvents(): void
    {
        $subs = Plugin::getSubscribedEvents();

        $this->assertArrayHasKey(PackageEvents::POST_PACKAGE_INSTALL, $subs);
        $this->assertSame('cleanup', $subs[PackageEvents::POST_PACKAGE_INSTALL]);

        $this->assertArrayHasKey(PackageEvents::POST_PACKAGE_UPDATE, $subs);
        $this->assertSame('cleanup', $subs[PackageEvents::POST_PACKAGE_UPDATE]);
    }

    /**
     * @return void
     */
    public function testCleanupMethodExists(): void
    {
        $this->assertTrue(\method_exists(Plugin::class, 'cleanup'));
    }

    /**
     * @return void
     */
    public function testWIP(): void
    {
        $this->markTestIncomplete('TODO: Write better tests');
    }
}
