<?php
namespace App;

class sqliteQuery{
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }
    public function getAllBlogs(){
        $sql = "SELECT blog_name FROM blogs";
        $stmt = $this->pdo->query($sql);
        $results = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $results[] = $row['blog_name'];
        }
        return $results;
    }

    public function getArticleByID($article_id){
        $sql = "SELECT article_name, article_content, pub_date FROM articles WHERE article_id = :article_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":article_id" => $article_id,
        ]);
        $results = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $results[] = [
                'article_name' => $row['article_name'],
                'article_content' => $row['article_content'],
                'pub_date' => $row['pub_date'],
            ];
        }
        return $results;
    }

    public function getAllArticles(){
        $sql = "SELECT article_name FROM articles";
        $stmt = $this->pdo->query($sql);
        $results = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $results[] = $row['article_name'];
        }
        return $results;
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