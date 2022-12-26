<?php

declare(strict_types=1);

namespace App\Infrastructure\Packagist\DTO;

final class Github implements \JsonSerializable
{
    public function __construct(
        public readonly int $stars,
        public readonly int $watchers,
        public readonly int $forks,
        public readonly int $openIssues,
    ) {
    }

    public function jsonSerialize(): array
    {
        return [
            'stars' => $this->stars,
            'watchers' => $this->watchers,
            'forks' => $this->forks,
            'open_issues' => $this->openIssues,
        ];
    }
}
