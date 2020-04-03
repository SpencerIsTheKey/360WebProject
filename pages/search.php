<?php
    require "../vendor/autoload.php"; 
    use App\SQLiteConnection as SQLiteConnection;
    use App\SQLiteQuery as SQLiteQuery;

    $conn = (new SQLiteConnection())-> connect();
    $query = new SQLiteQuery($conn);

    $ss = [];

    if(empty($_GET)){
        $blogs = $query->search(" ");
    } else {
        $blogs = $query->search($_GET['search']);
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
            <a href="#"></a>
                <img src="../CSS/images/Turtle.png">
            </a>
        </div>
        <div id="title">
            <h1>Talk About Turtles</h1>
        </div>
        <div id="searchbar">
            <form action="./search.php" method="GET">
                <input id="search" name="search" type="text" style="height: 1.5em; width: 30em;"/>
                <button type ="submit" style="background-color: #f5eaea;"><img src="../CSS/images/search.png" style="height: 1.25em; width: 1.25em;"></button>
            </form>
        </div>
        <div id="login">
            <a class="linkbutton" href="#">Login/Signup</a>
        </div>
    </div>

    <body>
        <div id="main">
            <h1>Search Results</h1>
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
                        <a href="./blog.php?id=<?php echo $article['blog_id'] ?>" class="linkbutton">Go to Blog</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <footer>

        </footer>
    </body>
</html>