<?php
declare(strict_types=1);

namespace Cli;

use Cli\Commands\VehicleCheckCommand;
use Cli\Factories\VehicleCheckCommandFactory;

return [
    'service_manager' => [
        'factories' => [
            VehicleCheckCommand::class => VehicleCheckCommandFactory::class
        ],
    ],
    'laminas-cli' => [
        'commands' => [
            'vehicle:check' => VehicleCheckCommand::class,
        ],
    ],
];
