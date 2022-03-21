<?php
declare(strict_types=1);

namespace VehicleChecker\Services;

use Psr\SimpleCache\CacheInterface;
use VehicleChecker\Contracts\VehicleCheckerInterface;
use VehicleChecker\Factories\CacheFactory;
use VehicleChecker\Factories\VehicleCheckerFactory;

return [
    'service_manager' => [
        'abstract_factories' => [],
        'factories' => [
            VehicleCheckerInterface::class => VehicleCheckerFactory::class,
            CacheInterface::class => CacheFactory::class,
        ],
    ],
];
