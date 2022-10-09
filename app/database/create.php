<?php

function create($table, $data) {
  try {
    // if (!arrayIsAssociative($data)) {
    //     throw new Exception("O array tem que ser associativo.");
    // }

    $connect = connectDatabase();

    $sql = "INSERT INTO {$table}(";
    $sql .= implode(',', array_keys($data)) .") VALUES (";
    $sql .= ':' . implode(',:', array_keys($data)).")";

    $prepare = $connect->prepare($sql);
    return $prepare->execute($data);
  } catch (PDOException $e) {
      var_dump($e->getMessage());
  }
}