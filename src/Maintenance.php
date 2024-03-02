<?php

namespace Esoftdream\MaintenanceMode;

use Config\Services;
use Esoftdream\MaintenanceMode\Exceptions\MaintenanceException;
use Esoftdream\MaintenanceMode\Libraries\IpUtils;

class Maintenance
{
    public static function check()
    {
        //
        // if request is from CLI
        //
        if (is_cli()) {
            return true;
        }

        $config = config('Maintenance');

        $downFilePath = $config->filePath . $config->fileName;

        //
        // if donw file does not exist app should keep running
        //
        if (! file_exists($downFilePath)) {
            return true;
        }

        //
        // get all json data from donw file
        //
        $data = json_decode(file_get_contents($downFilePath), true);

        //
        // if request ip was entered in allowed_ips
        // the app should continue running
        //
        $lib = new IpUtils();
        if ($lib->checkIp(Services::request()->getIPAddress(), $data['allowed_ips'])) {
            return true;
        }

        //
        // if user's browser has been used the cookie pass
        // the app should continue running
        //
        helper('cookie');
        $cookieName = get_cookie($data['cookie_name']);

        if ($cookieName === $data['cookie_name']) {
            return true;
        }

        throw new MaintenanceException($data['message']);
    }
}
