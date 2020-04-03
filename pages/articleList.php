<?php
    require "../vendor/autoload.php"; 
    use App\SQLiteConnection as SQLiteConnection;
    use App\SQLiteQuery as SQLiteQuery;

    $conn = (new SQLiteConnection())-> connect();
    $query = new SQLiteQuery($conn);

    $blog = [];
    $articles = [];

    if(empty($_GET)){
        $blog = $query->getBlogByID(" ");
    } else {
        $get_num = sizeof($_GET);
        $blog = ($query->getBlogByID($_GET['id']))[0];
    }

    if(!empty($blog)){
        $articles = $query->getArticlesFromBlog($_GET['id'], TRUE, 5);

        for ($i=0; $i < sizeof($articles); $i++){
            $articles[$i]['article_content'] = substr($articles[$i]['article_content'], 0, strpos($articles[$i]['article_content'], "<br>"));
        }
    }


?>
<!Doctype HTML>

<html>

<head>
    <title>Talk About Turtles</title>
    <link rel="stylesheet" href="../CSS/navbar.css">
    <link rel="stylesheet" href="../CSS/blogpage.css">
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
    <header> <h1><?php echo $blog['blog_name'] ?> </h1> </header>
    <div id="main">
        <article id="right-sidebar">
            
            <h2>About Me</h2>
            <?php echo $blog['about'] ?>
        </article>
        <article id="center">
            <h1>Recent Posts</h1>


            <?php foreach($articles as $article) : ?>
                <div class="recentPost">
                <figure>
                    <img src="<?php echo $article['art_img'] ?>" alt="Post Photo">
                </figure>
                <div>
                    <h2><?php echo $article['article_name'] ?></h2>
                    <p>
                        <?php echo $article['article_content'] ?>
                    </p>
                    <div class="right">
                        <a href="./blogArticle.php?id=<?php echo $article["article_id"] ?>" class="linkbutton">Go to Post</a>
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