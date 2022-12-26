<?php

declare(strict_types=1);

namespace App\Infrastructure\Packagist;

use Spiral\Core\InjectableConfig;

final class PackagistConfig extends InjectableConfig
{
    public const CONFIG = 'packagist';

    public function __construct(
        protected array $config = [
            'repositories' => [],
        ]
    ) {
    }

    public function getRepositories(): array
    {
        return $this->config['repositories'] ?? [];
    }
}


