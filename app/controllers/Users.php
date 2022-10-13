<?php

namespace app\controllers;

class Users
{
    public function index()
    {
        $users = fetchAll('users', 'id, name, surname');

        echo json_encode($users);
    }
}