# Packagist metrics collector

<a href="https://packagist.org/packages/metrixio/packagist"><img src="https://poser.pugx.org/metrixio/packagist/require/php"></a>
<a href="https://packagist.org/packages/metrixio/packagist"><img src="https://poser.pugx.org/metrixio/packagist/version"></a>
<a href="https://github.com/metrixio/packagist/actions"><img src="https://github.com/metrixio/packagist/actions/workflows/docker-image.yml/badge.svg"></a>
<a href="https://packagist.org/packages/metrixio/packagist"><img src="https://poser.pugx.org/metrixio/packagist/downloads"></a>

![packagist](https://user-images.githubusercontent.com/773481/209584409-3275bfa7-f131-44de-b4c1-341d4b0cd3d3.png)

This tool lets you easily gather data about downloads from Packagist.

It works with Prometheus and Grafana to collect data from Packagist, store it in Prometheus, and create visualizations
with Grafana. You can use Grafana to customize the data you collect and create dashboards that fit your needs.

We hope you find it helpful!

## Dashboard

![image](https://user-images.githubusercontent.com/773481/209584323-9f673696-f235-4737-b7ea-719da8c3ada3.png)

## Usage

Check out the documentation in the [dashboard](https://github.com/metrixio/dashboard) repository. That should give you
all the details you need to get going.

```dotenv
# Packagist repository names to follow (comma separated)
PACKAGIST_REPOSITORIES=...
```

### Docker

```yaml
version: "3.7"

services:
    docker-metrics:
        image: ghcr.io/metrixio/packagist:latest
        environment:
            PACKAGIST_REPOSITORIES: ...
        restart: on-failure

    prometheus:
        image: prom/prometheus
        volumes:
            - ./runtime/prometheus:/prometheus
        restart: always

    grafana:
        image: grafana/grafana
        depends_on:
            - prometheus
        ports:
            - 3000:3000
        volumes:
            - ./runtime/grafana:/var/lib/grafana
        restart: always
```

### Local server

```bash
composer create-project metrixio/packagist
```

Define the repositories you want to track in `.env` file

```dotenv
PACKAGIST_REPOSITORIES=spiral/framework,...
```

Once the project is installed and configured you can start application server:

```bash
./rr serve
```

Metrics will be available on http://127.0.0.1:2112.

> **Note**:
> To fix unable to open metrics page, change metrics address in RoadRunner config file to `127.0.0.1:2112`.

-----

The package is built with some of the best tools out there for PHP. It's powered
by [Spiral Framework](https://github.com/spiral/framework/), which makes it super fast and efficient, and it
uses [RoadRunner](https://github.com/roadrunner-server/roadrunner) as the server, which is a really great tool for
collecting metrics data for Prometheus.
