<?php

class Events {
    private $conn;
    private $table = 'events';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function get_events() {
        $sql = $this->conn->prepare("SELECT * FROM {$this->table};");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}

?>