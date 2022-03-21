<?php
declare(strict_types=1);

namespace VehicleCheckerTest\Entities;

use PHPUnit\Framework\TestCase;
use VehicleChecker\Entities\CarDetails;

class CarDetailsTest extends TestCase
{
    /**
     * @var CarDetails
     */
    private CarDetails $car;

    protected function setUp(): void
    {
        parent::setUp();
        $this->car = new CarDetails(
            'Ford',
            'Fiesta',
            'Black',
            null,
            0,
        );
    }

    public function testCanGetMake(): void
    {
        $this->assertEquals('Ford', $this->car->getMake());
    }

    public function testCanGetModel(): void
    {
        $this->assertEquals('Fiesta', $this->car->getModel());
    }

    public function testCanGetColour(): void
    {
        $this->assertEquals('Black', $this->car->getColour());
    }

    public function testCanGetFailedMotCount(): void
    {
        $this->assertEquals(0, $this->car->getFailedMotCount());
    }
}
