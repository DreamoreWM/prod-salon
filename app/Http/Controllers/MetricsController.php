<?php

namespace App\Http\Controllers;

use Prometheus\CollectorRegistry;
use Prometheus\RenderTextFormat;
use Prometheus\Storage\InMemory;
use Throwable;

class MetricsController extends Controller
{
    /**
     * @throws Throwable
     */
    public function getMetrics()
    {
        $registry = new CollectorRegistry(new InMemory());
        $renderer = new RenderTextFormat();
        $metrics = $registry->getMetricFamilySamples();
        header('Content-type: ' . RenderTextFormat::MIME_TYPE);
        echo $renderer->render($metrics);
    }
}
