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

Open *app/Config/Events.php* and insert the provided code to\
implement a maintenance mode check.

```php
\Esoftdream\MaintenanceMode\Maintenance::check();
```
## Additional

Open the file _app/Config/Exception.php_ in your code editor.\
Locate the line containing `public array $ignoreCodes = [404];`.\
Add, **503** within the square brackets to ignore 503 status codes for logging.\
Save your changes.
