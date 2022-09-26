<?php

namespace app\controllers;

class User {
  
  public function show($params) {
    if (!isset($params['user'])) {
      return redirect();
    }

    $user = findBy('users', 'id', $params['user']);
    var_dump($user);
    die();
  }

  public function create() {
    return [
      'view'  => 'create.php',
      'data' => ['title' => 'Create']
    ];
  }

  public function store() {
    $validate = validate([
      'name' => 'required',
      'surname' => 'required',
      'email' => 'required|email|unique:users',
      'password' => 'maxlen:5|required',
    ]);

    if (!$validate) {
      return redirect('/user/create');
    }

  }
  
}