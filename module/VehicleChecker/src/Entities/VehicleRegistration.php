<?php
declare(strict_types=1);

namespace VehicleChecker\Entities;

use Laminas\I18n\Filter\Alnum;
use Stringable;

class VehicleRegistration implements Stringable
{
    /**
     * @var string
     */
    private string $registrationNumber;

    /**
     * @param string $registrationNumber
     */
    public function __construct(string $registrationNumber)
    {
        $alnumFilter = new Alnum(false);

        $filteredRegistrationNumber = $alnumFilter->filter($registrationNumber);

        if (is_string($filteredRegistrationNumber) !== true) {
            throw new \RuntimeException('$filteredRegistrationNumber is expected to be a string');
        }

        $this->registrationNumber = $filteredRegistrationNumber;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->registrationNumber;
    }
}
