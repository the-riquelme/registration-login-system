<?php

namespace app\controllers;

class Home
{
    public function index($params)
    {
        $search = htmlspecialchars($_GET['search']);

        read('users');
        paginate(2);

        // if ($search) {
        //     search(['name' => $search]);
        // }

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