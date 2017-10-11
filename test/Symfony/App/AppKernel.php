<?php

namespace test\eLife\Ping\Symfony\App;

use eLife\Ping\Symfony\PingBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel;

final class AppKernel extends Kernel
{
    public function registerBundles()
    {
        return [
            new FrameworkBundle(),
            new PingBundle(),
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config.php');
    }

    /**
     * @deprecated
     */
    public function getRootDir()
    {
        return $this->getProjectDir();
    }

    public function getProjectDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return sys_get_temp_dir().'/elife-ping/cache';
    }

    public function getLogDir()
    {
        return sys_get_temp_dir().'/elife-ping/log';
    }
}
