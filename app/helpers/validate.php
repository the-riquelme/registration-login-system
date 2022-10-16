<?php

function required($field)
{
    if ($_POST[$field] === '') {
        setFlash($field, 'O campo é obrigatório!');
        return false;
    }

    return strip_tags($_POST[$field]);
}

function email($field)
{
    $emailIsValid = filter_input(INPUT_POST, $field, FILTER_VALIDATE_EMAIL);

    if (!$emailIsValid) {
        setFlash($field, 'O campo tem que ser um email válido');
        return false;
    }

    return strip_tags($_POST[$field]);
}

function unique($field, $param)
{
    $data = strip_tags($_POST[$field]);
    $user = findBy($param, $field, $data);

    if ($user) {
        setFlash($field, 'Esse valor já está cadastrado');
        return false;
    }

    return $data;
}

function maxlen($field, $param)
{
    $data = strip_tags($_POST[$field]);

    if (strlen($data) > $param) {
        setFlash($field, "Esse campo não pode passar de {$param} caracteres");
        return false;
    }

    return $data;
}

function optional($field)
{
    $data = strip_tags($_POST[$field]);

    if ($data === '') {
        return null;
    }

    return $data;
}

function singleValidation($validate, $field, $param)
{
    if (str_contains($validate, ':')) {
        [$validate, $param] = explode(':', $validate);
    }

    return $validate($field, $param);
}

function multipleValidations($validate, $field, $param)
{
    $explodePipeValidate = explode('|', $validate);
    $result = [];

    foreach ($explodePipeValidate as $validate) {
        if (str_contains($validate, ':')) {
            [$validate, $param] = explode(':', $validate);
        }

        $result[$field] = $validate($field, $param);

        if ($result[$field] === false || $result[$field] === null) {
            break;
        }
    }

    return $result[$field] ;
}

function validate(array $validations, bool $persistInput = false, bool $checkCsrf = false)
{
    if ($checkCsrf) {
        checkCsrf();
    }

    $result = [];
    $param = '';

    foreach ($validations as $field => $validate) {
        $result[$field] = (!str_contains($validate, '|')) ?
          singleValidation($validate, $field, $param) :
          multipleValidations($validate, $field, $param);
    }

    if ($persistInput) {
        setOld();
    }

    if (in_array(false, $result, true)) {
        return false;
    }

    return $result;
}