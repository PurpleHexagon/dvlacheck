<?php
declare(strict_types=1);

namespace Cli\Factories;

use Cli\Commands\VehicleCheckCommand;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use VehicleChecker\Contracts\VehicleCheckerInterface;

class VehicleCheckCommandFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return VehicleCheckCommand
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new VehicleCheckCommand(
            $container->get(VehicleCheckerInterface::class)
        );
    }
}
