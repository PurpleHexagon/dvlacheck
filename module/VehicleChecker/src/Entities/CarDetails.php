<?php
declare(strict_types=1);

namespace VehicleChecker\Entities;

use DateTimeImmutable;
use VehicleChecker\Contracts\CarDetailsInterface;

class CarDetails implements CarDetailsInterface
{
    /**
     * @param string $make
     * @param string $model
     * @param string $colour
     * @param DateTimeImmutable|null $motExpiryDate
     * @param int $failedMotCount
     */
    public function __construct(
        private string $make,
        private string $model,
        private string $colour,
        private ?DateTimeImmutable $motExpiryDate,
        private int $failedMotCount
    ) {
    }

    /**
     * @return string
     */
    public function getMake(): string
    {
        return $this->make;
    }

    /**
     * @return string
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * @return string
     */
    public function getColour(): string
    {
        return $this->colour;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getMotExpiryDate(): ?DateTimeImmutable
    {
        return $this->motExpiryDate;
    }

    /**
     * @return int
     */
    public function getFailedMotCount(): int
    {
        return $this->failedMotCount;
    }
}
