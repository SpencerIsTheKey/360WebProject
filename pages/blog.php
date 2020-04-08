<?php
    session_start();

    function isLoggedIn(){
        
        if(isset($_SESSION['logged_in'])){  //if the logged_in key exists
            return $_SESSION['logged_in'];      //return the value stored inside

        } else {                        //if the logged_in key does not exist
            $_SESSION['logged_in'] = "";    //set as empty string
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

    if(empty($_POST)){
        $blog = $query->getBlogByID(" ");
    } else {
        $blog = ($query->getBlogByID($_POST['id']))[0];
    }

    if(!empty($blog)){
        $articles = $query->getArticlesFromBlog($_POST['id'], TRUE, 5);
        $update->addBlogHit($_POST['id']);
        $top3 = $query->topPosts($_POST['id']);

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
                <form action="./login.php" method="POST">
                    <button type="submit" class="linkbutton">Login/Signup</button>
                </form>
            <?php } else { ?>
                <form action="./accountManage.php" method="POST">
                    <button type="submit" class="linkbutton">Manage Account</button>
                </form>
            <?php } ?>
        </div>
    </div>

<body>
    <header> <h1><?php echo $blog['blog_name'] ?> </h1> </header>
    <div id="main">
        <article id="right-sidebar">
                <br>
            <?php foreach ($top3 as $post): ?>
                <form action="./blogArticle.php", method="POST">
                    <input type="hidden" name="id" value="<?php echo $post['article_id'] ?>"/>
                    <button type="submit" class="linkbutton"><?php echo $post['article_name'] ?></button>
                </form>
                <br>
            <?php endforeach; ?>
            
            <h2>About Me</h2>
            <?php echo $blog['about'] ?>
            <br>
            <br>
            <br>
            <form action="./articleList.php", method="POST">
                <input type="hidden" name="id" value="<?php echo $_POST['id'] ?>"/>
                <button type="submit" class="linkbutton">Go to Article List</button>
            </form>
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
                        <form action="./blogArticle.php", method="POST">
                            <input type="hidden" name="id" value="<?php echo $article["article_id"] ?>"/>
                            <button type="submit" class="linkbutton">Go to Post</button>
                        </form>
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