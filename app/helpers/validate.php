<?php

function required($field) {
  if ($_POST[$field] === '') {
    setFlash($field, 'O campo é obrigatório!');
    return false;
  }

  return strip_tags($_POST[$field]);
}

function validate(array $validations, bool $persistInputs = false) {
  $result = [];
  
  foreach ($validations as $field => $validate) {
    if (!str_contains($validate, '|')) {
      $result[$field] = $validate($field);
    } else {}
  }

  if (in_array(false, $result)) {
    return false;
  }

  return $result;
}