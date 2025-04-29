<?php

class Demandes {
    private $conn;
    private $table = 'demandes';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function demande_data_foreign_key($foreignkey) {
        $sql = $this->conn->prepare("SELECT * FROM $this->table WHERE foreign_key = ?;");
        $sql->bindParam(1, $foreignkey, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    public function insert_demand($typefichier,$addon,$email,$numerotlfn,$descriptions,$urgent,$urgentdate,$statu,$foreign_key) {
        $sql = $this->conn->prepare("INSERT INTO demandes(typefichier,addon,email,numerotlfn,descriptions,urgent,urgentdate,statu,foreign_key) VALUES (?,?,?,?,?,?,?,?,?);");
        $sql->bindParam(1,$typefichier,PDO::PARAM_STR);
        $sql->bindParam(2,$addon,PDO::PARAM_STR);
        $sql->bindParam(3,$email,PDO::PARAM_STR);
        $sql->bindParam(4,$numerotlfn,PDO::PARAM_STR);
        $sql->bindParam(5,$descriptions,PDO::PARAM_STR);
        $sql->bindParam(6,$urgent,PDO::PARAM_BOOL);
        $sql->bindParam(7,$urgentdate,PDO::PARAM_STR);
        $sql->bindParam(8,$statu,PDO::PARAM_STR);
        $sql->bindParam(9,$foreign_key,PDO::PARAM_INT);
        $sql->execute();
        return $sql->rowCount();
    }
    
    public function all_demandes($level) {
        
        $query = "SELECT 
        user_table.matricule,
        user_table.name,
        user_table.surname,
        demandes.id,
        demandes.typefichier,
        demandes.addon,
        demandes.email,
        demandes.numerotlfn,
        demandes.observation,
        demandes.urgentdate,
        demandes.statu
        FROM user_table 
        JOIN demandes ON user_table.matricule = demandes.foreign_key";

        if ($level != 0) {
        $query .= " WHERE user_table.styear = ?";
        }

        $sql = $this->conn->prepare($query);

        if ($level != 0) {
            $sql->bindParam(1, $level, PDO::PARAM_INT);
        }

        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}

?>