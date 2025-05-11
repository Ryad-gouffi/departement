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

    public function get_news($level) {
        $param = "% $level %";
        if($level=="all"){
            $sql = $this->conn->prepare("SELECT news.*,user.fullname,user.email,user.role,user.id as userid
                                    FROM news 
                                    JOIN user ON user.id = news.news_publisher
                                    ORDER BY news.id DESC");
        $sql->execute();
        }
        else{
            $sql = $this->conn->prepare("SELECT news.*,user.fullname,user.email,user.role,user.id as userid
                                    FROM news 
                                    JOIN user ON user.id = news.news_publisher 
                                    WHERE CONCAT(' ', target_level, ' ') LIKE ? OR target_level LIKE '%all%'
                                    ORDER BY news.id DESC");
        $sql->execute([$param]);
        }
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function add_news($content,$author,$level) {
        $date = date('Y-m-d');
        $sql = $this->conn->prepare("INSERT INTO {$this->table}(target_level,news_content,news_date_posted,news_publisher) VALUES(?,?,?,?);");
        $sql->execute([$level,$content,$date,$author]);
        return $sql->rowCount();
    }
    public function delete_news($id) {
        $sql = $this->conn->prepare("DELETE FROM {$this->table} WHERE id=?");
        $sql->bindParam(1, $id, PDO::PARAM_STR);
        $sql->execute();
        return $sql->rowCount();
    }

}

?>