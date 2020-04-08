<?php 
namespace App;

class sqliteDelete{

    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function deleteUser($user_id){
        $sql = "DELETE FROM users WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":user_id"->$user_id,
        ]);

        return $stmt->rowCount();
    }
    public function deleteBlog($blog_id){
        $sql = "DELETE FROM blogs WHERE blog_id = :blog_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":blog_id"->$blog_id,
        ]);

        return $stmt->rowCount();
    }
    public function deleteArticle($article_id){
        $sql = "DELETE FROM articles WHERE article_id = :article_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":article_id"->$article_id,
        ]);

        return $stmt->rowCount();
    }
    public function deleteComment($comment_id){
        $sql = "DELETE FROM comments WHERE comment_id = :comment_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":comment_id"->$comment_id,
        ]);

        return $stmt->rowCount();
    }
}
?>