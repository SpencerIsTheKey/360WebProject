<?php

namespace App;

class sqliteInsert{

    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function insertUser($username, $password, $email, $admin){
        $sql = "INSERT INTO users(username, password, email, is_admin) VALUES(:username, :password, :email, :admin)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":username" => $username,
            ":password" => $password,
            ":email" => $email,
            ":admin" => $admin,
        ]);

        return $this->pdo->lastInsertId();
    }
    public function insertBlog($blog_name, $about){
        $sql = "INSERT INTO blogs(blog_name, about, hits) VALUES(:blog_name, :about, 0)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":blog_name" => $blog_name,
            ":about" => $about,
        ]);

        return $this->pdo->lastInsertId();
    }
    public function insertArticle($article_name, $parent_blog, $article_content){
        $article_content = str_replace("\n", "<br>", $article_content);

        $sql = "INSERT INTO articles(article_name, parent_blog, article_content, pub_date, hits) VALUES(:article_name, :parent_blog, :article_content, :pub_date, 0)";
        $stmt = $this->pdo->prepare($sql);

        $date = getdate();
        $datestring = "$date[year]-$date[mon]-$date[mday] " . date("h:i");

        $stmt->execute([
            ":article_name" => $article_name,
            ":parent_blog" => $parent_blog,
            ":article_content" => $article_content,
            ":pub_date" => $datestring,
        ]);
        
        return $this->pdo->lastInsertId();
    }
    public function insertComment($article_id, $user_id, $comment_content){
        $sql = "INSERT INTO comments( article_id, user_id, comment_content, comment_date) VALUES(:article_id, :user_id, :comment_content, :comment_date)";
        $stmt = $this->pdo->prepare($sql);

        $date = getdate();
        $datestring = "$date[year]-$date[mon]-$date[mday] " . date("h:i");

        $stmt->execute([
            ":article_id" => $article_id,
            ":user_id" => $user_id,
            ":comment_content" => $comment_content,
            ":comment_date" => $datestring,
        ]);

        return $this->pdo->lastInsertId();
    }



}
?>