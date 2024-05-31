<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Prometheus\CollectorRegistry;
use Prometheus\Exception\MetricsRegistrationException;
use Prometheus\Storage\InMemory;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected CollectorRegistry $registry;

    public function __construct()
    {
        $this->registry = new CollectorRegistry(new InMemory());
    }

    /**
     * @throws MetricsRegistrationException
     */
    protected function countRequest($routeName)
    {
        $counter = $this->registry->getOrRegisterCounter('app', 'http_requests_total', 'Total number of HTTP requests', ['route']);
        $counter->inc([$routeName]);
    }

    /**
     * @throws MetricsRegistrationException
     */
    protected function measureResponseTime($routeName, $startTime)
    {
        $histogram = $this->registry->getOrRegisterHistogram('app', 'http_response_time_seconds', 'Response time in seconds', ['route']);
        $duration = microtime(true) - $startTime;
        $histogram->observe($duration, [$routeName]);
    }
}
