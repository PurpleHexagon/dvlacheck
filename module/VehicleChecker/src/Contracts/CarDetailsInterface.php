<?php
declare(strict_types=1);

namespace VehicleChecker\Contracts;

use DateTimeImmutable;

interface CarDetailsInterface
{
    /**
     * @return string
     */
    public function getMake(): string;

    /**
     * @return string
     */
    public function getModel(): string;

    /**
     * @return string
     */
    public function getColour(): string;

    /**
     * @return DateTimeImmutable|null
     */
    public function getMotExpiryDate(): ?DateTimeImmutable;

    /**
     * @return int
     */
    public function getFailedMotCount(): int;
}
