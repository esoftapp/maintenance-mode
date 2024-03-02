<?php

namespace Esoftdream\MaintenanceMode\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class Down extends BaseCommand
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
    protected $name = 'mm:down';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Put the application into maintenance mode.';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'mm:down';

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

        // check maintenance file
        if (! is_file($config->filePath . $config->fileName)) {
            helper('text');

            $message = CLI::prompt('Message');
            $ips_str = CLI::prompt("Allowed IP's. example: 0.0.0.0 127.0.0.1");

            $ips_array = explode(' ', $ips_str);

            //
            // write the file with json content
            //
            file_put_contents(
                $config->filePath . $config->fileName,
                json_encode([
                    'time'        => strtotime('now'),
                    'message'     => $message,
                    'cookie_name' => random_string('alnum', 8),
                    'allowed_ips' => $ips_array,
                ], JSON_PRETTY_PRINT)
            );

            CLI::newLine(1);
            CLI::write(':: Application is now DOWN ::', 'white', 'red');
            CLI::newLine(1);

            $this->call('mm:status');
        } else {
            CLI::newLine(1);
            CLI::write(':: Application is already DOWN ::', 'white', 'red');
            CLI::newLine(1);
        }
    }
}
