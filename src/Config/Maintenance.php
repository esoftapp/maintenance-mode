<?php

namespace Esoftdream\MaintenanceMode\Config;

use CodeIgniter\Config\BaseConfig;

class Maintenance extends BaseConfig
{
    /**
     * @var string Maintenance Mode file name
     */
    public string $fileName = 'maintenance';

    /**
     * @var string File Path to store maintenance file name
     */
    public string $filePath = WRITEPATH;
}
