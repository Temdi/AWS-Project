<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/home', function (Request $request, Response $response) {
    $this->logger->addInfo("Home list");

    $client = new \GuzzleHttp\Client();

    $headers = ['X-BetaSeries-Key' => 'da1ae8f7ebe9'];

    $responseClient = $client->request(
        'GET',
        'https://api.betaseries.com/news/last?key=da1ae8f7ebe9',
        $headers
    );

    $json = json_decode($responseClient->getBody(), true);
    $response = $this->renderer->render($response, "home.phtml", ["json" => $json ]);
    return $response;
});

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});


