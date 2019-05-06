<?php

namespace Fusible\AuraRouterProvider;

use Aura\Router\Generator;
use Aura\Router\Helper\Route as RouteHelper;
use Aura\Router\Helper\RouteRaw as RouteRawHelper;
use Aura\Router\Map;
use Aura\Router\Matcher;
use Aura\Router\RouterContainer as Router;
use Aura\Router\Rule\RuleIterator;
use Interop\Container\ServiceProviderInterface;
use Psr\Container\ContainerInterface as Container;


class AuraRouterProvider implements ServiceProviderInterface
{
    protected $router;

    public function __construct(Router $router = null)
    {
        $this->router = $router ?: new Router();
    }

    public function getFactories()
    {
        return [
            Router::class         => [$this, 'getRouter'],
            Generator::class      => [$this, 'getGenerator'],
            Map::class            => [$this, 'getMap'],
            Matcher::class        => [$this, 'getMatcher'],
            RuleIterator::class   => [$this, 'getRuleIterator'],
            RouteHelper::class    => [$this, 'newRouteHelper'],
            RouteRawHelper::class => [$this, 'newRouteRawHelper'],
        ];
    }

    public function getExtensions()
    {
        return [];
    }

    public function getRouter()
    {
        return $this->router;
    }

    public function getGenerator(Container $container) : Generator
    {
        return $container->get(Router::class)
            ->getGenerator();
    }

    public function getMap(Container $container) : Map
    {
        return $container->get(Router::class)
            ->getMap();
    }

    public function getMatcher(Container $container) : Matcher
    {
        return $container->get(Router::class)
            ->getMatcher();
    }

    public function getRuleIterator(Container $container) : RuleIterator
    {
        return $container->get(Router::class)
            ->getRuleIterator();
    }

    public function newRouteHelper(Container $container) : RouteHelper
    {
        return $container->get(Router::class)
            ->newRouteHelper();
    }

    public function newRouteRawHelper(Container $container) : RouteRawHelper
    {
        return $container->get(Router::class)
            ->newRouteRawHelper();
    }
}
