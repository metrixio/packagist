<?php

declare(strict_types=1);

namespace App\Infrastructure\Packagist\DTO;

final class Package implements \JsonSerializable
{
    public function __construct(
        public readonly string $name,
        public readonly string $description,
        public readonly string $repository,
        public readonly Downloads $downloads,
        public readonly Github $github,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'downloads' => $this->downloads->jsonSerialize(),
            'github' => $this->github->jsonSerialize(),
        ];
    }
}
