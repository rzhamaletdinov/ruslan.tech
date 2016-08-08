<?php

final class db
{
    protected static $_instance;

    private function __clone(){
    }

    private function __construct(){
    }

    private static function _init()
    {
        $host   = Config::MYSQL_HOST;
        $dbName = Config::MYSQL_DB;
        $encode = Config::MYSQL_ENCODE;

        return new PDO(
            "mysql:host=$host;dbname=$dbName",
            Config::MYSQL_USER,
            Config::MYSQL_PASS,
            [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES '$encode'"]
        );
    }

    public static function connect() {
        if (null === self::$_instance) {
            self::$_instance = self::_init();
        }
        return self::$_instance;
    }

    public static function close()
    {
        if(self::$_instance)
            self::$_instance = null;
    }
}

function db()
{
    return db::connect();
}