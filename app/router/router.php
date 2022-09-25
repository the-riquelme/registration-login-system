<?php

function getRoutes() {
  return require 'routes.php';
}

function exactMatchUriInRoutes($uri, $routes) {
  if (array_key_exists($uri, $routes)) {
    return [
      $uri => $routes[$uri]
    ];
  }

  return [];
}

function regexMatchRoutes($uri, $routes) {
  return array_filter(
    $routes,
    function($value) use ($uri) {
        $regex = str_replace('/', '\/', ltrim($value, '/'));

        return preg_match("/^{$regex}$/", ltrim($uri, '/'));
    },
    ARRAY_FILTER_USE_KEY
  );
}

function formatParams($uri, $params) {
  $paramsData = [];

  foreach ($params as $index => $param) {
    $paramsData[$uri[$index - 1]] = $param;
  }

  return $paramsData;
}

function getParams($uri, $matchedUri) {
  if (!empty($matchedUri)) {
    $matchedToGetParams = array_keys($matchedUri)[0];

    $params = array_diff(
      $uri,
      explode('/', ltrim($matchedToGetParams, '/'))
    );

    return formatParams($uri, $params);
  }

  return [];
}

function router() {
  $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
  $routes = getRoutes();
  $matchedUri = exactMatchUriInRoutes($uri, $routes);
  $params = [];

  if (empty($matchedUri)) {
    $matchedUri = regexMatchRoutes($uri, $routes);
    $uri = explode('/', ltrim($uri, '/'));
    $params = getParams($uri, $matchedUri);
  }

  if (!empty($matchedUri)) {
    return loadController($matchedUri, $params);
  }

  throw new Exception('Algo deu Errado!');
}