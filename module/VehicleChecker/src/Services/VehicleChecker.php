<?php
declare(strict_types=1);

namespace VehicleChecker\Services;

use Psr\SimpleCache\CacheInterface;
use VehicleChecker\Contracts\CarDetailsInterface;
use VehicleChecker\Contracts\VehicleCheckerBridgeInterface;
use VehicleChecker\Contracts\VehicleCheckerInterface;
use VehicleChecker\Entities\VehicleRegistration;

class VehicleChecker implements VehicleCheckerInterface
{
    /**
     * Cache TTL of 1 hour
     */
    protected const CACHE_TTL = 3600;

    /**
     * @param VehicleCheckerBridgeInterface $bridge
     * @param CacheInterface $cache
     */
    public function __construct(
        protected VehicleCheckerBridgeInterface $bridge,
        protected CacheInterface $cache
    ) {
    }

    /**
     * Filters registration number to ensure is valid for API
     * and delegates to bridge for implementation of vehicle check
     * so is open for extension but closed for modification
     *
     * @param string $vehicleRegistration
     * @return CarDetailsInterface
     */
    public function vehicleDetails(string $vehicleRegistration): CarDetailsInterface
    {
        $vehicleRegistrationEntity = new VehicleRegistration($vehicleRegistration);

        if ($this->cache->has((string) $vehicleRegistrationEntity)) {
            return $this->cache->get((string) $vehicleRegistrationEntity);
        }

        $carDetails = $this->bridge->checkVehicleByRegistration($vehicleRegistrationEntity);

        $this->cache->set((string) $vehicleRegistrationEntity, $carDetails, self::CACHE_TTL);

        return $carDetails;
    }
}
