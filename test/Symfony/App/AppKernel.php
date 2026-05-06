<?php

namespace test\eLife\Ping\Symfony\App;

use eLife\Ping\Symfony\PingBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\Kernel;

final class AppKernel extends Kernel
{
    private string $instanceId;


    public function __construct(string $environment, bool $debug)
    {
        parent::__construct($environment, $debug);
        $this->instanceId = uniqid('', true);
    }

    public function registerBundles(): iterable
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
    public function getRootDir(): string
    {
        return $this->getProjectDir();
    }

    public function getProjectDir(): string
    {
        return __DIR__;
    }

    public function getCacheDir(): string
    {
        return $this->getWriteableDir().'/cache';
    }

    public function getLogDir(): string
    {
        return $this->getWriteableDir().'/log';
    }

    public function __destruct()
    {
        (new Filesystem())->remove($this->getWriteableDir());
    }

    protected function getWriteableDir(): string
    {
        return sys_get_temp_dir().'/elife-ping-'.$this->instanceId;
    }
}
