<?php

namespace app\controllers;

class Home
{
    public function index($params)
    {
        $search = htmlspecialchars($_GET['search'] ?? '');

        read('users');

        if ($search) {
            search(['name' => $search]);
        }

        paginate(5);

        $users = execute();

        return [
            'view' => 'home',
            'data' => [
                'title' => 'Home',
                'users' => $users,
                'links' => render()
            ]
        ];
    }
}