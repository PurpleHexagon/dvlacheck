<?php
declare(strict_types=1);

namespace Dvla\Services;

use VehicleChecker\Entities\CarDetails;

class DvlaCarDetailHydrator
{
    /**
     * @param array $data
     * @return CarDetails
     */
    public function hydrate(array $data): CarDetails
    {
        $calculateFailedMots = new CalculateFailedMots();
        $motTestData = $data['motTests'] ?? [];

        $motCount = $calculateFailedMots($motTestData);
        $currentMot = current($motTestData);
        $expiryDate = null;

        if ($currentMot) {
            $expiryDate = \DateTimeImmutable::createFromFormat('!Y.m.d', $currentMot['expiryDate']);
        }

        if ($expiryDate === false) {
            throw new \RuntimeException();
        }

        return new CarDetails(
            $data['make'],
            $data['model'],
            $data['primaryColour'],
            $expiryDate,
            $motCount
        );
    }
}
