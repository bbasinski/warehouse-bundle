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
