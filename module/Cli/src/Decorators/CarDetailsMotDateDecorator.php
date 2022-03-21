<?php
declare(strict_types=1);

namespace Cli\Decorators;

use DateTimeInterface;
use VehicleChecker\Contracts\CarDetailsInterface;

class CarDetailsMotDateDecorator
{
    protected const MOT_DATE_OUTPUT_FORMAT = 'd/m/Y';
    protected const NO_MOT_EXPIRY = 'No MOT Expiry';

    /**
     * @param CarDetailsInterface $carDetails
     */
    public function __construct(private CarDetailsInterface $carDetails)
    {
    }

    /**
     * Extends functionality of CarDetail adding
     * ability to format date or return an appropriate message
     * if no date.
     *
     * @return string
     */
    public function getMotExpiryDetails(): string
    {
        $maybeMotDate = $this->carDetails->getMotExpiryDate();

        if ($maybeMotDate instanceof DateTimeInterface) {
            return $maybeMotDate->format(self::MOT_DATE_OUTPUT_FORMAT);
        }

        return self::NO_MOT_EXPIRY;
    }
}
