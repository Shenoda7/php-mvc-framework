<?php

namespace app\core\db;

use app\core\Application;
use app\core\Model;

abstract class DbModel extends Model
{
    abstract public static function tableName(): string;

    abstract public function attributes(): array;

    abstract public static function primaryKey(): string;

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();

        //now lets bind them
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $sql = "INSERT INTO $tableName (" . implode(",", $attributes) . ") VALUES (" . implode(",", $params) . ");";
        $statement = self::prepare($sql);

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }  

        $statement->execute();
        return true;
    }

    public static function findOne($where) {
        $tableName = static::tableName();
        $attributes = array_keys($where);

        $params = array_map(fn($attr) => "$attr = :$attr", $attributes);
        $sql = "SELECT * FROM $tableName WHERE " . implode(" AND ", $params);
        $stmt = self::prepare($sql);

        foreach ($where as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }
        $stmt->execute();
        return $stmt->fetchObject(static::class);
    }

    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }
}