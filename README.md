WarehouseBundle
===============
Symfony 4 bundle

Requirements
------------
* PHP 7
* Symfony 4

Automatic installation
----------------------
```
composer require bbasinski/warehouse-bundle
bin/console warehouse:init:config
bin/console warehouse:init:database
```


Manual installation
------
### Register bundle in config/bundles.php
```php
<?php

return [
    Bbasinski\WarehouseBundle\BbasinskiWarehouseBundle::class => ['all' => true]
];
```

### Register routes in config/routes.yaml
```
warehouse_bundle:
  resource: '@BbasinskiWarehouseBundle/Resources/config/routes.yaml'
```

### Configure DATABASE_URL in .env
```
DATABASE_URL=sqlite:///%kernel.project_dir%/var/warehouse.db
```

### Prepare database
```
bin/console doctrine:database:create
bin/console doctrine:schema:update --force
bin/console doctrine:fixtures:load
```

Running application
-----------
If you're going to host Symfony using PHP built-in web server then you need to run it twice
because of its single-threaded nature. Otherwise client would not be able to make calls to API.

```
php -S 127.0.0.1:8000 -t public   #client
php -S 127.0.0.1:8001 -t public   #api
```

If api address is different than client address configure API_URI in .env
```
API_URI=127.0.0.1:8001
```

