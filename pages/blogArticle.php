<?php
    require "../vendor/autoload.php"; 
    use App\SQLiteConnection as SQLiteConnection;
    use App\SQLiteQuery as SQLiteQuery;

    $conn = (new SQLiteConnection())-> connect();
    $query = new SQLiteQuery($conn);

    $article = [];

    if(empty($_GET)){
        $article = $query->getArticleByID(" ");
    } else {
        $article = $query->getArticleByID($_GET['id']);
    }

    if(empty($article)){
        $article[] = [
            'article_name' => "Article not found",
            'article_content' => "Oops, we can't find that article. Double-check your URL and try again! If you get this message after double-checking your URL, the article you are looking for may have been deleted.",
            'pub_date' => "Uh oh",
        ];
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
    <header>
        <h1>Turtles 101</h1>
    </header>
    <div id="main">
        <article id="right-sidebar">
            <br>
            <a class="linkbutton" href="#">Most Popular Post</a>
            <br><br>
            <a class="linkbutton" href="#">Secondmost Popular Post</a>
            <br><br>
            <a class="linkbutton" href='#'>Thirdmost Popular Post</a>
            <h2>About Me</h2>
            <p>Your intro to Turtleblogging!</p>
            <br>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sodales quis est in pretium. Cras in dui sed
                odio pellentesque
                vehicula non sed sapien. Quisque eget est pellentesque, rhoncus massa id, ultrices lectus. Donec aliquet
                efficitur
                condimentum. Pellentesque et erat arcu. Aliquam eget diam finibus, efficitur risus vitae, sagittis
                sapien.</p>
        </article>
        <article id="center">
            <h2><?php echo $article[0]['article_name']; ?></h2>
            <h2><?php echo $article[0]['pub_date']; ?></h2>
            <p><?php echo $article[0]['article_content'] ?></p>
        </article>
        <article id="commentSection">
            <div id="newComment">
                <h3>New Comment</h3>
                <form>
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