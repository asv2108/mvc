<?php

class User
{
    public static function UsersList()
    {
        $host = 'localhost';
        $dbname = 'mvc';
        $user = 'root';
        $password = '';
        $db =new PDO("mysql:$host;dbname=$dbname",$user,$password);
        $resultUsers = $db->query('SELECT id, `name` FROM users ');

    }

    public static function UserById($id)
    {

    }
}