<?php

namespace Blog;
use \PDO;

class db{

    private $pdo ;
    private $db_name, $db_host, $db_user, $db_password;

    public function __construct($dbname, $host= 'localhost', $user = 'root', $password = 'phpserver'){
        $this->pdo = new PDO('mysql:dbname='.$dbname.';host='.$host, $user, $password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->db_name = $name;
        $this->db_user = $user;
        $this->db_host = $host;
        $this->db_password = $password;
    } 

    public function query($statement, $class_name){
        $query = $this->pdo->query($statement);
        $req = $query->fetchAll(PDO::FETCH_CLASS, $class_name);
        
        return $req;;
    }
}


?>