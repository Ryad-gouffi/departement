<?php

class Admins {
    private $conn;
    private $table = 'user';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function admin_data($email) {
        $sql = $this->conn->prepare("SELECT * FROM {$this->table} WHERE email = ?");
        $sql->bindParam(1, $email, PDO::PARAM_STR);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function add_admin($fullname,$email,$password,$role) {
        $sql = $this->conn->prepare("INSERT INTO {$this->table} (fullname,email,password,role) VALUES (?,?,?,?);");
        $sql->bindParam(1, $fullname, PDO::PARAM_STR);
        $sql->bindParam(2, $email, PDO::PARAM_STR);
        $sql->bindParam(3, $password, PDO::PARAM_STR);
        $sql->bindParam(4, $role, PDO::PARAM_STR);
        $sql->execute();
        return $sql->rowCount();
    }
    public function all_admins() {
        $sql = $this->conn->prepare("SELECT * FROM {$this->table}");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function all_users($role) {
        $sql = $this->conn->prepare("SELECT * FROM {$this->table} WHERE role=?");
        $sql->bindParam(1, $role, PDO::PARAM_STR);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function delete_admin($email) {
        $sql = $this->conn->prepare("DELETE FROM {$this->table} WHERE email=?");
        $sql->bindParam(1, $email, PDO::PARAM_STR);
        $sql->execute();
        return $sql->rowCount();
    }

}

?>