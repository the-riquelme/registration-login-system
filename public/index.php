<?php

require 'bootstrap.php';

try {
  $router = router();
  
  extract($router['data']); // !

  if (!isset($router['view'])) {
    throw new Exception('O índice view está faltando');
  }
  
  if (!isset($router['data'])) {
    throw new Exception('O índice data está faltando');
  }

  if (!file_exists(VIEWS.$router['view'])) {
    throw new Exception("Essa view ({$router['view']}) não existe");
  }

  $view = $router['view'];

  require VIEWS.'master.php';
} catch(Exception $e) {
  var_dump($e->getMessage());
}