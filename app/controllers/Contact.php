<?php

namespace app\controllers;

use stdClass;

class Contact
{
    public function index()
    {
        return [
            'view' => 'contact',
            'data' => ['title' => 'Contact']
        ];
    }

    public function store()
    {
        $validated = validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ], checkCsrf:true);

        if (!$validated) {
            return redirect('/contact');
        }

        $sent = sendEmail([
            'fromName' => $validated['name'],
            'fromEmail' => $validated['email'],
            'toName' => $_ENV['TONAME'],
            'toEmail' => $_ENV['TOEMAIL'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'template' => 'contact'
        ]);
    }
}