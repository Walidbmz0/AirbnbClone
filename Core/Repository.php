<?php

namespace Core;


use Core\Database\Database;
use Core\Database\DatabaseConfigInterface;

abstract class Repository
{
    protected \PDO $pdo;

    abstract public function getTableName():string;

    public function __construct(DatabaseConfigInterface $config)
    {
        $this->pdo = Database::getPDO($config);
    }

    protected function readAll(string $class_name): array
    {
        $arr_result = [];
        $q = sprintf('SELECT * FROM `%s`', $this->getTableName());
        $stmt = $this->pdo->query($q);

        if(!$stmt) return $arr_result;

        while($row_data = $stmt->fetch()) $arr_result[] = new $class_name($row_data);

        return $arr_result;
    }

    protected function readById(string $class_name, int $id): ?Model
    {
        $q = sprintf(
            'SELECT * FROM `%s` WHERE id=:id',
            $this->getTableName()
        );

        $stmt = $this->pdo->prepare($q);

        if(!$stmt) return null;

        $stmt->execute(['id' => $id]);

        $row_data = $stmt->fetch();

        return !empty($row_data) ? new $class_name($row_data) : null;
        //return empty($row_data) ? null :  new $class_name($row_data);

    }

}