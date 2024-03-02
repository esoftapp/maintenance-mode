# Maintenance Mode for Codeigniter 4

Easily manage maintenance mode for your CodeIgniter 4 \
application with this CLI-powered module.\
View available commands for activating, deactivating, and \
customizing maintenance mode.

## Setup

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
