<?php

namespace App\Logging;

use Monolog\Logger;
use Monolog\Handler\ElasticsearchHandler;
use Elastic\Elasticsearch\ClientBuilder;

class ElasticsearchLogger
{
    /**
     * Create a custom Monolog instance.
     *
     * @param  array  $config
     * @return \Monolog\Logger
     */
    public function __invoke(array $config)
    {
        $client = ClientBuilder::create()
            ->setHosts(['localhost:9200']) // Mettez ici l'adresse de votre serveur Elasticsearch
            ->build();

        $handler = new ElasticsearchHandler($client, [
            'index' => 'laravel_logs', // Nom de l'index Elasticsearch
            'type' => '_doc', // Type de document Elasticsearch (non obligatoire pour les versions récentes)
        ]);

        return new Logger('elasticsearch', [$handler]);
    }
}
