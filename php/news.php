<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class News {
    private $conn;
    private $table = 'news';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function get_news() {
        $sql = $this->conn->prepare("SELECT * FROM {$this->table} join user on user.id = {$this->table}.news_publisher  ORDER BY {$this->table}.id desc;");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function add_news($content,$author,$level=0) {
        $date = date('Y-m-d');
        $sql = $this->conn->prepare("INSERT INTO {$this->table}(target_level,news_content,news_date_posted,news_publisher) VALUES(?,?,?,?);");
        $sql->execute([$level,$content,$date,$author]);
        return $sql->rowCount();
    }

}

?>