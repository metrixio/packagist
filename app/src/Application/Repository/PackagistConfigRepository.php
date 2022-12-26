<?php

declare(strict_types=1);

namespace App\Application\Repository;

use App\Infrastructure\Packagist\PackagistConfig;

final class PackagistConfigRepository implements PackagistRepositoryInterface
{
    public function __construct(
        private readonly PackagistConfig $config,
    ) {
    }

    public function all(): array
    {
        return $this->config->getRepositories();
    }
}
