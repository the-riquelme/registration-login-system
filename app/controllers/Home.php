<?php

namespace app\controllers;

class Home
{
    public function index($params)
    {
        read('users', 'id, name, surname');
        order('id', 'DESC');
        limit(2);
        $users = execute(isFetchAll:false);

        var_dump(json_encode($users));
        die();
        // $users = fetchAll('users');

        // return [
        //     'view' => 'home',
        //     'data' => [
        //         'title' => 'Home',
        //         'users' => $users,
        //     ]
        // ];
    }
}