<?php

use Doctrine\Inflector\InflectorFactory;

function fieldFK(string $table, string $field)
{
    $inflector = InflectorFactory::create()->build();
    $tableToSingular = $inflector->singularize($table);

    return $tableToSingular . '_' . $field;
}

function tableJoin(string $table, string $fieldFK, string $typeJoin = 'INNER')
{
    global $query;

    if (isset($query['where'])) {
        throw new Exception('Nao posso colocar o where antes do join');
    }

    $fkToJoin = fieldFK($query['table'], $fieldFK);

    $query['sql'] = "{$query['sql']} {$typeJoin} JOIN {$table} ON {$table}.{$fkToJoin} = {$query['table']}.{$fieldFK}";
}

function tableJoinWithFK(string $table, string $fieldFK, string $typeJoin = 'INNER')
{
    global $query;

    if (isset($query['where'])) {
        throw new Exception('Nao posso colocar o where antes do join');
    }

    $fkToJoin = fieldFK($table, $fieldFK);

    $query['sql'] = "{$query['sql']} {$typeJoin} JOIN {$table} ON {$table}.{$fieldFK} = {$query['table']}.{$fkToJoin}";
}