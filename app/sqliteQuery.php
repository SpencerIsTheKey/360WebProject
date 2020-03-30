<?php
namespace App;

class sqliteQuery{
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function query($sql){
        $stmt = $this->pdo->prepare($sql);
        $results = [];
        while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            //$results[] = $row[];
        }
    }
}
?>