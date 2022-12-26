<?php

declare(strict_types=1);

namespace App\Infrastructure\Packagist;

use App\Infrastructure\Packagist\DTO\Downloads;
use App\Infrastructure\Packagist\DTO\Github;
use App\Infrastructure\Packagist\DTO\Package;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class Client implements ClientInterface
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
    ) {
    }

    public function getPackageInformation(string $package): Package
    {
        $response = $this->httpClient->request('GET', "/packages/{$package}.json");

        if ($response->getStatusCode() !== 200) {
            throw new \RuntimeException(\sprintf('Package [%s] something went wrong', $package));
        }

        $data = \json_decode($response->getContent(), true);

        return new Package(
            name: $data['package']['name'],
            description: $data['package']['description'],
            repository: $data['package']['repository'],
            downloads: new Downloads(
                total: $data['package']['downloads']['total'],
                monthly: $data['package']['downloads']['monthly'],
                daily: $data['package']['downloads']['daily'],
            ),
            github: new Github(
                stars: $data['package']['github_stars'],
                watchers: $data['package']['github_watchers'],
                forks: $data['package']['github_forks'],
                openIssues: $data['package']['github_open_issues'],
            ),
        );
    }
}
