<?php

class ActiveRecord{
    private static $db;

    public static function get($id = 1){
        $tableName = static::$tableName;
        $keyColumn = static::$keyColumn;
        $className = get_called_class();
        $q = "SELECT * FROM {$tableName} WHERE {$keyColumn} = {$id}";
        $q = self::$db->query($q);
        $result = $q->fetchObject($className);
        return $result;
    }

    public static function getAll(){
        $tableName = static::$tableName;
        $q = "SELECT * FROM {$tableName}";
        $q = self::$db->query($q);
        $results = $q->fetchAll(PDO::FETCH_OBJ);
        return $results;
    }

    public function remove($id){
        $tableName = static::$tableName;
        $keyColumn = static::$keyColumn;
        $q = "DELETE FROM {$tableName} WHERE {$keyColumn} = {$id}";
        $q = self::$db->query($q);
    }

    public function insert(){
        $tableName = static::$tableName;
        $q = "INSERT INTO {$tableName} (";
        $vel = '';
        foreach($this as $k => $v){
            $q .= $k . ", ";
            $vel .= "'".$v."', ";
        }
        $q = rtrim($q,', ');
        $q .= ") VALUES (";
        $q .= $vel;
        $q = rtrim($q,', ');
        $q .= ")";
        $q = self::$db->query($q);
    }

    public static function update($id,$params = null){
        $tableName = static::$tableName;
        $keyColumn = static::$keyColumn;
        $q = "UPDATE {$tableName} SET ";
        $keys = array_keys($params);
        $values = array_values($params);
        //die(var_dump($keys));
        //die(var_dump($values));
        foreach($keys as $k){
            $q .= $k . " = ?, ";
        }
        $q = rtrim($q,', ');
        $q .= " WHERE {$keyColumn} = ?";
        $stmt = self::$db->prepare($q);
        $n = 1;
        foreach($values as $v){
            $stmt->bindValue($n, $v);
            $n++;
        }
        $stmt->bindValue($n,$id);
        $stmt->execute();
        //die($q);
    }


    public static function init(){
        self::$db = Connect::getInstance();
    }
}
ActiveRecord::init();









