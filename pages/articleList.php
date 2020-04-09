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

    $conn = (new SQLiteConnection())-> connect();
    $query = new SQLiteQuery($conn);

    $blog = [];
    $articles = [];
    $title;

    $blog = ($query->getBlogByID($_GET['id']))[0];
    //if the blog was found
    if(!empty($blog)){
        //if there are no search parameters
        if(sizeof($_GET) == 1){
            $articles = $query->getArticlesFromBlog($_GET['id'], TRUE, 5);
                
            //shorten the content to the first paragraph
            for ($i=0; $i < sizeof($articles); $i++){
                $articles[$i]['article_content'] = substr($articles[$i]['article_content'], 0, strpos($articles[$i]['article_content'], "<br>"));                
            }
        } else {
            $articles = $query->articleListSearch($_GET['id'], $_GET['search'], $_GET['column']);
            //shorten the content fto the first paragraph
            for ($i=0; $i < sizeof($articles); $i++){
                $articles[$i]['article_content'] = substr($articles[$i]['article_content'], 0, strpos($articles[$i]['article_content'], "<br>"));
            }
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
            <form action="./main.php" method="POST">
                <div id=logo_btn>
                    <input type="image" src="../CSS/images/Turtle.png" alt="Main" width="75" height="75">
                </div>
            </form>
        </div>
        <div id="title">
            <h1>Talk About Turtles</h1>
        </div>
        <div id="searchbar">
            <form action="./search.php" method="GET">
                <input id="searchfield" name="search" type="text"/>
                <button type ="submit" id="searchbtn"><img id="searchimg" src="../CSS/images/search.png"></button>
            </form>
        </div>
        <div id="login">
            <?php if (empty(isLoggedIn())){ ?>
                <form action="./login.php" method="GET">
                    <button type="submit" class="linkbutton">Login/Signup</button>
                </form>
            <?php } else { ?>
                <form action="./accountManage.php" method="GET">
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
            <br>
            <form action="" method="GET">
                <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>"/>
                <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];} else { echo '';} ?>"/>
                <button type="submit"><img src="../CSS/images/search.png" style="height: 1.25em; width: 1.25em;"></button>
                <br>
                <br>
                <select id="column" name="column">
                    <option value="article_name">Article Name</option>
                    <option value="pub_date">Publish Date</option>
                    <option value="article_id">Article ID</option>
                </select>
            </form>
            
            <h2>About Me</h2>
            <?php echo $blog['about'] ?>
            <br>
            
        </article>
        <article id="center">
            <h1>Posts</h1>


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
                        <form action="./blogArticle.php", method="GET">
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