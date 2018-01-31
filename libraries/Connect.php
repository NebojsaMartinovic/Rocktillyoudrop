<?php

class Connect{
    private static $_instance = null;

    private function __construct(){}

    public static function getInstance(){
        if(is_null(self::$_instance)){
            $dsn = 'mysql:host='.Config::get('DB/host').';dbname='.Config::get('DB/dbname');
            self::$_instance = new PDO($dsn,Config::get('DB/user'),Config::get('DB/pass'));
        }
        return self::$_instance;
    }
}
