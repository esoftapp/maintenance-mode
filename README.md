# Maintenance Mode for Codeigniter 4

Maintenance mode module for CodeIgniter 4 with CLI

## Installing

```shell
composer require esoftdream/maintenancemode
```
## Configuration
Run the following command from the command prompt, and it will copy views (error_503.php)  into your application
```shell
php spark mm:publish
```

## How to use (?)

edit *app/Config/Events.php* and\
add this code for maintenance mode check:

```php
\Esoftdream\MaintenanceMode\Maintenance::check();
```
## Additional

edit *app/Config/Exception.php*\
find **public array $ignoreCodes = [404];**\
then add **503** for ignore the ignore the log.
