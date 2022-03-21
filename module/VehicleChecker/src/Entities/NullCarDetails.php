<?php
declare(strict_types=1);

namespace VehicleChecker\Entities;

use DateTimeImmutable;
use VehicleChecker\Contracts\CarDetailsInterface;

class NullCarDetails implements CarDetailsInterface
{
    /**
     * @return string
     */
    public function getMake(): string
    {
        return '';
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return '';
    }

    /**
     * @return string
     */
    public function getColour(): string
    {
        return '';
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getMotExpiryDate(): ?DateTimeImmutable
    {
        return null;
    }

    /**
     * @return int
     */
    public function getFailedMotCount(): int
    {
        return 0;
    }
}
