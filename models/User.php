<?php
/**
 * Class User
 */
class User
{
    /**
     * @var PDO
     */
    private $db;

    /**
     * preparing work with db
     * 
     * User constructor.
     */
    public function __construct()
    {
        $host = 'localhost';
        $db = 'mvc';
        $user = 'root';
        $password = '';
        try {
            $this->db = new PDO("mysql:$host;dbname=$db",$user,$password);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * get list of users
     * 
     * @return mixed
     */
    public function UsersList()
    {
        $res = '';
        try {
            $resultUsers = $this->db->query('SELECT id, `name` FROM users ');
            echo "<pre>";
            var_dump($resultUsers);
            exit;
            $res = $resultUsers->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        return $res;
    }

    /**
     * @param $id
     */
    public static function UserById($id)
    {

    }
}