<?php

declare(strict_types=1);

namespace Dvla\Bridges;

use Dvla\Services\DvlaCarDetailHydrator;
use Dvla\Services\DvlaHttpClient;
use VehicleChecker\Entities\NullCarDetails;
use VehicleChecker\Entities\VehicleRegistration;
use VehicleChecker\Contracts\CarDetailsInterface;
use VehicleChecker\Contracts\VehicleCheckerBridgeInterface;

class DvlaVehicleCheckBridge implements VehicleCheckerBridgeInterface
{
    /**
     * @param DvlaHttpClient $dvlaHttpClient
     */
    public function __construct(private DvlaHttpClient $dvlaHttpClient)
    {
    }

    /**
     * @param VehicleRegistration $vehicleRegistration
     * @return CarDetailsInterface
     */
    public function checkVehicleByRegistration(VehicleRegistration $vehicleRegistration): CarDetailsInterface
    {
        $responseBody = $this->dvlaHttpClient->getMotByRegistration($vehicleRegistration);

        if (empty($responseBody) === true) {
            return new NullCarDetails();
        }

        $hydrator = new DvlaCarDetailHydrator();

        return $hydrator->hydrate($responseBody);
    }
}
