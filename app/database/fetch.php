<?php

function fetchAll($table, $fields = '*') {
  try {
    $connerct = connectDatabase();
    
    $query = $connerct->query("SELECT {$fields} FROM {$table}");
    return $query->fetchAll();
  } catch (PDOException $e) {
    var_dump($e->getMessage());
  }
}

function findBy($table, $field, $value, $fields = '*') {
  try {
    $connerct = connectDatabase();
    
    $prepare = $connerct->prepare("SELECT {$fields} FROM {$table} WHERE {$field} = :{$field}");
    $prepare->execute([$field => $value]);
    return $prepare->fetch();
  } catch (PDOException $e) {
    var_dump($e->getMessage());
  }
}