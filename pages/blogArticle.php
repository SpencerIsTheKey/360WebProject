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
    use App\SQLiteInsert as SQliteInsert;


    $conn = (new SQLiteConnection())-> connect();
    $query = new SQLiteQuery($conn);
    $update = new SQLiteUpdate($conn);
    $insert = new SQLiteInsert($conn);

    $article = [];
    $test = "";

    if(empty($_POST)){
        $article = $query->getArticleByID(" ");
    } else {
        $article = ($query->getArticleByID($_POST['id']))[0];
    }

    if(empty($article)){
        $article[] = [
            'article_name' => "Article not found",
            'article_content' => "Oops, we can't find that article. Double-check your URL and try again! If you get this message after double-checking your URL, the article you are looking for may have been deleted.",
            'pub_date' => "Uh oh",
            'parent_blog' => "Confused...",
        ];
    } else {
        if(array_key_exists('comment_content', $_POST)){
            $insert->insertComment($_POST['id'], $_POST['logged_in'], $_POST['comment_content']);
        } else {
            $update->addArticleHit($_POST['id']);

        }
        $top3 = $query->topPosts($article['parent_blog']);
        $blog = $query->getBlogByID($article['parent_blog'])[0];
        $comments = $query->getArticleComments($_POST['id']);
        $article['parent_blog'] = $query->getParentBlogName($article['parent_blog']);
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
                <input type="hidden" name="logged_in" value="<?php echo isLoggedIn();?>"/>
                <input id="searchfield" name="search" type="text"/>
                <button type ="submit" id="searchbtn"><img id="searchimg" src="../CSS/images/search.png"></button>
            </form>
        </div>
        <div id="login">
            <?php if (empty(isLoggedIn())){ ?>
                <form action="./login.php" method="POST">
                    <input type="hidden" name="logged_in" value="<?php echo isLoggedIn();?>"/>
                    <button type="submit" class="linkbutton">Login/Signup</button>
                </form>
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
            <br>
            <?php foreach ($top3 as $post): ?>
                <form action="./blogArticle.php", method="POST">
                    <input type="hidden" name="id" value="<?php echo $post['article_id'] ?>"/>
                    <input type="hidden" name="logged_in" value="<?php echo isLoggedIn()?>"/>
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
                <input type="hidden" name="id" value="<?php echo $blog['blog_id'] ?>"/>
                <input type="hidden" name="logged_in" value="<?php echo isLoggedIn()?>"/>
                <button type="submit" class="linkbutton">Go to Article List</button>
            </form>
        </article>
        <article id="center">
            <h2><?php echo $article['article_name'] ?></h2>
            <h4><?php echo $article['pub_date'] ?></h4>
            <p><?php echo $article['article_content'] ?></p>
        </article>
        <article id="commentSection">

            <div id="newComment">
                <h3>New Comment</h3>
                <?php if(empty(isLoggedIn())){ ?>
                    <a class="linkbutton" href="./login.php">Log in to comment</a>
                    <br>
                <?php } else {?>
                    <form method="post">
                        <input type="hidden" name="id" value="<?php echo $_POST['id']?>"/>
                        <input type="hidden" name="logged_in" value="<?php echo isLoggedIn()?>"/>
                        <textarea rows="5" cols="100" name="comment_content" placeholder="New comment..."></textarea>
                        <br>
                        <button type="submit">Submit Comment</button>
                    </form>
                <?php } ?>
                <br>
            </div>
            <?php echo $test?>
            <?php foreach($comments as $comment) : ?>
            <div class="comment">
                <figure>
                    <img src="<?php echo $comment['profile_img'] ?>" alt="Profile Photo">
                </figure>
                <div>
                    <span>
                        <h2 class="username"><?php echo $comment['username']?></h2>
                        <h6 class="date"><?php echo $comment['comment_date'] ?></h6>
                    </span>
                    <p><?php echo $comment['comment_content'] ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </article>
    </div>
</body>
</html>