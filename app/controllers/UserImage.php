<?php

namespace app\controllers;

class UserImage
{
    public function store()
    {
        try {
            $path = upload(640, 480, 'assets/img', 'crop');
            $auth = getSessionUser();

            read('photos');
            where('user_id', $auth->id);

            $photoUser = execute(isFetchAll:false);

            if ($photoUser) {
                $updated = update('photos', [
                    'path' => $path
                ], [
                    'user_id' => $auth->id
                ]);
                @unlink($photoUser->path);
            } else {
                $updated = create('photos', [
                    'user_id' => $auth->id,
                    'path' => $path
                ]);
            }

            if ($updated) {
                $auth->path = $path;
                setMessageAndRedirect('upload_success', 'Upload feito com sucesso', '/user/edit/profile');
                return;
            }

            setMessageAndRedirect('upload_error', 'Ocorreu um erro ao fazer o upload', '/user/edit/profile');
        } catch (\Exception $e) {
            setMessageAndRedirect('upload_error', $e->getMessage(), '/user/edit/profile');
        }
    }
}