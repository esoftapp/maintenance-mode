<?php

namespace Esoftdream\MaintenanceMode\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class Status extends BaseCommand
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
    protected $name = 'mm:status';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Display the maintenance mode status.';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'mm:status';

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

        $maintenanceFile = $config->filePath . $config->fileName;

        if (is_file($maintenanceFile)) {
            $data = json_decode(file_get_contents($maintenanceFile), true);

            CLI::newLine(1);
            CLI::write(':: Application is already DOWN ::', 'white', 'red');
            CLI::newLine(1);

            //
            // echo keys and values in table
            // without allowed_ips
            //
            $thead = [
                'key',
                'value',
            ];

            $tbody = [];

            foreach ($data as $key => $value) {
                switch ($key) {
                    case 'allowed_ips':
                        break;

                    case 'time':
                        $tbody[] = [$key, date('Y-m-d H:i:s', $value)];
                        break;

                    default:
                        $tbody[] = [$key, $value];
                }
            }

            CLI::table($tbody, $thead);

            //
            // echo allowed_ips in table
            //
            $thead = ['allowed ips'];

            $tbody = [];

            foreach ($data['allowed_ips'] as $ip) {
                $tbody[] = [$ip];
            }

            CLI::table($tbody, $thead);

            CLI::newLine(1);
        } else {
            CLI::newLine(1);
            CLI::write(':: Application is already live ::', 'black', 'green');
            CLI::newLine(1);
        }
    }
}
