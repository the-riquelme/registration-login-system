<?php

require 'bootstrap.php';

try {
  $router = router();

  if (!isset($router['data'])) {
    throw new Exception('O índice data está faltando');
  }

  if (!isset($router['data']['title'])) {
    throw new Exception('O índice title está faltando');
  }

  if (!isset($router['view'])) {
    throw new Exception('O índice view está faltando');
  }

  if (!file_exists(VIEWS.$router['view'])) {
    throw new Exception("Essa view ({$router['view']}) não existe");
  }

  extract($router['data']); // !

  $view = $router['view'];

  require VIEWS.'master.php';
} catch(Exception $e) {
  var_dump($e->getMessage());
}