<?php
declare(strict_types=1);

namespace ApiTest\Controllers;

use Api\Controllers\VehicleApiController;
use Laminas\Stdlib\ArrayUtils;
use Laminas\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class CarApiControllerTest extends AbstractHttpControllerTestCase
{
    public function setUp(): void
    {
        $configOverrides = [];

        $this->setApplicationConfig(ArrayUtils::merge(
            include __DIR__ . '/../../../../config/application.config.php',
            $configOverrides
        ));

        parent::setUp();
    }

    public function testIndexActionCanBeAccessed(): void
    {
        $this->dispatch('/api/vehicle/BD20DAD', 'GET');
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('api');
        $this->assertControllerName(VehicleApiController::class);
        $this->assertControllerClass('VehicleApiController');
        $this->assertMatchedRouteName('vehicle_api');

        $this->assertResponseStatusCode(200);
        $body = json_decode($this->getResponse()->getContent(), true);

        $this->assertEquals("KIA", $body['make']);
        $this->assertEquals("NIRO", $body['model']);
        $this->assertEquals("Blue", $body['colour']);
        $this->assertEquals(null, $body['mot_expiry_date']);
        $this->assertEquals(0, $body['failed_mot_count']);
    }
}
