<?php
declare(strict_types=1);

namespace Dvla;

use Dvla\Bridges\DvlaVehicleCheckBridge;
use Dvla\Factories\DvlaHttpClientFactory;
use Dvla\Factories\DvlaVehicleCheckBridgeFactory;
use Dvla\Services\DvlaHttpClient;
use GuzzleHttp\Client;
use Laminas\ServiceManager\Factory\InvokableFactory;
use VehicleChecker\Contracts\VehicleCheckerBridgeInterface;

return [
    'vehicleCheckerBridge' => DvlaVehicleCheckBridge::class,
    'service_manager' => [
        'factories' => [
            Client::class => InvokableFactory::class,
            DvlaHttpClient::class => DvlaHttpClientFactory::class,
            VehicleCheckerBridgeInterface::class => DvlaVehicleCheckBridgeFactory::class
        ],
    ]
];
