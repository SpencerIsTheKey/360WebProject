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
$user=$_SESSION['username'];
$user_ids = $query->getUserID($user);
$user_id = $user_ids[0];
//blogname
//description

if(empty(trim($_POST["blog"]))){
    $password_err = "Please enter a password.";   
}
$insert->insertArticle($article_name, $parent_blog, $article_content); //put the blog id in the $parent_blog
$delete->deleteUser($user_id);
$delete->deleteBlog($blog_id);
$delete->deleteArticle($article_id);
$delete->deleteComment($comment_id);



            echo "Content Deleted!";
            // header('Location: blog.php');
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
      <input type="text" name="user" placeholder="Enter user ID" /> <br />
      <br />
      Choose an article to remove (using article ID):
      <input type="text" name="article" placeholder="Enter article ID" /> <br />
      <br />
      Choose a blog to remove (using blog ID):
      <input type="text" name="blog" placeholder="Enter article ID" /> <br />
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
