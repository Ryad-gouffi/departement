<?php

class User {
    private $conn;
    private $table = 'user_table';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function user_data($matricule) {
        $sql = $this->conn->prepare("SELECT * FROM {$this->table} WHERE matricule = ?");
        $sql->bindParam(1, $matricule, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function add_user($matricule,$password,$name,$surname,$styear) {
        $sql = $this->conn->prepare("INSERT INTO {$this->table}(matricule,password,name,surname,styear) VALUES (?,?,?,?,?)");
        $sql->bindParam(1, $matricule, PDO::PARAM_INT);
        $sql->bindParam(2, $password, PDO::PARAM_STR);
        $sql->bindParam(3, $name, PDO::PARAM_STR);
        $sql->bindParam(4, $surname, PDO::PARAM_STR);
        $sql->bindParam(5, $styear, PDO::PARAM_INT);
        $sql->execute();
        return $sql->rowCount();
    }
}

?>