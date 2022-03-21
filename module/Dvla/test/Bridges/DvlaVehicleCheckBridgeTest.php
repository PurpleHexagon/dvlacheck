<?php
declare(strict_types=1);

namespace DvlaTest\Bridges;

use Dvla\Bridges\DvlaVehicleCheckBridge;
use Dvla\Services\DvlaHttpClient;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use VehicleChecker\Entities\CarDetails;
use VehicleChecker\Entities\VehicleRegistration;

class DvlaVehicleCheckBridgeTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @var ObjectProphecy|DvlaHttpClient
     */
    private ObjectProphecy|DvlaHttpClient $httpClient;

    /**
     * @var DvlaVehicleCheckBridge
     */
    private DvlaVehicleCheckBridge $bridge;

    protected function setUp(): void
    {
        parent::setUp();

        $this->httpClient = $this->prophesize(DvlaHttpClient::class);

        $this->bridge = new DvlaVehicleCheckBridge($this->httpClient->reveal());
    }

    public function testCheckVehicleByRegistrationSuccess()
    {
        $body = [
            'registration' => 'BD17DAA',
            'make' => 'FIAT',
            'model' => '500X',
            'firstUsedDate' => '2017.03.31',
            'fuelType' => 'Diesel',
            'primaryColour' => 'Black',
            'motTests' =>
                [
                    [
                        'completedDate' => '2020.03.30 22:24:56',
                        'testResult' => 'PASSED',
                        'expiryDate' => '2020.09.30',
                        'odometerValue' => '0',
                        'motTestNumber' => '562297416664',
                        'rfrAndComments' =>
                            [
                                0 =>
                                    [
                                        'text' => 'COVID-19 6 MONTH EXTENSION',
                                        'type' => 'ADVISORY',
                                    ],
                            ],
                    ],
                ],
        ];

        $registration = new VehicleRegistration('BD17 DAA');

        $this->httpClient->getMotByRegistration(Argument::exact($registration))
            ->willReturn($body);

        $entity = $this->bridge->checkVehicleByRegistration($registration);

        $this->assertInstanceOf(CarDetails::class, $entity);
    }
}
