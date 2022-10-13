<?php

function update($table, $fields, $where)
{
    try {
        if (array_is_list($fields) || array_is_list($where)) {
            throw new Exception('O array tem que ser associativo.');
        }

        $connect = connectDatabase();

        $sql = "UPDATE {$table} SET ";
        foreach (array_keys($fields) as $field) {
            $sql .= "{$field} = :{$field}, ";
        }
        $sql = trim($sql, ', ');

        $whereFields = array_keys($where);
        $sql .= " WHERE {$whereFields[0]} = :{$whereFields[0]}";

        $data = array_merge($fields, $where);

        $prepare = $connect->prepare($sql);
        $prepare->execute($data);

        return $prepare->rowCount();
    } catch (PDOException $e) {
        var_dump($e->getMessage());
    }
}