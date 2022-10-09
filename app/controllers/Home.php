<?php

namespace app\controllers;

class Home {
  
  public function index($params) {
    $users = fetchAll('users');
    return [
      'view' => 'home',
      'data' => [
        'title' => 'Home',
        'users' => $users
      ]
    ];
  }
  
}