<?php
declare(strict_types=1);

namespace Dvla\Factories;

use Dvla\Services\DvlaHttpClient;
use GuzzleHttp\Client;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class DvlaHttpClientFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return DvlaHttpClient
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $config = $container->get('config');

        return new DvlaHttpClient(
            $container->get(Client::class),
            $config['dvlaBaseUrl'],
            $config['dvlaApiKey']
        );
    }
}
