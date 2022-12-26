<?php

declare(strict_types=1);

namespace App\Application\Job;

use App\Application\Metrics\PackagistMetrics;
use App\Infrastructure\Packagist\ClientInterface;
use Psr\Log\LoggerInterface;
use Spiral\Exceptions\ExceptionReporterInterface;
use Spiral\Queue\Exception\RetryException;
use Spiral\Queue\JobHandler;
use Spiral\Queue\Options;

final class PackagistDataCollector extends JobHandler
{
    /**
     * @throws RetryException
     */
    public function invoke(
        PackagistMetrics $metrics,
        LoggerInterface $logger,
        ClientInterface $client,
        ExceptionReporterInterface $reporter,
        array $payload,
        array $headers = []
    ): void {
        $repo = $payload['repository'];

        $attempts = (int)($headers['attempts'] ?? 0);

        if ($attempts === 0) {
            $logger->warning('Attempt to fetch [%s] docker data failed', $repo);
            return;
        }

        try {
            $package = $client->getPackageInformation($repo);

            $metrics->setDownloads((float)$package->downloads->total, $package->name);
            $metrics->setDownloadsMonthly((float)$package->downloads->monthly, $package->name);
            $metrics->setDownloadsDaily((float)$package->downloads->daily, $package->name);

        } catch (\Throwable $e) {
            $reporter->report($e);

            throw new RetryException(
                reason: $e->getMessage(),
                options: (new Options())->withDelay(5)->withHeader('attempts', (string)($attempts - 1))
            );
        }
    }
}
