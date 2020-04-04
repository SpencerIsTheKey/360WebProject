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

    $article = [];

    if(empty($_GET)){
        $article = $query->getArticleByID(" ");
    } else {
        $article = ($query->getArticleByID($_GET['id']))[0];
    }

    if(empty($article)){
        $article[] = [
            'article_name' => "Article not found",
            'article_content' => "Oops, we can't find that article. Double-check your URL and try again! If you get this message after double-checking your URL, the article you are looking for may have been deleted.",
            'pub_date' => "Uh oh",
            'parent_blog' => "Confused...",
        ];
    } else {
        $top3 = $query->topPosts($article['parent_blog']);
        $blog = $query->getBlogByID($article['parent_blog'])[0];
        $article['parent_blog'] = $query->getParentBlogName($article['parent_blog']);
        $update->addArticleHit($_GET['id']);
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
    <header>
        <h1><?php echo $article['parent_blog'] ?></h1>
    </header>
    <div id="main">
        <article id="right-sidebar">
        <?php foreach ($top3 as $post): ?>
                <br>
                <a class="linkbutton" href="./blogArticle.php?id=<?php echo $post['article_id'] ?>"><?php echo $post['article_name'] ?></a>
                <br>
            <?php endforeach; ?>
            <br>
            <br>
            <a class="linkbutton" href="./articleList.php?id=<?php echo $_GET['id'] ?>">Article List</a>
            <h2>About Me</h2>
            <?php echo $blog['about'] ?>
        </article>
        <article id="center">
            <h2><?php echo $article['article_name'] ?></h2>
            <h4><?php echo $article['pub_date'] ?></h4>
            <p><?php echo $article['article_content'] ?></p>
        </article>
        <article id="commentSection">
            <div id="newComment">
                <h3>New Comment</h3>
                <form action="./addComment.php" method="post" target="_blank">
                    <textarea rows="5" cols="100" name="commentContent" placeholder="New comment..."></textarea>
                    <br>
                    <button type="submit">Submit Comment</button>
                </form>
                <br>
            </div>
            <div class="comment">
                <figure>
                    <img src="../CSS/images/userPrfile.jpg" alt="User Profile Pic">
                </figure>
                <p> 
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque faucibus, risus sed dictum pretium, 
                    felis sapien feugiat turpis, et pretium tortor elit ac ligula. In lacus ipsum, euismod sit amet ex id, 
                    imperdiet auctor ligula. Curabitur vel justo non arcu laoreet consequat. Sed ullamcorper, justo id ultricies 
                    consectetur, neque quam tristique ante, sed eleifend augue lacus quis quam. Donec vel mauris id dolor vulputate 
                    dapibus. Suspendisse potenti. Integer ac varius felis.
                </p>
            </div>
            <div class="comment">
                <figure>
                    <img src="../CSS/images/userPrfile.jpg" alt="User Profile Pic">
                </figure>
                <p> 
                    Etiam sit amet libero sit amet orci tincidunt ultrices 
                    vel quis mi. Mauris ante dui, ultrices sed neque at, vulputate pretium ante. Pellentesque nec dolor tincidunt, 
                    aliquam libero eu, tempus nibh. Vivamus eleifend libero nec dolor ornare egestas.
                </p>
            </div>
            <div class="comment">
                <figure>
                    <img src="../CSS/images/userPrfile.jpg" alt="User Profile Pic">
                </figure>
                <p> 
                    Quisque dignissim felis non mauris imperdiet hendrerit. In erat justo, consequat sit amet mi in, ornare 
                    sollicitudin tellus. Donec blandit tincidunt eros, et interdum nibh posuere sit amet. Vivamus quis 
                    congue elit, et malesuada tortor. Suspendisse potenti. Quisque dignissim rhoncus nisl id aliquet. Donec 
                    maximus a risus consequat porta.
                </p>
            </div>
        </article>
    </div>
</body>
</html>