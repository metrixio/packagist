<?php

declare(strict_types=1);

namespace App\Infrastructure\Packagist\DTO;

final class Downloads implements \JsonSerializable
{
    public function __construct(
        public readonly int $total,
        public readonly int $monthly,
        public readonly int $daily,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'total' => $this->total,
            'monthly' => $this->monthly,
            'daily' => $this->daily,
        ];
    }
}
