<?php

    function isLoggedIn(){
        
        if(isset($_POST['logged_in'])){  //if the logged_in key exists
            return $_POST['logged_in'];      //return the value stored inside

        } else {                        //if the logged_in key does not exist
            return "";                      //return an empty string
        }
    }

    require "../vendor/autoload.php"; 
    use App\SQLiteConnection as SQLiteConnection;
    use App\SQLiteQuery as SQLiteQuery;

    $conn = (new SQLiteConnection())-> connect();
    $query = new SQLiteQuery($conn);

    $blogs = [];

    if(empty($_POST)){
        $blogs = $query->search(" ");
    } else {
        $blogs = $query->search($_POST['search']);
    }
?>

<!Doctype HTML>

<html>
    <head>
        <title>Talk About Turtles</title>
        <link rel="stylesheet" href="../CSS/navbar.css">
        <link rel="stylesheet" href="../CSS/search.css">
    </head>

    <div id="navbar">
        <div id="logo">
            <a href="./main.php"></a>
                <img src="../CSS/images/Turtle.png">
            </a>
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
                <a class="linkbutton" href="./login.php">Login/Signup</a>
            <?php } else { ?>
                <form action="./accountManage.php" method="POST">
                    <input type="hidden" name="logged_in" value="<?php echo isLoggedIn();?>"/>
                    <button type="submit" class="linkbutton">Manage Account</button>
                </form>
            <?php } ?>
        </div>
    </div>

    <body>
        <div id="main">
            <h1>Search Results: <?php echo sizeof($blogs) ?> blogs found!</h1>
            <br>
            <?php foreach($blogs as $blog) : ?>
            <div class="recentPost">
                <figure>
                    <img src="<?php echo $blog['cover_img'] ?>" alt="Blog Photo">
                </figure>
                <div>
                    <h2><?php echo $blog['blog_name'] ?></h2>
                    <p>
                        <?php echo $blog['about'] ?>
                    </p>
                    <div class="right">
                        <form action="./articleList.php", method="POST">
                            <input type="hidden" name="id" value="<?php echo $blog['blog_id'] ?>"/>
                            <input type="hidden" name="logged_in" value="<?php echo isLoggedIn()?>"/>
                            <button type="submit" class="linkbutton">Go to Article List</button>
                        </form>
                        <form action="./blog.php", method="POST">
                            <input type="hidden" name="id" value="<?php echo $blog['blog_id'] ?>"/>
                            <input type="hidden" name="logged_in" value="<?php echo isLoggedIn()?>"/>
                            <button type="submit" class="linkbutton">Go to Blog</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <footer>

        </footer>
    </body>
</html>