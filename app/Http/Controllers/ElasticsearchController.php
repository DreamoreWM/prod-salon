<?php

namespace App\Http\Controllers;

use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;

class ElasticsearchController extends Controller
{
    public function testConnection()
    {
        $host = sprintf(
            '%s://%s:%s@%s',
            env('ELASTICSEARCH_SCHEME'),
            env('ELASTICSEARCH_USERNAME'),
            env('ELASTICSEARCH_PASSWORD'),
            env('ELASTICSEARCH_HOST')
        );

        $client = ClientBuilder::create()
            ->setHosts([$host])
            ->setSSLVerification(false) // Désactiver temporairement la vérification SSL
            ->build();

        try {
            $response = $client->info();
            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}

