<?php

namespace App;

class sqliteInsert{

    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function insertUser($username, $admin){
        $sql = "INSERT INTO users(username, is_admin) VALUES(:username, :admin)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":username" => $username,
            ":admin" => $admin,
        ]);

        return $this->pdo->lastInsertId();
    }
    public function insertBlog($blog_name, $about){
        $sql = "INSERT INTO blogs(blog_name, about) VALUES(:blog_name, :about)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":blog_name" => $blog_name,
            ":about" => $about,
        ]);

        return $this->pdo->lastInsertId();
    }
    public function insertArticle($article_name, $parent_blog, $article_content){
        $sql = "INSERT INTO articles(article_name, parent_blog, article_content) VALUES(:article_name, :parent_blog, :article_content)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":article_name" => $article_name,
            ":parent_blog" => $parent_blog,
            ":article_content" => $article_content,
        ]);
        
        return $this->pdo->lastInsertId();
    }
    public function insertComment($replied_to, $article_id, $user_id, $content){
        $sql = "INSERT INTO comments(replied_to, article_id, user_id, content) VALUES(:replied_to, :article_id, :user_id, :content)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":article_name" => $article_name,
            ":parent_blog" => $parent_blog,
            ":article_content" => $article_content,
        ]);

        return $this->pdo->lastInsertId();
    }



}
?>