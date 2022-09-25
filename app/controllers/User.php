<?php

namespace app\controllers;

class User {
  public function create($params) {
    var_dump($params['user']);
    die();
  }
  
  public function show($params) {
    var_dump($params);
    die();
  }
}