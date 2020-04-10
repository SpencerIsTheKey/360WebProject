<?php 
namespace App;

class sqliteCreateTable{

    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }
    public function createTables(){
        $commands = [
            "CREATE TABLE IF NOT EXISTS blogs(
                blog_id INTEGER PRIMARY KEY,
                blog_name TEXT NOT NULL,
                hits INTEGER,
                cover_img TEXT,
                about TEXT
                )",
            "CREATE TABLE IF NOT EXISTS users(
                user_id INTEGER PRIMARY KEY,
                username TEXT NOT NULL,
                password TEXT NOT NULL,
                email TEXT NOT NULL,
                blog_id INTEGER,
                is_admin INTEGER NOT NULL,
                FOREIGN KEY (blog_id)
                REFERENCES blogs(blog_id) ON UPDATE CASCADE
                                          ON DELETE CASCADE
                )",
            "CREATE TABLE IF NOT EXISTS articles(
                article_id INTEGER PRIMARY KEY,
                article_name TEXT NOT NULL,
                parent_blog INTEGER NOT NULL,
                article_content TEXT,
                pub_date TEXT,
                hits INTEGER,
                art_img TEXT,
                FOREIGN KEY (parent_blog)
                REFERENCES blogs(blog_id) ON UPDATE CASCADE
                                          ON DELETE CASCADE
                )",
            "CREATE TABLE IF NOT EXISTS comments(
                comment_id INTEGER PRIMARY KEY,
                article_id INTEGER NOT NULL,
                user_id INTEGER NOT NULL,
                comment_content TEXT,
                comment_date TEXT,
                FOREIGN KEY (article_id)
                REFERENCES articles(article_id) ON UPDATE CASCADE
                                                ON DELETE CASCADE,
                FOREIGN KEY (user_id)
                REFERENCES users(user_id) ON UPDATE CASCADE
                                          ON DELETE CASCADE
                )"
            ];
    
        foreach($commands as $command){
            $this->pdo->exec($command);
        }
    }
    public function getTableList(){
        $stmt = $this->pdo->query("
                SELECT name
                FROM sqlite_master
                WHERE type = 'table'
                ORDER BY name
        ");
        $tables = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $tables[] = $row['name'];
        }
        return $tables;
    }
}
?>