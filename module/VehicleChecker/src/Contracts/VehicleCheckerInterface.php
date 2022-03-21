<?php
declare(strict_types=1);

namespace VehicleChecker\Contracts;

interface VehicleCheckerInterface
{
    /**
     * @param string $vehicleRegistration
     * @return CarDetailsInterface
     */
    public function vehicleDetails(string $vehicleRegistration): CarDetailsInterface;
}
