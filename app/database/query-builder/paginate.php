<?php

function paginate(string|int $perPage = 10)
{
    global $query;

    if (isset($query['limit'])) {
        throw new Exception('A paginação nao pode ser chamada com o limite');
    }

    $rowCount = execute(rowCount:true);

    $page = htmlspecialchars($_GET['page']);

    $page = $page ?? 1;

    $query['currentPage'] = (int) $page;

    $query['pageCount'] = (int) ceil($rowCount / $perPage);

    $offset = ($page - 1) * $perPage;

    $query['paginate'] = true;

    $query['sql'] = "{$query['sql']} LIMIT {$perPage} OFFSET {$offset}";
}