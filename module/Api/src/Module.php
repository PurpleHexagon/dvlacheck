<?php
declare(strict_types=1);

namespace Api;

use Laminas\EventManager\SharedEventManager;
use Laminas\Mvc\MvcEvent;
use Laminas\View\Model\JsonModel;

class Module
{
    public function onBootstrap(MvcEvent $event): void
    {
        $sharedEvents = $event->getApplication()->getEventManager()->getSharedManager();

        if ($sharedEvents instanceof SharedEventManager) {
            $sharedEvents->attach(__NAMESPACE__, MvcEvent::EVENT_DISPATCH, function (MvcEvent $event) {
                $event->setViewModel(new JsonModel());
            }, 100);
        }
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        /** @var array $config */
        $config = include __DIR__ . '/../config/module.config.php';
        return $config;
    }
}
