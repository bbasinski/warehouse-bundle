WarehouseBundle
===============
Symfony 4 bundle

Installation
------------
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

### Configure database in .env
```
DATABASE_URL="sqlite:///%kernel.project_dir%/var/warehouse.db"
```

### Configure DATABASE_URL in .env
```
DATABASE_URL="sqlite:///%kernel.project_dir%/var/warehouse.db"
```
### Configure database driver in config/packages/doctrine.yaml
```
todo
```

### Prepare database
```
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
php bin/console doctrine:fixtures:load
```
