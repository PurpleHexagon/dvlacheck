<?php
declare(strict_types=1);

namespace Cli;

class Module
{
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
