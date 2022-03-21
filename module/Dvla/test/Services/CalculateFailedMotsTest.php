<?php
declare(strict_types=1);

namespace DvlaTest;

use Dvla\Services\CalculateFailedMots;
use PHPUnit\Framework\TestCase;

class CalculateFailedMotsTest extends TestCase
{
    /**
     * @var CalculateFailedMots
     */
    private CalculateFailedMots $calculateFailedMots;

    protected function setUp(): void
    {
        parent::setUp();
        $this->calculateFailedMots = new CalculateFailedMots();
    }

    public function testWhenNoFailures()
    {
        $motData = [
          ['testResult' => 'SUCCESS']
        ];

        $result = ($this->calculateFailedMots)($motData);

        $this->assertEquals(0, $result);
    }

    public function testWhenFailures()
    {
        $motData = [
            ['testResult' => 'FAILED'],
            ['testResult' => 'FAILED']
        ];

        $result = ($this->calculateFailedMots)($motData);

        $this->assertEquals(2, $result);
    }

    public function testWhenNoResultsInRecord()
    {
        $motData = [
            [],
        ];

        $result = ($this->calculateFailedMots)($motData);

        $this->assertEquals(0, $result);
    }

    public function testWhenEmpty()
    {
        $motData = [];

        $result = ($this->calculateFailedMots)($motData);

        $this->assertEquals(0, $result);
    }
}
