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
  //blogname
  //description
  $blogname = trim($_POST["blogname"]);
  $description = trim($_POST["description"]);
      
        $insert->insertBlog($blog_name, $description);
        header('Location: blog.php');
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
            background: #f5eaea;
            padding: 0.5em;
          }
    </style>
    <script>
        //reference: https://www.w3schools.com/js/js_validation.asp
        function validateForm() {
          var x = document.forms["myForm"]["blogname"].value;
          if (x == "") {
            alert("Blog Name must be filled out");
            return false;
          }
          var y = document.forms["myForm"]["description"].value;
          if (y == "") {
            alert("Your blog must have a description");
            return false;
          }
        }
        </script>
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
    
<form id ="forming" name="myForm" method="post" onsubmit="return validateForm()" action="http://www.randyconnolly.com/tests/process.php">
    <fieldset id="fieldset">
      <legend>Blog Creation</legend>
      Blog Name:
      <input type="text" name="blogname" placeholder="Enter the name for your blog" /> <br />
      <br />
      Choose a profile image:
      <input type="file"
      id="avatar" name="avatar"
      accept="image/png, image/jpeg">
      <br />
      Describe your blog here:<br>
   <textarea id = "description" rows ="4" cols = "50"></textarea>
     <br>
      <input type="submit" /> <input type="reset" />
    </fieldset>
  </form>
</body>
</html>

</body>
</html>
