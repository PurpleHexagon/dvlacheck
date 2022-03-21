<?php
declare(strict_types=1);

namespace DvlaTest\Services;

use Dvla\Services\DvlaHttpClient;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use VehicleChecker\Entities\VehicleRegistration;

class DvlaHttpClientTest extends TestCase
{
    use ProphecyTrait;

    /**
     * @var DvlaHttpClient
     */
    private DvlaHttpClient $dvlaHttpClient;

    /**
     * @var ObjectProphecy|Client
     */
    private ObjectProphecy|Client $httpClient;

    protected function setUp(): void
    {
        parent::setUp();

        $this->httpClient = $this->prophesize(Client::class);
        $this->httpClient->get(Argument::any(), Argument::any())->willReturn(
            new Response(
                body: '[{"registration":"BD17DAA","make":"FIAT","model":"500X","firstUsedDate":"2017.03.31","fuelType":"Diesel","primaryColour":"Black","motTests":[{"completedDate":"2020.03.30 22:24:56","testResult":"PASSED","expiryDate":"2020.09.30","odometerValue":"0","motTestNumber":"562297416664","rfrAndComments":[{"text":"COVID-19 6 MONTH EXTENSION","type":"ADVISORY"}]}]}]'
            )
        );

        $this->dvlaHttpClient = new DvlaHttpClient(
            $this->httpClient->reveal(),
            'https://example.com/',
            '12345'
        );
    }

    public function testHttpClientIsCalledSuccess()
    {
        $registration = new VehicleRegistration('BD20DAD');
        $this->dvlaHttpClient->getMotByRegistration($registration);

        $this->httpClient->get(
            Argument::exact('https://example.com/BD20DAD'),
            Argument::exact([
                'headers' => [
                    'x-api-key' => '12345',
                    'Content-Type' => 'application/json',
                ]
            ])
        )->shouldHaveBeenCalled();
    }

    public function testReturnsArrayWhen200()
    {
        $registration = new VehicleRegistration('BD20DAD');
        $result = $this->dvlaHttpClient->getMotByRegistration($registration);

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }

    public function testReturnsArrayWhen404()
    {
        $this->httpClient->get(Argument::any(), Argument::any())->willReturn(
            new Response(
                status: 404,
                body: '[{"registration":"BD17DAA","make":"FIAT","model":"500X","firstUsedDate":"2017.03.31","fuelType":"Diesel","primaryColour":"Black","motTests":[{"completedDate":"2020.03.30 22:24:56","testResult":"PASSED","expiryDate":"2020.09.30","odometerValue":"0","motTestNumber":"562297416664","rfrAndComments":[{"text":"COVID-19 6 MONTH EXTENSION","type":"ADVISORY"}]}]}]'
            )
        );

        $registration = new VehicleRegistration('BD20DAD');
        $result = $this->dvlaHttpClient->getMotByRegistration($registration);

        $this->assertIsArray($result);
        $this->assertEmpty($result);
    }
}
