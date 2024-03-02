<?php

namespace Esoftdream\MaintenanceMode\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class Up extends BaseCommand
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
    protected $name = 'mm:up';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Take the application out of maintenance mode.';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'mm:up';

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
        $config = config('Maintenance');

        @unlink($config->filePath . $config->fileName);

        CLI::write('');
        CLI::write(':: Application is now live ::', 'black', 'green');
        CLI::write('');
    }
}
