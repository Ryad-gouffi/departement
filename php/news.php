<?php

class News {
    private $conn;
    private $table = 'news';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function get_news() {
        $sql = $this->conn->prepare("SELECT * FROM {$this->table};");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}

?>