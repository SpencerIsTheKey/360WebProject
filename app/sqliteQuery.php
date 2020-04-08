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
    public function getUsernames(){
        $sql = "SELECT username FROM users";
        $stmt = $this->pdo->query();
        $results = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $results[] = [
                'username'=>$row['username'],
            ];
        }
        return $results;
    }
    public function getUserPassword(){
        $sql = "SELECT password FROM users WHERE username = :username";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":username"=>$username,
        ]);
        $results = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $results[] = [
                'password'=>$row['password'],
            ];
        }
        return $results;
    }
    public function getUserID($username){
        $sql = "SELECT user_id FROM users WHERE username = :username";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":username"=>$username,
        ]);
        $results = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $results[] = [
                'user_id'=>$row['user_id'],
            ];
        }
        return $results;
    }
    public function mainpage(){
        $sql = "SELECT blog_id, blog_name, about, cover_img FROM blogs ORDER BY hits DESC LIMIT 4";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $results = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $results[] = [
                'blog_id'=>$row['blog_id'],
                'blog_name'=>$row['blog_name'],
                'about'=>$row['about'],
                'cover_img'=>$row['cover_img'],
            ];
        }
        return $results;
    }
    public function getUserCredentials($user_id){
        $sql = "SELECT user_id, username, password FROM users WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt -> execute([
            ":user_id"=>$user_id,
        ]);
        $results = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $results[] = [
                'user_id' => $row['user_id'],
                'username' => $row['username'],
                'password' => $row['password'],
            ];
        }
        return $results;
    }
    public function getUserByUsername($username){
        $sql = "SELECT  username, password FROM users WHERE username = :username";
        $stmt = $this->pdo->prepare($sql);
        $stmt -> execute([
            ":username"=>$username,
        ]);
        $results = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $results[] = [
                'username' => $row['username'],
            ];
        }
        return $results;
    }
    public function getUserByEmail($email){
        $sql = "SELECT  username, password FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt -> execute([
            ":email"=>$email,
        ]);
        $results = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $results[] = [
                'username' => $row['username'],
            ];
        }
        return $results;
    }
    public function search($param){
        $sql = "SELECT blog_id, blog_name, about, cover_img FROM blogs WHERE blog_name LIKE :param ORDER BY hits DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":param"=>"%{$param}%",
        ]);
        $results = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $results[] = [
                'blog_id'=>$row['blog_id'],
                'blog_name'=>$row['blog_name'],
                'about'=>$row['about'],
                'cover_img'=>$row['cover_img'],
            ];
        }
        return $results;
    }
    
    
    public function articleListSearch($blog_id, $search_for, $search_column){
        $sql = "SELECT article_id, article_name, article_content, art_img FROM articles WHERE parent_blog = :blog_id AND $search_column LIKE :search_for";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":blog_id"=>$blog_id,
            ":search_for"=>"%{$search_for}%",
        ]);
        $results = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $results[] = [
                'article_id'=>$row['article_id'],
                'article_name'=>$row['article_name'],
                'article_content'=>$row['article_content'],
                'art_img'=>$row['art_img'],
            ];
        }
        return $results;
    }
    public function topPosts($blog_id){
        $sql = "SELECT article_id, article_name, hits FROM articles WHERE parent_blog = :parent_blog ORDER BY hits DESC LIMIT 3";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':parent_blog'=>$blog_id,
        ]);
        $results = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $results[] = [
                'article_id'=>$row['article_id'],
                'article_name'=>$row['article_name'],
            ];
        }
        return $results;
    }
    public function getBlogByID($blog_id){
        $sql = "SELECT blog_name, about, blog_id FROM blogs WHERE blog_id = :blog_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ":blog_id" => $blog_id,
        ]);
        $results = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $results[] = [
                'blog_name' => $row['blog_name'],
                'about' => $row['about'],
                'blog_id'=> $row['blog_id']
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
            $sql = "SELECT article_id, article_name, article_content, art_img, pub_date FROM articles WHERE parent_blog = :blog_id ORDER BY datetime(pub_date) DESC LIMIT :limit_amt";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ":blog_id" => $blog_id,
                ":limit_amt" => $limit_amt,
            ]);
        } else {
            $sql = "SELECT article_id, article_name, article_content, art_img, pub_date FROM articles WHERE parent_blog = :blog_id ORDER BY datetime(pub_date) DESC";
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

    public function getArticleComments($article_id){
        $sql = "SELECT c.comment_content, c.user_id, u.username, u.profile_img, c.comment_date, c.article_id FROM comments as c INNER JOIN users as u ON c.user_id=u.user_id WHERE c.article_id = :article_id ORDER BY datetime(c.comment_date) ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':article_id'=>$article_id,
        ]);
        $results = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $results[] = [
                'comment_content' => $row['comment_content'],
                'user_id' => $row['user_id'],
                'username' => $row['username'],
                'comment_date' => $row['comment_date'],
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