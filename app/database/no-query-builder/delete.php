<?php

function delete($table, $where)
{
    try {
        if (array_is_list($where)) {
            throw new Exception('O array tem que ser associativo.');
        }

        $connect = connectDatabase();

        $whereField = array_keys($where);

        $sql = "DELETE FROM {$table} WHERE";
        $sql .= " {$whereField[0]} = :{$whereField[0]}";

        $prepare = $connect->prepare($sql);
        $prepare->execute($where);

        return $prepare->rowCount();
    } catch (PDOException $e) {
        var_dump($e->getMessage());
    }
}