<?php

declare(strict_types=1);

namespace App\Application\Metrics;

use Spiral\RoadRunner\Metrics\MetricsInterface;

final class PackagistMetrics
{
    public function __construct(
        private readonly MetricsInterface $metrics
    ) {
    }

    public function setDownloads(float $count, mixed $repo): void
    {
        $this->metrics->set(PackagistCollectors::DOWNLOADS, $count, [$repo]);
    }

    public function setDownloadsMonthly(float $count, mixed $repo): void
    {
        $this->metrics->set(PackagistCollectors::DOWNLOADS_MONTHLY, $count, [$repo]);
    }

    public function setDownloadsDaily(float $count, mixed $repo): void
    {
        $this->metrics->set(PackagistCollectors::DOWNLOADS_DAILY, $count, [$repo]);
    }
}
