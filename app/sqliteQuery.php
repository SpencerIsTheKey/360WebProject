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

    public function getBlogByID($blog_id){
        $sql = "SELECT blog_name, about FROM blogs WHERE blog_id = :blog_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":blog_id" => $blog_id,
        ]);
        $results = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $results[] = [
                'blog_name' => $row['blog_name'],
                'about' => $row['about'],
            ];
        }
        return $results;
    }

    public function getArticleByID($article_id){
        $sql = "SELECT article_name, article_content, pub_date, parent_blog FROM articles WHERE article_id = :article_id";
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
                'parent_blog' => $row['parent_blog'],
            ];
        }
        return $results;
    }

    public function getParentBlogName($parent_blog_id){
        $sql = "SELECT blog_name FROM blogs WHERE blog_id = :parent_blog_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":parent_blog_id" => $parent_blog_id,
        ]);
        return $stmt->fetchColumn();
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

    public function getArticlesFromBlog($blog_id, $YNLimit, $limit_amt){

        $sql;
        $stmt;

        if($YNLimit){
            $sql = "SELECT article_id, article_name, article_content, art_img, pub_date FROM articles WHERE parent_blog = :blog_id ORDER BY date(pub_date) DESC LIMIT :limit_amt";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":blog_id" => $blog_id,
                ":limit_amt" => $limit_amt,
            ]);
        } else {
            $sql = "SELECT article_id, article_name, article_content, art_img, pub_date FROM articles WHERE parent_blog = :blog_id ORDER BY date(pub_date) DESC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":blog_id" => $blog_id,
            ]);
        }
        $results = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $results[] = [
                'article_id' => $row['article_id'],
                'article_name' => $row['article_name'],
                'article_content' => $row['article_content'],
                'art_img' => $row['art_img'],
            ];
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