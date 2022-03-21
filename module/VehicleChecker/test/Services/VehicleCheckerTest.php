<?php
declare(strict_types=1);

namespace VehicleCheckerTest\Services;

use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Psr\SimpleCache\CacheInterface;
use VehicleChecker\Contracts\CarDetailsInterface;
use VehicleChecker\Contracts\VehicleCheckerBridgeInterface;
use VehicleChecker\Entities\NullCarDetails;
use VehicleChecker\Entities\VehicleRegistration;
use VehicleChecker\Services\VehicleChecker;

class VehicleCheckerTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @var NullCarDetails
     */
    private NullCarDetails $vehicle;

    /**
     * @var ObjectProphecy|VehicleCheckerBridgeInterface
     */
    private ObjectProphecy|VehicleCheckerBridgeInterface $bridge;

    /**
     * @var VehicleChecker
     */
    private VehicleChecker $vehicleChecker;

    /**
     * @var ObjectProphecy|CacheInterface
     */
    private ObjectProphecy|CacheInterface $cache;

    protected function setUp(): void
    {
        parent::setUp();

        $this->vehicle = new NullCarDetails();
        $this->cache = $this->prophesize(CacheInterface::class);
        $this->cache->has(Argument::any())->willReturn(false);
        $this->cache->set(Argument::any(), Argument::any(), Argument::any())->willReturn(false);

        $this->bridge = $this->prophesize(VehicleCheckerBridgeInterface::class);
        $this->bridge->checkVehicleByRegistration(Argument::type(VehicleRegistration::class))
            ->willReturn($this->vehicle);

        $this->vehicleChecker = new VehicleChecker($this->bridge->reveal(), $this->cache->reveal());
    }

    public function testVehicleDetailsReturnsCarDetailsInterface(): void
    {
        $result = $this->vehicleChecker->vehicleDetails('BD17 DAA');

        $this->assertInstanceOf(CarDetailsInterface::class, $result);
    }

    public function testVehicleDetailsCallsBridgeWithRegistration(): void
    {
        $this->vehicleChecker->vehicleDetails('BD17 DAA');

        $registration = new VehicleRegistration('BD17 DAA');
        $this->bridge->checkVehicleByRegistration(Argument::exact($registration))
            ->shouldBeCalled();
    }
}
