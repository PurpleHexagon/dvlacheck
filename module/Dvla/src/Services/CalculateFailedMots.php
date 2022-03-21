<?php
declare(strict_types=1);

namespace Dvla\Services;

class CalculateFailedMots
{
    /**
     * Reduce the failed test results down to a numeric total
     *
     * @param array $motTestData
     * @return int
     */
    public function __invoke(array $motTestData): int
    {
        return array_reduce(
            $motTestData,
            function ($accum, $current): int {
                if (isset($current['testResult']) && $current['testResult'] === "FAILED") {
                    $accum += 1;
                }

                return $accum;
            },
            0
        );
    }
}
