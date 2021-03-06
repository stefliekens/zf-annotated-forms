#Installation

## Add to composer.json
```
"phpro/zf-annotated-forms": "dev-master"
```

## Add to application config
```php
return array(
    'modules' => array(
        'Phpro\\AnnotatedForms',
        // other libs...
    ),
    // Other config
);
```

## Configuration files
Copy `module.zf-annotated-forms-global.dist.php` to your application configuration autoload directory.
You can adjust this file and set the default values. The `annotated_forms` can also be declared in your module config.


### Form configuration
```php
return array(
    'annotated_forms' => array(
        'form-key' => array(
            'initializers' => array(),
            'listeners' => array(),
            'cache' => null,
            'cache_key' => 'cached-form-key',
            'entity' => '',
        ),
    ),
);
```

`initializers`:
Array of service manager keys, which return InitializerInterfaces. These initializers are used to inject dependencies in form elements.

`listeners`:
Array of service manager keys, which return EventListenerAggregateInterface. These listeners can be used to adjust the form.

`cache`:
Service manager key, which return Cache\StorageInterface. This cache storage is used to save parsed annotations.
This can be left `null` if you do not want to be using cache.

`cache_key`:
The cache key where the parsed configuration is being saved in the cache locator.
This can be left `null` if you do not want to be using cache.

`entity`:
The name of the class which contains the form annotations.


### Load the form
You can now use the serviceManager to retrieve your form. In the config example above, you can use:

```php
$serviceManager->get('form-key');
```

### Configure cache
While configuring a cache storage, there are some things to keep in mind:

- Disable the exceptions by default
- Add a serializer
- The ttl of the forms can be infinite if you clear the cache after building your application

Sample configuration:

```php
'caches' => [
    'Cache\AnnotatedForms' => [
        'adapter' => [
            'name' => 'redis',
            'options' =>  [
                'namespace' => 'zf-annotated-forms',
                'server' => [
                    'host' => '127.0.0.1',
                    'port' => '6379',
                ],
                'ttl' => 86400 // 1 day
            ],
        ],
        'plugins' => [
            'exception_handler' => [
                'throw_exceptions' => false,
            ],
            'serializer',
        ],
    ],
],
```