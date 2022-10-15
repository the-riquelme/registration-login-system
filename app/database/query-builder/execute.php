<?php

function execute(bool $isFetchAll = true, bool $rowCount = false)
{
    global $query;

    try {
        $connect = connectDatabase();

        if (!isset($query['sql'])) {
            throw new Exception('Precisa ter o sql para executar a query');
        }

        $prepare = $connect->prepare($query['sql']);
        $prepare->execute($query['execute'] ?? []);

        if ($rowCount) {
            $query['count'] = $prepare->rowCount();
            return $query['count'];
        }

        if ($isFetchAll) {
            return (object) [
                'count' => $query['count'] ?? $prepare->rowCount(),
                'rows' => $prepare->fetchAll()
            ];
        }

        return $prepare->fetch();
    } catch (Exception $e) {
        $error = [
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'message' => $e->getMessage(),
            'sql' => $query['sql'],
        ];

        var_dump($error);
        die();
    }
}