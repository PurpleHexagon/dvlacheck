<?php
declare(strict_types=1);

namespace Api\Factories;

use Api\Controllers\VehicleApiController;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use VehicleChecker\Contracts\VehicleCheckerInterface;

class VehicleApiControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return VehicleApiController
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new VehicleApiController(
            $container->get(VehicleCheckerInterface::class)
        );
    }
}
