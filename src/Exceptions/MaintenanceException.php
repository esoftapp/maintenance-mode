<?php

namespace Esoftdream\MaintenanceMode\Exceptions;

use CodeIgniter\Exceptions\FrameworkException;
use CodeIgniter\Exceptions\HTTPExceptionInterface;

class MaintenanceException extends FrameworkException implements HTTPExceptionInterface
{
    protected $code = 503;
}
