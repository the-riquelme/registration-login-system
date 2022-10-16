<?php

function paginate(string|int $perPage = 10)
{
    global $query;

    if (isset($query['limit'])) {
        throw new Exception('A paginação nao pode ser chamada com o limite');
    }

    $rowCount = execute(rowCount:true);

    $page = htmlspecialchars($_GET['page'] ?? 1);

    $query['currentPage'] = (int) $page;

    $query['pageCount'] = (int) ceil($rowCount / $perPage);

    $offset = ($page - 1) * $perPage;

    $query['paginate'] = true;

    $query['sql'] = "{$query['sql']} LIMIT {$perPage} OFFSET {$offset}";
}

function render()
{
    global $query;

    $pageCount = $query['pageCount'];
    $currentPage = $query['currentPage'];
    $maxLinks = 5;

    $links = '<ul class="pagination">';

    if ($currentPage > 1) {
        $previous = $currentPage - 1;
        $linkPage = http_build_query(array_merge($_GET, ['page' => $previous]));
        $first = http_build_query(array_merge($_GET, ['page' => 1]));
        $links .= "<li class='page-item'><a href='?{$first}' class='page-link'>Primeira</a></li>";
        $links .= "<li class='page-item'><a href='?{$linkPage}' class='page-link'>Anterior</a></li>";
    }

    for ($i = $currentPage - $maxLinks; $i <= $currentPage + $maxLinks ; $i++) {
        if ($i > 0 && $i <= $pageCount) {
            $class = $currentPage === $i ? 'active' : '';
            $linkPage = http_build_query(array_merge($_GET, ['page' => $i]));
            $links .= "<li class='page-item {$class}'><a href='?{$linkPage}' class='page-link'>{$i}</a></li>";
        }
    }

    if ($currentPage < $pageCount) {
        $next = $currentPage + 1;
        $linkPage = http_build_query(array_merge($_GET, ['page' => $next]));
        $last = http_build_query(array_merge($_GET, ['page' => $pageCount]));
        $links .= "<li class='page-item'><a href='?{$linkPage}' class='page-link'>Próxima</a></li>";
        $links .= "<li class='page-item'><a href='?{$last}' class='page-link'>Última</a></li>";
    }

    $links .= '</ul>';

    return $links;
}