<?php

function getCsrf()
{
    $_SESSION['csrf'] = bin2hex(openssl_random_pseudo_bytes(8));

    return "<input name='csrf' type='hidden' value=" . $_SESSION['csrf'] . '>';
}

function checkCsrf()
{
    $csrf = htmlspecialchars($_POST['csrf']);

    if (!$csrf || !isset($_SESSION['csrf']) || $csrf !== $_SESSION['csrf']) {
        throw new Exception('Token inválido');
    }

    unset($_SESSION['csrf']);
}