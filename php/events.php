<?php

class Events {
    private $conn;
    private $table = 'events';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function get_events() {
        $sql = $this->conn->prepare("SELECT * FROM {$this->table} ORDER BY id desc;");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function get_event($id) {
        $sql = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id=?;");
        $sql->bindParam(1,$id,PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetch();
        return $result;
    }
    public function add_event($title,$content,$imgpath) {
        $date = date('Y-m-d');
        $sql = $this->conn->prepare("INSERT INTO {$this->table}(event_title,event_content,image_path,event_date) VALUES(?,?,?,?);");
        $sql->execute([$title,$content,$imgpath,$date]);
        return $sql->rowCount();
    }
}

?>