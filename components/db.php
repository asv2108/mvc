<?php

class Db
{
    public static function getConnection()
    {
        $params = parse_ini_file(ROOT . '/config/config.ini');
        try {
            $db = new PDO($params['db.conn'], $params['db.user'], $params['db.pass'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            $db->exec("set names utf8");

        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
        return $db;
    }
}