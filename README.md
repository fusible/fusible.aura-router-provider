# fusible.aura-router-provider
[Service Provider] for [Aura\Router]


## Installation
```
composer require fusible/aura-router-provider
```

## Usage

See: [Service Provider] and [Fusible\AuraProvider].
```php
$provider = new Fusible\AuraRouterProvider\AuraRouterProvider();
foreach ($provider->getFactories() as $name => $factory) {
    $container->set($name, $factory);
}
```



[Service Provider]: https://github.com/container-interop/service-provider
[Fusible\AuraProvider]: https://github.com/fusible/aura-provider
[Aura\Router]: https://github.com/auraphp/Aura.Router

