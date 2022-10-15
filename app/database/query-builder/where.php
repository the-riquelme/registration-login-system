<?php

function where()
{
    global $query;

    if (isset($query['where'])) {
        throw new Exception('Verifique quantos wheres esta sendo chamado na criação da sua query');
    }

    $args = func_get_args();
    $numArgs = func_num_args();

    if (!isset($query['read'])) {
        throw new Exception('Antes de chamar o where chame o read');
    }

    if ($numArgs < 2 || $numArgs > 3) {
        throw new Exception('O where precisa de 2 ou 3 parâmetros');
    }

    if ($numArgs === 2) {
        $field = $args[0];
        $operator = '=';
        $value = $args[1];
    }

    if ($numArgs === 3) {
        $field = $args[0];
        $operator = $args[1];
        $value = $args[2];
    }

    $fieldWhere = $field;

    if (str_contains($field, '.')) {
        [, $fieldWhere] = explode('.', $field);
    }

    $query['where'] = true;
    $query['execute'] = array_merge($query['execute'], [$fieldWhere => $value]);
    $query['sql'] = "{$query['sql']} WHERE {$field} {$operator} :{$fieldWhere}";
}

function whereTwoParameters(array $args): array
{
    $field = $args[0];
    $operator = '=';
    $value = $args[1];
    $typeWhere = 'OR';

    return [$field, $operator, $value, $typeWhere];
}

function whereThreeParameters(array $args): array
{
    $operators = ['=', '<', '>', '!==', '<=', '>='];
    $field = $args[0];
    $operator = in_array($args[1], $operators) ? $args[1] : '=';
    $value = in_array($args[1], $operators) ? $args[2] : $args[1];
    $typeWhere = $args[2] === 'AND' ? 'AND' : 'OR';

    return [$field, $operator, $value, $typeWhere];
}

function orWhere()
{
    global $query;

    $args = func_get_args();
    $numArgs = func_num_args();

    if (!isset($query['read'])) {
        throw new Exception('Antes de chamar o where chame o read');
    }

    if (!isset($query['where'])) {
        throw new Exception('Antes de chamar o orWhere chame o where');
    }

    if ($numArgs < 2 || $numArgs > 4) {
        throw new Exception('O where precisa de 2 até 4 parâmetros');
    }

    $data = match ($numArgs) {
        2 => whereTwoParameters($args),
        3 => whereThreeParameters($args),
        4 => $args,
    };

    [$field, $operator, $value, $typeWhere] = $data;

    $query['where'] = true;
    $query['execute'] = array_merge($query['execute'], [$field => $value]);
    $query['sql'] = "{$query['sql']} {$typeWhere} {$field} {$operator} :{$field}";
}

function whereIn(string $field, array $data)
{
    global $query;

    if (isset($query['where'])) {
        throw new Exception('Não poder ter chamado a função where com a função where in');
    }

    $query['where'] = true;
    $query['sql'] = "{$query['sql']} WHERE {$field} IN (" . '\'' . implode('\',\'', $data) . '\'' . ')';
}