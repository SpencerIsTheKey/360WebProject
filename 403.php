<?php

?>
<!Doctype HTML>

<html>

<head>
    <title>Talk About Turtles</title>
    <link rel="stylesheet" href="./CSS/navbar.css">
    <link rel="stylesheet" href="./CSS/search.css">
</head>

<div id="navbar">
    <div id="logo">
        <a href="./main.php"></a>
            <img src="./CSS/images/Turtle.png">
        </a>
    </div>
    <div id="title">
        <h1>Talk About Turtles</h1>
    </div>
    <div id="searchbar">
        <form action="./search.php" method="POST">
            <input id="searchfield" name="search" type="text"/>
            <button type ="submit" id="searchbtn"><img id="searchimg" src="./CSS/images/search.png"></button>
        </form>
    </div>
    <div id="login">
        <?php if (empty(isLoggedIn())){ ?>
            <a class="linkbutton" href="./pages/login.php">Login/Signup</a>
        <?php } else { ?>
            <form action="./pages/accountManage.php" method="POST">
                <input type="hidden" name="logged_in" value="<?php echo isLoggedIn();?>"/>
                <button type="submit" class="linkbutton">Manage Account</button>
            </form>
        <?php } ?>
    </div>
</div>

<body>
    <header> <h1> Error 403: Forbidden </h1> </header>
    <h2>Sorry, you're not allowed there!</h2>
</body>