<?php
declare(strict_types=1);

namespace Api;

use Api\Controllers\VehicleApiController;
use Api\Factories\VehicleApiControllerFactory;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => VehicleApiController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'vehicle_api' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/api/vehicle/[:registration]',
                    'defaults' => [
                        'controller' => VehicleApiController::class,
                        'action'     => 'show',
                    ],
                ],
            ]
        ],
    ],
    'controllers' => [
        'factories' => [
            VehicleApiController::class => VehicleApiControllerFactory::class
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'error/404'     => __DIR__ . '/../view/error/404.phtml',
            'error/index'   => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            'application' => __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
];
