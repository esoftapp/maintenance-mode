<?php

namespace Esoftdream\MaintenanceMode\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\Publisher\Publisher;
use Throwable;

class Publish extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'Maintenance';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'mm:publish';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Publish 503 Error code view into the current application folder.';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'mm:publish';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments = [];

    /**
     * The Command's Options
     *
     * @var array
     */
    protected $options = [];

    /**
     * Actually execute a command.
     */
    public function run(array $params)
    {
        $config = new Publisher(VENDORPATH . 'esoftdream/maintenance-mode/src/Config', APPPATH . 'Config');
        $view   = new Publisher(VENDORPATH . 'esoftdream/maintenance-mode/src/Views', APPPATH . 'Views/errors/html');

        // $source    = service('autoloader')->getNamespace('CodeIgniter\\Shield')[0];
        // $publisher = new Publisher($source, APPPATH);

        try {
            $config->addPaths([
                'Maintenance.php',
            ]);
            $config->copy();
            $view->addPath('errors/html');
            $view->copy();
        } catch (Throwable $e) {
            $this->showError($e);

            return;
        }

        // If publication succeeded then update namespaces
        foreach ($config->getPublished() as $file) {
            // Replace the namespace
            $contents = file_get_contents($file);
            $contents = str_replace('namespace Esoftdream\\MaintenanceMode', 'namespace ' . APP_NAMESPACE, $contents);
            file_put_contents($file, $contents);
        }
    }
}
