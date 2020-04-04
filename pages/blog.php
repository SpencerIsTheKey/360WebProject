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
    use App\SQLiteUpdate as SQLiteUpdate;

    $conn = (new SQLiteConnection())-> connect();
    $query = new SQLiteQuery($conn);
    $update = new SQLiteUpdate($conn);

    $blog = [];
    $articles = [];

    if(empty($_GET)){
        $blog = $query->getBlogByID(" ");
    } else {
        $blog = ($query->getBlogByID($_GET['id']))[0];
    }

    if(!empty($blog)){
        $articles = $query->getArticlesFromBlog($_GET['id'], TRUE, 5);
        $update->addBlogHit($_GET['id']);
        $top3 = $query->topPosts($_GET['id']);

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
    <header> <h1><?php echo $blog['blog_name'] ?> </h1> </header>
    <div id="main">
        <article id="right-sidebar">

            <?php foreach ($top3 as $post): ?>
                <br>
                <a class="linkbutton" href="./blogArticle.php?id=<?php echo $post['article_id'] ?>"><?php echo $post['article_name'] ?></a>
                <br>
            <?php endforeach; ?>
            
            <h2>About Me</h2>
            <?php echo $blog['about'] ?>
            <br>
            <br>
            <br>
            <a class="linkbutton" href="./articleList.php?id=<?php echo $_GET['id'] ?>">Article List</a>
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
                        <a href="/360WebProject/pages/blogArticle.php?id=<?php echo $article["article_id"] ?>" class="linkbutton">Go to Post</a>
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