<?php

declare(strict_types=1);

namespace App\Infrastructure\Packagist;

use App\Infrastructure\Packagist\DTO\Package;

interface ClientInterface
{
    public function getPackageInformation(string $package): Package;
}
