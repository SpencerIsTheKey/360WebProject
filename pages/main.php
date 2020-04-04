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

    $topblogs = [];
    
    $topblogs = $query->mainpage();

?>

<!Doctype HTML>

<html>

<head>
    <title>Talk About Turtles</title>
    <link rel="stylesheet" href="../CSS/navbar.css">
    <link rel="stylesheet" href="../CSS/homepage.css">
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
        <article id="right-sidebar">
            <h2>Site Rules</h2>
            <p>You can talk about anything you want, as long as it's turtles!</p>
            <br>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sodales quis est in pretium. Cras in dui sed
                odio pellentesque
                vehicula non sed sapien. Quisque eget est pellentesque, rhoncus massa id, ultrices lectus. Donec aliquet
                efficitur
                condimentum. Pellentesque et erat arcu. Aliquam eget diam finibus, efficitur risus vitae, sagittis
                sapien.</p>
        </article>
        <article id="center">
            <h1>Top Blogs</h1>
            <?php foreach($topblogs as $blog) : ?>
            <div class="popBlog">
                <figure>
                    <img src="<?php echo $blog['cover_img'] ?>" alt="Blog Photo">
                </figure>
                <div>
                    <h2><?php echo $blog['blog_name'] ?></h2>
                    <p>
                        <?php echo $blog['about'] ?>
                    </p>
                    <div class="right">
                        <a href="./articleList.php?id=<?php echo $blog['blog_id'] ?>" class="linkbutton">Go to Article List</a>
                        <a href="./blog.php?id=<?php echo $blog['blog_id'] ?>" class="linkbutton">Go to Blog</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

        </article>
    </div>
    <footer>

    </footer>
</body>

</html>