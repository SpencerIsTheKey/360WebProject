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

$username = $password = $confirm_password = $email = "";
$username_err = $password_err = $confirm_password_err = $email_err= "";
 //reference: https://www.tutorialrepublic.com/php-tutorial/php-mysql-login-system.php?fbclid=IwAR0_2m59t2spcHoN3N7ol-AKk376a3pSmjs1L8_kwhyH1evUh0TSPdv76XE
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $users = $query->getUserByUsername($_POST['username']);    
        if(!empty($users)){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            }
            if(empty(trim($_POST["email"]))){
              $username_err = "Please enter an email";
          } else{
         
            // Prepare a select statement
            $emails = $query->getUserByEmail($_POST['email']);    
            if(!empty($emails)){
                        $email_err = "This email is already in use.";
                    } else{
                        $email = trim($_POST["email"]);
                    }
                }
            
          
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }   
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)&& empty($email_err)){       
        // Prepare an insert statement
        $param_username = $username;
        $param_email = $email;
        $param_password = password_hash($password, PASSWORD_DEFAULT); //self explanatory hash value for passwords
        $insert->insertUser($param_username, $param_password, $param_email, 0);
        header('Location: login.php');//needs fixing
    }else{

      echo "There was an error. Please try your information again.";
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
            padding: 1em;
          }
          legend {
              text-align: center;
          }

        #forming {
            background:  #f5eaea;
            padding: 0.5em;
            justify-content: center;
            text-align: center;
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
 <div id = "wrapper">  
<form id ="forming" name="myForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <fieldset id="fieldset">
      <legend>Account Creation</legend>

      
    <br>
    <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="email" id = "email" name="email" class="form-control" value="<?php echo $email; ?>" placeholder="Enter your email">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>   
        <br>
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" placeholder="Enter a user name">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>   
            <br> 
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>"placeholder="Enter a strong password">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <br>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>" >
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
            <br>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="./login.php">Login here</a>.</p>
  </form>
  </div> 
</body>
</html>

</body>
</html>



