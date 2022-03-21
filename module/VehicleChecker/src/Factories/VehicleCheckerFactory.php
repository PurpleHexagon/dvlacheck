<?php
declare(strict_types=1);

namespace VehicleChecker\Factories;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\SimpleCache\CacheInterface;
use VehicleChecker\Contracts\VehicleCheckerBridgeInterface;
use VehicleChecker\Services\VehicleChecker;

class VehicleCheckerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return VehicleChecker
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $bridge = $container->get(VehicleCheckerBridgeInterface::class);
        $cache = $container->get(CacheInterface::class);
        return new VehicleChecker($bridge, $cache);
    }
}
