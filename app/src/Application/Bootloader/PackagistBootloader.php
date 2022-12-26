<?php

declare(strict_types=1);

namespace App\Application\Bootloader;

use App\Application\PackagistRepositoryRegistry;
use App\Application\Repository\PackagistConfigRepository;
use App\Application\Repository\PackagistEvnRepository;
use App\Infrastructure\Packagist\Client;
use App\Infrastructure\Packagist\ClientInterface;
use Spiral\Boot\Bootloader\Bootloader;
use Symfony\Component\HttpClient\NativeHttpClient;

final class PackagistBootloader extends Bootloader
{
    protected const SINGLETONS = [
        ClientInterface::class => [self::class, 'initPackagistClient'],
        PackagistRepositoryRegistry::class => [self::class, 'initRegistry'],
    ];

    private function initRegistry(
        PackagistConfigRepository $configRepository,
        PackagistEvnRepository $envRepository,
    ): PackagistRepositoryRegistry {
        $repositories = \array_merge(
            $configRepository->all(),
            $envRepository->all(),
        );

        return new PackagistRepositoryRegistry(
            \array_unique($repositories)
        );
    }

    private function initPackagistClient(): ClientInterface
    {
        return new Client(
            new NativeHttpClient([
                'base_uri' => 'https://packagist.org',
            ])
        );
    }
}
