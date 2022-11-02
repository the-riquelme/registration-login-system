<?php

namespace app\controllers;

class User
{
    public function show($params)
    {
        if (!isset($params['user'])) {
            return redirect();
        }

        $user = findBy('users', 'id', $params['user']);
        var_dump($user);
        die();
    }

    public function edit()
    {
        if (!logged()) {
            redirect();
        }

        read('users', 'users.id, name, surname, email, password, path');
        tableJoin('photos', 'id', 'left');
        where('users.id', getSessionUser()->id);

        $user = execute(isFetchAll:false);

        return [
            'view' => 'edit',
            'data' => ['title' => 'Edit', 'user' => $user]
        ];
    }

    public function create()
    {
        return [
            'view' => 'create',
            'data' => ['title' => 'Create']
        ];
    }

    public function store()
    {
        $validate = validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'optional|email|unique:users',
            'password' => 'required|maxlen:10',
        ], persistInput:true, checkCsrf:true);

        if (!$validate) {
            return redirect('/user/create');
        }

        $validate['password'] = \password_hash($validate['password'], PASSWORD_DEFAULT);

        if (!create('users', $validate)) {
            setFlash('message', 'Ocorreu um erro ao cadastrar, tente novamente mais tarde.');
            return redirect('/user/create');
        }

        return redirect('/');
    }

    public function update($args)
    {
        if (!isset($args['user']) || $args['user'] != getSessionUser()->id) {
            return redirect('/');
        }

        $validated = validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'optional|email|uniqueUpdate:users,id=' . $args['user'],
        ]);

        if (!$validated) {
            return redirect('/user/edit/profile');
        }

        $updated = update('users', $validated, ['id' => getSessionUser()->id]);

        if ($updated) {
            return setMessageAndRedirect('updated_success', 'Atualizado com sucesso', '/user/edit/profile');
        }

        setMessageAndRedirect('updated_error', 'Ocorreu um erro ao atualizar', '/user/edit/profile');
    }
}