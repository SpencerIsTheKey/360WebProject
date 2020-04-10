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
    <header> <h1> Error 400: Bad request </h1> </header>
    <h2>Something's wrong on your end...</h2>
</body>