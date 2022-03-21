<?php
declare(strict_types=1);

namespace VehicleCheckerTest\Entities;

use PHPUnit\Framework\TestCase;
use VehicleChecker\Entities\VehicleRegistration;

class VehicleRegistrationTest extends TestCase
{
    public function testWhitespaceStringable(): void
    {
        $vehicleReg = new VehicleRegistration('BD20DBB');

        $this->assertEquals('BD20DBB', (string) $vehicleReg);
    }

    public function testAllWhitespaceIsRemoved(): void
    {
        $vehicleReg = new VehicleRegistration(' BD20 DAA ');

        $this->assertEquals('BD20DAA', (string) $vehicleReg);
    }
}
