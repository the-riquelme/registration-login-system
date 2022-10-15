<?php

function search(array $search)
{
    global $query;

    if (isset($query['where'])) {
        throw new Exception('Não pode chamar o where na busca');
    }

    if (array_is_list($search)) {
        throw new Exception('Na busca o array tem que ser associativo');
    }

    $sql = "{$query['sql']} WHERE ";

    $execute = [];
    foreach ($search as $field => $searched) {
        $sql .= "{$field} LIKE :{$field} OR  ";
        $execute[$field] = "%{$searched}%";
    }

    $sql = rtrim($sql, ' OR ');

    $query['sql'] = $sql;
    $query['execute'] = $execute;
}