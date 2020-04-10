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
// Initialize the session
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
session_start();

function isLoggedIn(){
    
    if(isset($_SESSION['logged_in'])){  //if the logged_in key exists
        return $_SESSION['logged_in'];      //return the value stored inside

    } else {                        //if the logged_in key does not exist
        $_SESSION['logged_in'] = "";    //set as empty string
        return "";                      //return an empty string
    }
}


 

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $hashed_password = $query->getUserPassword($username);
        $id = $query->getUserID($username)[0]['user_id'];
        if(!empty($hashed_password)){
                    $hash = $hashed_password[0]['password'];
                   
                        if(password_verify($password, $hash)){
                            // Password is correct, so start a new session
                            session_start();
                            $_SESSION["logged_in"] = $id;
                          
                            $_SESSION["username"] = $username;                            
                            
                            
                            header("location: main.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
               } 
            }else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        
        
        
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
            color: black;
            padding: 3em;
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
    <div id="wrapper">
<form id ="forming" name="myForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <fieldset id="fieldset">
      <legend>Login</legend>

      
      <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>   
            <br> 
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <br>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="./accountCreate.php">Sign up now</a>.</p>
  </form>
  </div>
</body>
</html>

</body>
</html>
