<?php

return [
  'POST' => [
    '/login' => 'Login@store'
  ],
  'GET' => [
    '/' => 'Home@index',
    '/user/create' => 'User@create',
    '/user/[0-9]+' => 'User@show',
    '/login' => 'Login@index',
    '/logout' => 'Login@destroy'
  ],
];