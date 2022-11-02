<?php

namespace app\controllers;

class UserImage
{
    public function store()
    {
        upload(640, 480, 'assets/img');
        // try {
        // } catch (\Exception $e) {
        //     setMessageAndRedirect('upload_error', $e->getMessage(), '/user/edit/profile');
        // }
    }
}