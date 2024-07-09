<?php

declare(strict_types=1);

return [
    /*
     * There are different options for the connection. Since Explorer uses the Elasticsearch PHP SDK
     * under the hood, all the host configuration options of the SDK are applicable here. See
     * https://www.elastic.co/guide/en/elasticsearch/client/php-api/current/configuration.html
     */
    'connection' => [
        'host' => env('ELASTICSEARCH_HOST', 'b2f84529180b4147a99ccf767545ed6d.us-central1.gcp.cloud.es.io'),
        'port' => '443',
        'scheme' => 'https',
        'auth' => [
            'username' => env('ELASTICSEARCH_USERNAME', 'super-admin'),
            'password' => env('ELASTICSEARCH_PASSWORD', 'p@ssw0rd'),
        ],
    ],

    /**
     * The default index settings used when creating a new index. You can override these settings
     * on a per-index basis by implementing the IndexSettings interface on your model or defining
     * them in the index configuration below.
     */
    'default_index_settings' => [
        //'index' => [],
        //'analysis' => [],
    ],

    /**
     * An index may be defined on an Eloquent model or inline below. A more in depth explanation
     * of the mapping possibilities can be found in the documentation of Explorer's repository.
     */
    'indexes' => [
        'employees' => [
            'settings' => [
                'analysis' => [
                    'analyzer' => [
                        'standard_lowercase' => [
                            'type' => 'custom',
                            'tokenizer' => 'standard',
                            'filter' => ['lowercase'],
                        ],
                    ],
                ],
            ],
        ],
        'users' => [
            'settings' => [
                'analysis' => [
                    'analyzer' => [
                        'standard_lowercase' => [
                            'type' => 'custom',
                            'tokenizer' => 'standard',
                            'filter' => ['lowercase'],
                        ],
                    ],
                ],
            ],
        ],
        'categories' => [
            'settings' => [
                'analysis' => [
                    'analyzer' => [
                        'standard_lowercase' => [
                            'type' => 'custom',
                            'tokenizer' => 'standard',
                            'filter' => ['lowercase'],
                        ],
                    ],
                ],
            ],
        ],
        'prestations' => [
            'settings' => [
                'analysis' => [
                    'analyzer' => [
                        'standard_lowercase' => [
                            'type' => 'custom',
                            'tokenizer' => 'standard',
                            'filter' => ['lowercase'],
                        ],
                    ],
                ],
            ],
        ],
        'absences' => [
            'settings' => [
                'analysis' => [
                    'analyzer' => [
                        'standard_lowercase' => [
                            'type' => 'custom',
                            'tokenizer' => 'standard',
                            'filter' => ['lowercase'],
                        ],
                    ],
                ],
            ],
        ],
        'appointments' => [
            'settings' => [
                'analysis' => [
                    'analyzer' => [
                        'standard_lowercase' => [
                            'type' => 'custom',
                            'tokenizer' => 'standard',
                            'filter' => ['lowercase'],
                        ],
                    ],
                ],
            ],
        ],

    ],

    /**
     * You may opt to keep the old indices after the alias is pointed to a new index.
     * A model is only using index aliases if it implements the Aliased interface.
     */
    'prune_old_aliases' => true,

    /**
     * When set to true, sends all the logs (requests, responses, etc.) from the Elasticsearch PHP SDK
     * to a PSR-3 logger. Disabled by default for performance.
     */
    'logging' => env('EXPLORER_ELASTIC_LOGGER_ENABLED', false),
    'logger' => null,
];
