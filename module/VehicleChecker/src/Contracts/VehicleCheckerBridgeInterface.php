<?php
declare(strict_types=1);

namespace VehicleChecker\Contracts;

use VehicleChecker\Entities\VehicleRegistration;

interface VehicleCheckerBridgeInterface
{
    /**
     * @param VehicleRegistration $vehicleRegistration
     * @return CarDetailsInterface
     */
    public function checkVehicleByRegistration(VehicleRegistration $vehicleRegistration): CarDetailsInterface;
}
