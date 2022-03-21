<?php
declare(strict_types=1);

namespace VehicleChecker\Factories;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Psr16Cache;

class CacheFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return Psr16Cache
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        // TODO: Use a production ready cache adapter (Redis), this one is fine for testing purposes
        $adapter = new FilesystemAdapter(directory: getcwd() . '/data');
        return new Psr16Cache($adapter);
    }
}
