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

function uniqueUpdate($field, $param)
{
    $email = strip_tags($_POST[$field]);

    if (!str_contains($param, '=')) {
        setFlash($field, "Esse valor já está cadastrado");
        return false;
    }

    [$fieldToCompare, $value] = explode('=', $param);

    if (!str_contains($fieldToCompare, ',')) {
        setFlash($field, "Esse valor já está cadastrado");
        return false;
    }

    $table = substr($fieldToCompare, 0, strpos($fieldToCompare, ','));
    $fieldToCompare = substr($fieldToCompare, strpos($fieldToCompare, ',') + 1);

    read($table);
    where($field, $email);
    orWhere($fieldToCompare, '!=', $value, 'and');
    $userFound = execute(isFetchAll:false);

    if ($userFound) {
        setFlash($field, "Esse valor já está cadastrado");
        return false;
    }

    return $email;
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

function confirmed($field)
{
    if (!isset($_POST[$field], $_POST[$field . '_confirmation'])) {
        setFlash($field, "Os campos para atualizar a senha são obrigatórios");
        return false;
    }

    $value = strip_tags($_POST[$field]);
    $value_confirmation = strip_tags($_POST[$field.'_confirmation']);

    if ($value !== $value_confirmation) {
        setFlash($field, "Os dois campos tem que ser iguais");
        return false;
    }

    if ($field === 'password') {
        return password_hash($value, PASSWORD_DEFAULT);
    }
    return $value;
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