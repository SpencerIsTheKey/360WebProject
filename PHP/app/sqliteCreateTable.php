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
                about TEXT
                )",
            "CREATE TABLE IF NOT EXISTS users(
                user_id INTEGER PRIMARY KEY,
                blog_id INTEGER,
                is_admin INTEGER NOT NULL,
                FOREIGN KEY (blog_id)
                REFERENCES blogs(blog_id) ON UPDATE CASCADE
                                          ON DELETE CASCADE
                )",
            "CREATE TABLE IF NOT EXISTS articles(
                article_id INTEGER PRIMARY KEY,
                parent_blog INTEGER NOT NULL,
                article_content TEXT,
                FOREIGN KEY (parent_blog)
                REFERENCES blogs(blog_id) ON UPDATE CASCADE
                                          ON DELETE CASCADE
                )",
            "CREATE TABLE IF NOT EXISTS comments(
                comment_id INTEGER PRIMARY KEY,
                replied_to INTEGER,
                article_id INTEGER NOT NULL,
                user_id INTEGER NOT NULL,
                content TEXT,
                FOREIGN KEY (replied_to)
                REFERENCES comments(comment_id) ON UPDATE CASCADE
                                                ON DELETE CASCADE,
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