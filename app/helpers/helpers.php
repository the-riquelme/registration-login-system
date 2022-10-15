<?php

function isAjax()
{
    return isset($_SERVER['HTTP_HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
}

function dieDump($data)
{
    if ($_ENV['PRODUCTION'] === 'true') {
        var_dump('Something get wrong');
        die();
    }

    var_dump($data);
    die();
}