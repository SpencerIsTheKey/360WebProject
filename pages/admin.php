<?php
require "../vendor/autoload.php"; 
use App\SQLiteConnection as SQLiteConnection;
use App\SQLiteQuery as SQLiteQuery;
use App\SQLiteUpdate as SQLiteUpdate;
use App\SQLiteInsert as SQliteInsert;
use App\SQLiteDelete as SQLiteDelete;

$conn = (new SQLiteConnection())-> connect();
$query = new SQLiteQuery($conn);
$update = new SQLiteUpdate($conn);
$insert = new SQLiteInsert($conn);
$delete = new SQLiteDelete($conn);

// Define variables and initialize with empty values

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
         
   
$username = "";
$user_id = $user_ids = "";
$blog_id = "";
$article_id = "";
$comment_id = "";
if(isset($_POST['user'])){
if(!empty(trim($_POST["user"]))){
    $users = $query->getUserByUsername($_POST['user']);    
    if(empty($users)){
               echo "no user with that name exists";
            } else{
                $username = $users[0];
                $user_ids = $query->getUserID($username);
                $user_id = $user_ids[0];
                $number_deleted = $delete->deleteUser($user_id);
                if($number_deleted > 0){
                    echo "user: " . $username . " deleted.";
                }
}
//blogname
//description
    }
}
if(isset($_POST['blog'])){
if(!empty(trim($_POST["blog"]))){ 
    $blog_id = trim($_POST["blog"]);
                $number_deleted = $delete->deleteBlog($blog_id);
                if($number_deleted > 0){
                    echo "blog deleted.";
                }
   
}}
if(isset($_POST['article'])){
if(!empty(trim($_POST["article"]))){
    $article_id = trim($_POST['article']);
   
               
                $number_deleted = $delete->deleteArticle($article_id);
                if($number_deleted > 0){
                    echo "article deleted.";
                }
    $delete->deleteArticle($article_id);
}}
if(isset($_POST['comment'])){
    if(!empty(trim($_POST["comment"]))){
        $comment_id = trim($_POST['comment']); 
       
                   
                    $number_deleted = $delete->deleteComment($comment_id);
                    if($number_deleted > 0){
                        echo "comment deleted.";
                    }
        
    }}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/navbar.css">
    <link rel="stylesheet" href="../CSS/homepage.css">
    <title>Talk About Turtles</title>
    <style>
        
        #fieldset {
            padding: 1em;
            color: black;
          }
          legend {
              text-align: center;
          }

          #forming {
            background:  #f5eaea;
            padding: 0.5em;
          }
    </style>
</head>
<div id="navbar">
    <div id="logo">
        <a href="#"></a>
            <img src="../CSS/images/Turtle.png">
        </a>
    </div>
    <div id="title">
        <h1>Talk About Turtles</h1>
    </div>
    <div id="searchbar">
        <form action="./search.html">
            <input id="search" type="text" style="height: 1.5em; width: 30em;"/>
            <button type ="submit" style="background-color: #f5eaea;"><img src="../CSS/images/search.png" style="height: 1.25em; width: 1.25em;"></button>
        </form>
    </div>
    <div id="login">
        <a class="linkbutton" href="#">Login/Signup</a>
    </div>
</div>

<body>
    
<form id ="forming" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <fieldset id="fieldset">
      <legend>Administration</legend>
      <!-- Choose a user to Blacklist:
      <input type="text" name="usernameblack" placeholder="Enter a username" /> <br />
      <br /> -->
      Choose a user to ban (using user ID):
      <input type="text" name="user" placeholder="Enter the user (username) you want deleted" /><br />
      <br />
      Choose an article to remove (using article ID):
      <input type="text" name="article" placeholder="Enter article ID to delete" /> <br />
      <br />
      Choose a blog to remove (using blog ID):
      <input type="text" name="blog" placeholder="Enter blog ID to delete" /> <br />
      <br />
      Choose a comment to remove (using using comment ID):
      <input type="text" name="comment" placeholder="Enter comment ID to delete" /> <br />
      <br />

      <!-- Choose a user to whitelist:
      <input type="text" name="usernamewhite" placeholder="Enter username" /> <br />
      <br /> -->
    
     
      <input type="submit" /> <input type="reset" />
    </fieldset>
  </form>
</body>
</html>

</body>
</html>
