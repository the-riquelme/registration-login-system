<?php

namespace app\controllers;

class Password
{
    public function update($args)
    {
        if (!isset($args['user']) || $args['user'] != getSessionUser()->id) {
            return redirect('/');
        }

        $validated = validate([
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ], checkCsrf: true);

        if (!$validated) {
            return redirect('/user/edit/profile');
        }

        $updated = update('users', [
            'password' => $validated['password']
        ], ['id' => getSessionUser()->id]);

        if ($updated) {
            $user = getSessionUser();
            sendEmail([
                'fromName' => $_ENV['TONAME'],
                'fromEmail' => $_ENV['TOEMAIL'],
                'toName' => $user->name,
                'toEmail' => $user->email,
                'subject' => 'Senha alterada',
                'message' => 'Senha alterada com sucesso',
                'template' => 'password'
            ]);
            return setMessageAndRedirect('password_success', 'Senha alterada com sucesso', "/user/edit/profile");
        } else {
            return setMessageAndRedirect('password_error', 'Ocorreu um erro ao atualizar a senha ', "/user/edit/profile");
        }
    }
}