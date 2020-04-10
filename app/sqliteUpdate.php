<?php
namespace App;

class sqliteUpdate{

    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }
    public function updateBlogImg($blog_id, $img_path){
        $sql = "UPDATE blogs SET cover_img =:img_path WHERE blog_id = :blog_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ":img_path" => $img_path,
            ":blog_id" => $blog_id,
        ]);
    }
    public function updateArticleImg($article_id, $img_path){
        $sql = "UPDATE articles SET art_img =:img_path WHERE article_id = :article_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ":img_path" => $img_path,
            ":article_id" => $article_id,
        ]);
    }
    public function updateBlogName($blog_id, $blog_name){
        $sql = "UPDATE blogs SET blog_name = :blog_name WHERE blog_id = :blog_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ":blog_name" => $blog_name,
            ":blog_id" => $blog_id,
        ]);
    }
    public function updateBlogAbout($blog_id, $about){
        $sql = "UPDATE blogs SET about = :about WHERE blog_id = :blog_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ":about" => $about,
            ":blog_id" => $blog_id,
        ]);
    }
    public function addBlogHit($blog_id){
        $sql = "UPDATE blogs SET hits = hits + 1 WHERE blog_id = :blog_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ":blog_id" => $blog_id,
        ]);
    }
    public function updateUsername($user_id, $username){
        $sql = "UPDATE users SET username = :username WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ":username" => $username,
            ":user_id" => $user_id,
        ]);
    }
    public function updateUserBlog($user_id, $blog_id){
        $sql = "UPDATE users SET blog_id = :blog_id WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ":blog_id" => $blog_id,
            ":user_id" => $user_id,
        ]);
    }
    public function updateUserImg($user_id, $profile_img){
        $sql = "UPDATE users SET profile_img = :profile_img WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ":profile_img" => $profile_img,
            ":user_id" => $user_id,
        ]);
    }
    public function makeAdmin($user_id){
        $sql = "UPDATE users SET is_admin = 1 WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ":user_id" => $user_id,
        ]);
    }
    public function revokeAdmin($user_id){
        $sql = "UPDATE users SET is_admin = 0 WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ":user_id" => $user_id,
        ]);
    }
    public function updateArticleName($article_id, $article_name){
        $sql = "UPDATE articles SET article_name = :article_name WHERE article_id = :article_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ":article_name" => $article_name,
            ":article_id" => $article_id,
        ]);
    }
    public function updateArticleContent($article_id, $article_content){
        $sql = "UPDATE articles SET article_content = :article_conent WHERE article_id = :article_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ":article_content" => $article_content,
            ":article_id" => $article_id,
        ]);
    }
    public function addArticleHit($article_id){
        $sql = "UPDATE articles SET hits = hits + 1 WHERE article_id = :article_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ":article_id" => $article_id,
        ]);
    }
    public function updateCommentContent($comment_id, $comment_content){
        $sql = "UPDATE articles SET content = :comment_conent WHERE comment_id = :comment_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ":content" => $comment_content,
            ":comment_id" => $comment_id,
        ]);
    }
    

}



?>