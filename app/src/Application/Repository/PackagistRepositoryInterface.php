<?php

declare(strict_types=1);

namespace App\Application\Repository;

interface PackagistRepositoryInterface
{
    public function all(): array;
}
