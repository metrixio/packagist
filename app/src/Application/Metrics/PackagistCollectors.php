<?php

declare(strict_types=1);

namespace App\Application\Metrics;

use Spiral\RoadRunner\Metrics\Collector;

final class PackagistCollectors implements CollectorsInterface
{
    public const DOWNLOADS = 'packagist_downloads';
    public const DOWNLOADS_MONTHLY = 'packagist_downloads_monthly';
    public const DOWNLOADS_DAILY = 'packagist_downloads_daily';

    public function getIterator(): \Traversable
    {
        yield self::DOWNLOADS => Collector::gauge()
            ->withHelp('Package downloads statistics.')
            ->withLabels('package');

        yield self::DOWNLOADS_MONTHLY => Collector::gauge()
            ->withHelp('Package monthly downloads statistics.')
            ->withLabels('package');

        yield self::DOWNLOADS_DAILY => Collector::gauge()
            ->withHelp('Package daily downloads statistics.')
            ->withLabels('package');
    }
}
