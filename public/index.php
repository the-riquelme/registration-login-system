<?php

require 'bootstrap.php';

try {
    $router = router();

    if (isAjax()) {
        die();
    }

    if (!isset($router['data'])) {
        throw new Exception('O índice data está faltando');
    }

    if (!isset($router['data']['title'])) {
        throw new Exception('O índice title está faltando');
    }

    if (!isset($router['view'])) {
        throw new Exception('O índice view está faltando');
    }

    if (!file_exists(VIEWS . $router['view'] . '.php')) {
        throw new Exception("Essa view ({$router['view']}) não existe");
    }

    // Create new Plates instance
    $templates = new League\Plates\Engine(VIEWS);

    // Render a template
    echo $templates->render($router['view'], $router['data']);

    // extract($router['data']); // !

    // $view = $router['view'];

    // require VIEWS.'master.php';
} catch(Exception $e) {
    dieDump($e->getMessage());
}