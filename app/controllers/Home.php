<?php

namespace app\controllers;

class Home
{
    public function index($params)
    {
        $search = ($_GET['search']);

        read('users', 'id, name, surname');

        if ($search) {
            search(['name' => $search]);
        }

        $users = execute();

        return [
            'view' => 'home',
            'data' => [
                'title' => 'Home',
                'users' => $users,
            ]
        ];
    }
}