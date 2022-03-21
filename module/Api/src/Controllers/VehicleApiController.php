<?php
declare(strict_types=1);

namespace Api\Controllers;

use Api\Resources\VehicleResource;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\JsonModel;
use VehicleChecker\Contracts\VehicleCheckerInterface;
use VehicleChecker\Entities\NullCarDetails;

class VehicleApiController extends AbstractActionController
{
    /**
     * @param VehicleCheckerInterface $vehicleChecker
     */
    public function __construct(private VehicleCheckerInterface $vehicleChecker)
    {
    }

    /**
     * Laminas expects a home route
     * @return JsonModel
     */
    public function indexAction()
    {
        return new JsonModel();
    }

    /**
     * GET /api/vehicle/[:registration]
     * @return JsonModel
     */
    public function showAction(): JsonModel
    {
        try {
            $registration = $this->params()->fromRoute('registration');
            $carDetails = $this->vehicleChecker->vehicleDetails($registration);
            if ($carDetails instanceof NullCarDetails) {
                $this->getResponse()->setStatusCode(404);
                return new JsonModel();
            }

            return VehicleResource::make($carDetails);
        } catch (\Exception $exception) {
            $this->getResponse()->setStatusCode(500);
            return new JsonModel();
        }
    }
}
