<?php

namespace test\eLife\Ping\Symfony\App;

use eLife\Ping\Symfony\PingBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Filesystem\Filesystem;
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
        return $this->getWriteableDir().'/cache';
    }

    public function getLogDir()
    {
        return $this->getWriteableDir().'/log';
    }

    public function __destruct()
    {
        (new Filesystem())->remove($this->getWriteableDir());
    }

    final protected function getWriteableDir()
    {
        return sys_get_temp_dir().'/elife-ping';
    }
}
