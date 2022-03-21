<?php
declare(strict_types=1);

namespace Dvla\Services;

use Dvla\Exceptions\DvlaHttpClientRuntimeException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Laminas\Json\Json;
use VehicleChecker\Entities\VehicleRegistration;

class DvlaHttpClient
{
    private const HTTP_OKAY = 200;
    private const HTTP_NOT_FOUND = 404;

    /**
     * @param Client $httpClient
     * @param string $baseUrl
     * @param string $apiKey
     */
    public function __construct(
        protected Client $httpClient,
        protected string $baseUrl,
        protected string $apiKey,
    ) {
    }

    /**
     * @param VehicleRegistration $registration
     * @return array
     */
    public function getMotByRegistration(VehicleRegistration $registration): array
    {
        try {
            $url = $this->baseUrl . $registration;
            $response = $this->httpClient->get(
                $url,
                [
                    'headers' => [
                        'x-api-key' => $this->apiKey,
                        'Content-Type' => 'application/json',
                    ]
                ]
            );

            if ($response->getStatusCode() !== self::HTTP_OKAY) {
                return [];
            }

            $responseBody = $response->getBody()->getContents();

            return current(Json::decode($responseBody, Json::TYPE_ARRAY));
        } catch (GuzzleException $exception) {
            if ($exception->getCode() === self::HTTP_NOT_FOUND) {
                return [];
            }

            throw new DvlaHttpClientRuntimeException(
                message: 'HTTP Client could not connect to API',
                previous: $exception
            );
        }
    }
}
