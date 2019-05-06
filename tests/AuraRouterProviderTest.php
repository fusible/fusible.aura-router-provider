<?php
// @codingStandardsIgnoreFile

namespace Fusible\AuraRouterProvider;

use Aura\Di\ContainerBuilder;
use PHPUnit\Framework\TestCase;
use Interop\Container\ServiceProviderInterface;

class AuraRouterProviderTest extends TestCase
{
    protected $provides = [];

    protected $container;

    protected $provider;

    protected function setUp() : void
    {
        $builder = new ContainerBuilder();
        $this->container = $builder->newInstance();
        $this->provider = new AuraRouterProvider();
    }

    protected function provide()
    {
        foreach ($this->provider->getFactories() as $name => $callable) {
            $factory = $this->container->lazy($callable, $this->container);
            $this->container->set($name, $factory);
            $this->provides[] = $name;
        }

        foreach ($this->provider->getExtensions() as $name => $modify) {
            if ($this->container->has($name)) {
                $modify($this->container, $this->container->get($name));
            }
        }
    }

    protected function assertInstances()
    {
        foreach ($this->provides as $name) {
            $this->assertInstanceOf($name, $this->container->get($name));
        }
    }

    public function testIsProvider()
    {
        $this->assertInstanceOf(
            ServiceProviderInterface::class,
            $this->provider
        );
    }

    public function testProvides()
    {
        $this->provide();
        $this->assertInstances();
    }
}

