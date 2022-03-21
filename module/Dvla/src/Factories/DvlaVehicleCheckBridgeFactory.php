<?php
declare(strict_types=1);

namespace Dvla\Factories;

use Dvla\Bridges\DvlaVehicleCheckBridge;
use Dvla\Services\DvlaHttpClient;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class DvlaVehicleCheckBridgeFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return DvlaVehicleCheckBridge
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new DvlaVehicleCheckBridge($container->get(DvlaHttpClient::class));
    }
}
