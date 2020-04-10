<?php
session_start();
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
$article_id = "";
  $user=$_SESSION['username'];
  $user_ids = $query->getUserID($user);
  if(!empty($user_ids)){
  $user_id = $user_ids[0]['user_id'];
  //blogname
  //description

  $article_name= trim($_POST["articletitle"]);
  $article_content = trim($_POST["content"]);
  $parent_blog = $query->getUserBlog($user_id);
      
  $article_id = $insert->insertArticle($article_name, $parent_blog, $article_content); //put the blog id in the $parent_blog


              echo "Article " .$article_name . " created!";
              // header('Location: blog.php');


         //reference: https://www.w3schools.com/php/php_file_upload.asp?fbclid=IwAR0e9PACag0wZ_azGC9gjEYun27THoWOMt5OORmb9diMT22X48m5nGg2vKs
         $target_dir = "./uploads/";
         $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
         $uploadOk = 1;
         $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
         // Check if image file is a actual image or fake image
         if(isset($_POST["submit"])) {
             $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
             if($check !== false) {
                 echo "File is an image - " . $check["mime"] . ".";
                 $uploadOk = 1;
             } else {
                 echo "File is not an image.";
                 $uploadOk = 0;
             }
         }
         // Check if file already exists
         if (file_exists($target_file)) {
             echo "Sorry, file already exists.";
             $uploadOk = 0;
         }
         // Check file size
         if ($_FILES["fileToUpload"]["size"] > 500000) {
             echo "Sorry, your file is too large.";
             $uploadOk = 0;
         }
         // Allow certain file formats
         if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
         && $imageFileType != "gif" ) {
             echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
             $uploadOk = 0;
         }
         // Check if $uploadOk is set to 0 by an error
         if ($uploadOk == 0) {
             echo "Sorry, your file was not uploaded.";
         // if everything is ok, try to upload file
         } else {
             if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                 echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                 header("location: articleList.php");
             } else {
                 echo "Sorry, there was an error uploading your file.";
             }
         }
         $update->updateArticleImg($article_id, $target_file);
}}        
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
          .form-control{
         
         margin-left: 2rem;
            margin-right: 1rem;
            float: right;
      }
      #wrapper{
          text-align: center;
          margin-top: 3rem;
         
      }
    </style>
    <script>
        function validateForm() {
          var x = document.forms["myForm"]["articletitle"].value;
          if (x == "") {
            alert("There must be a title");
            return false;
          }
          var y = document.forms["myForm"]["content"].value;
          if (y == "") {
            alert("An article needs content");
            return false;
          }
        
        }
        </script>
</head>
<div id="navbar">
        <div id="logo">
            <form action="./main.php" method="GET">
                <div id=logo_btn>
                    <input type="image" src="../CSS/images/Turtle.png" alt="Main" width="75" height="75">
                </div>
            </form>
        </div>
        <div id="title">
            <h1>Talk About Turtles</h1>
        </div>
        <div id="searchbar">
            <form action="./search.php" method="POST">
                <input id="searchfield" name="search" type="text"/>
                <button type ="submit" id="searchbtn"><img id="searchimg" src="../CSS/images/search.png"></button>
            </form>
        </div>
        <div id="login">
            <?php if (empty(isLoggedIn())){ ?>
                <form action="./login.php" method="GET">
                    <button type="submit" class="linkbutton">Login/Signup</button>
                </form>

            <?php } else if($query->isAdmin(isLoggedIn())) { ?>
                <form action="./blogCreate.php" method="GET">
                    <button type="submit" class="linkbutton">Create Blog</button>
                </form>
                <form action="./admin.php" method="GET">
                    <button type="submit" class="linkbutton">Admin Page</button>
                </form>
                <form action="./logout.php" method="GET">
                    <button type="submit" class="linkbutton">Logout</button>
                </form>
            <?php } else if(empty($query->getUserBlog(isLoggedIn()))) { ?>
                <form action="./blogCreate.php" method="GET">
                    <button type="submit" class="linkbutton">Create Blog</button>
                </form>
                <form action="./logout.php" method="GET">
                    <button type="submit" class="linkbutton">Logout</button>
                </form>
            <?php } else { ?>
                <form action="./articleCreate.php" method="GET">
                    <button type="submit" class="linkbutton">Create Article</button>
                </form>
                <form action="./logout.php" method="GET">
                    <button type="submit" class="linkbutton">Logout</button>
                </form>
            <?php } ?>
        </div>
    </div>
<body>
    <div id = "wrapper">
<form id="forming" name="myForm" onsubmit="return validateForm()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <fieldset id="fieldset">
      <legend>Article Creation</legend>
      Article Title:
      <input type="text"  class = "form-control" name="articletitle" placeholder="Enter an article title" /> <br />
      <br />
      <input type="file" class = "form-control"
      id="fileToUpload" name="fileToUpload"
      accept="image/png, image/jpeg">
      <br>
      Enter the content of your article:<br>
      <textarea name = "content" rows ="50" cols = "60"></textarea>
     <br>
      <input type="submit" class = "form-control" value = "Submit" /> <input type="reset" />
    </fieldset>
  </form>
  </div>
</body>
</html>

</body>
</html>
