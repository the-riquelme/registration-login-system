<?php

namespace app\controllers;

class UserImage
{
    public function store()
    {
        $extension = getExtension($_FILES['file']['name']);
        isImage('file');
        // try {
        // } catch (\Exception $e) {
        //     setMessageAndRedirect('upload_error', $e->getMessage(), '/user/edit/profile');
        // }
    }
}