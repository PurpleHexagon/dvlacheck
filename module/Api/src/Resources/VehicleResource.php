<?php
declare(strict_types=1);

namespace Api\Resources;

use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\Hydrator\Strategy\DateTimeFormatterStrategy;
use Laminas\Hydrator\Strategy\DateTimeImmutableFormatterStrategy;
use Laminas\View\Model\JsonModel;
use VehicleChecker\Contracts\CarDetailsInterface;

class VehicleResource
{
    /**
     * @param CarDetailsInterface $carDetails
     * @return JsonModel
     */
    public static function make(CarDetailsInterface $carDetails)
    {
        $hydrator = new ClassMethodsHydrator();

        $hydrator->addStrategy(
            'mot_expiry_date',
            new DateTimeImmutableFormatterStrategy(
                new DateTimeFormatterStrategy('d/m/Y')
            )
        );

        return new JsonModel($hydrator->extract($carDetails));
    }
}
