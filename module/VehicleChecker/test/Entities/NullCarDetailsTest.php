<?php
declare(strict_types=1);

namespace VehicleCheckerTest\Entities;

use PHPUnit\Framework\TestCase;
use VehicleChecker\Entities\NullCarDetails;

class NullCarDetailsTest extends TestCase
{
    /**
     * @var NullCarDetails
     */
    private NullCarDetails $car;

    protected function setUp(): void
    {
        parent::setUp();
        $this->car = new NullCarDetails();
    }

    public function testCanGetMake(): void
    {
        $this->assertEmpty($this->car->getMake());
    }

    public function testCanGetModel(): void
    {
        $this->assertEmpty($this->car->getModel());
    }

    public function testCanGetColour(): void
    {
        $this->assertEmpty($this->car->getColour());
    }

    public function testCanGetFailedMotCount(): void
    {
        $this->assertEquals(0, $this->car->getFailedMotCount());
    }
}
