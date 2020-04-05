<?php 
    require "../vendor/autoload.php"; 
    use App\SQLiteConnection as SQLiteConnection;
    use App\SQLiteInsert as SQLiteInsert;
    use App\SQLiteQuery as SQLiteQuery;

    $conn = (new SQLiteConnection())-> connect();
    $insert = new SQLiteInsert($conn);
    $query = new SQLiteQuery($conn);

    //blogs
    $insert->insertBlog("Yah Boi", "Turtles blah blah blah TURblahTLES");
    $insert->insertBlog("TURboiTLES", "blah blah blah blah TURTLES blah blah blah blahty blahty BLAH");
    $insert->insertBlog("The Black Turtle", "All BLACK tutrles, all the time. BLACK is the best color there ever is, ever will be");
    $insert->insertBlog("Tickled Turtlish", "The touching tales of troubled turtles tumbling to the top");
    $insert->insertBlog("Turtles suck", "The reason why turtles are the worst, least eveolved animals evar");

    //users
    $insert->insertUser('user1', 'user1', 'user1@email.com', FALSE);
    $insert->insertUser('user2', 'user2', 'user2@email.com', FALSE);
    $insert->insertUser('user3', 'user3', 'user3@email.com', FALSE);

    //articles
    $insert->insertArticle("Try #1", 1, "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque faucibus, risus sed dictum pretium, felis sapien feugiat turpis, et pretium tortor elit ac ligula. In lacus ipsum, euismod sit amet ex id, imperdiet auctor ligula. Curabitur vel justo non arcu laoreet consequat. Sed ullamcorper, justo id ultricies consectetur, neque quam tristique ante, sed eleifend augue lacus quis quam. Donec vel mauris id dolor vulputate dapibus. Suspendisse potenti. Integer ac varius felis. Etiam sit amet libero sit amet orci tincidunt ultrices vel quis mi. Mauris ante dui, ultrices sed neque at, vulputate pretium ante. Pellentesque nec dolor tincidunt, aliquam libero eu, tempus nibh. Vivamus eleifend libero nec dolor ornare egestas.<br><br>


    Quisque dignissim felis non mauris imperdiet hendrerit. In erat justo, consequat sit amet mi in, ornare sollicitudin tellus. Donec blandit tincidunt eros, et interdum nibh posuere sit amet. Vivamus quis congue elit, et malesuada tortor. Suspendisse potenti. Quisque dignissim rhoncus nisl id aliquet. Donec maximus a risus consequat porta.<br><br>
    
    
    Vestibulum vitae diam efficitur, feugiat magna sit amet, rhoncus enim. Etiam vel finibus mauris. Cras interdum sapien et nunc facilisis blandit. Nam finibus risus efficitur finibus efficitur. Nunc eget tortor a eros feugiat ultrices eget nec metus. Integer ut est quis velit pretium sagittis. Donec bibendum sagittis erat. Nulla varius orci sed nulla rutrum pellentesque. Praesent non interdum lorem. Proin ligula urna, consequat sed convallis quis, fermentum eu ante. Morbi bibendum feugiat odio in tincidunt. Morbi in gravida tortor. Nunc sit amet quam quis velit tempus dignissim.<br><br>
    
    
    Morbi blandit ipsum et maximus mollis. Morbi leo nunc, placerat vitae dapibus nec, facilisis vel dui. Aliquam erat volutpat. Ut pulvinar justo eget quam tristique, in tempus nibh aliquet. Phasellus porta sed nibh vel pretium. Integer ligula ex, venenatis eu tristique ac, volutpat eu tortor. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ultricies eros sit amet odio venenatis, vel auctor erat consequat. Nunc in purus non erat bibendum dapibus. Morbi hendrerit convallis enim, et faucibus velit auctor a. Proin elit velit, tempor sed sem eget, egestas malesuada est.<br><br>
    
    
    Cras at sagittis libero. Cras laoreet facilisis dictum. Phasellus lectus dolor, eleifend sit amet massa id, suscipit tincidunt libero. Fusce cursus congue dui. Quisque id diam blandit, suscipit velit ac, bibendum nisi. Maecenas cursus eros in magna sagittis, sit amet convallis augue tincidunt. In convallis ex at arcu pellentesque, nec lacinia nisl euismod. Vivamus at libero enim. Nullam quam mi, auctor ac interdum sed, pretium blandit leo.");
    

    $insert->insertArticle("Thikner", 1, "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque faucibus, risus sed dictum pretium, felis sapien feugiat turpis, et pretium tortor elit ac ligula. In lacus ipsum, euismod sit amet ex id, imperdiet auctor ligula. Curabitur vel justo non arcu laoreet consequat. Sed ullamcorper, justo id ultricies consectetur, neque quam tristique ante, sed eleifend augue lacus quis quam. Donec vel mauris id dolor vulputate dapibus. Suspendisse potenti. Integer ac varius felis. Etiam sit amet libero sit amet orci tincidunt ultrices vel quis mi. Mauris ante dui, ultrices sed neque at, vulputate pretium ante. Pellentesque nec dolor tincidunt, aliquam libero eu, tempus nibh. Vivamus eleifend libero nec dolor ornare egestas.<br><br>


    Quisque dignissim felis non mauris imperdiet hendrerit. In erat justo, consequat sit amet mi in, ornare sollicitudin tellus. Donec blandit tincidunt eros, et interdum nibh posuere sit amet. Vivamus quis congue elit, et malesuada tortor. Suspendisse potenti. Quisque dignissim rhoncus nisl id aliquet. Donec maximus a risus consequat porta.<br><br>
    
    
    Vestibulum vitae diam efficitur, feugiat magna sit amet, rhoncus enim. Etiam vel finibus mauris. Cras interdum sapien et nunc facilisis blandit. Nam finibus risus efficitur finibus efficitur. Nunc eget tortor a eros feugiat ultrices eget nec metus. Integer ut est quis velit pretium sagittis. Donec bibendum sagittis erat. Nulla varius orci sed nulla rutrum pellentesque. Praesent non interdum lorem. Proin ligula urna, consequat sed convallis quis, fermentum eu ante. Morbi bibendum feugiat odio in tincidunt. Morbi in gravida tortor. Nunc sit amet quam quis velit tempus dignissim.<br><br>
    
    
    Morbi blandit ipsum et maximus mollis. Morbi leo nunc, placerat vitae dapibus nec, facilisis vel dui. Aliquam erat volutpat. Ut pulvinar justo eget quam tristique, in tempus nibh aliquet. Phasellus porta sed nibh vel pretium. Integer ligula ex, venenatis eu tristique ac, volutpat eu tortor. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ultricies eros sit amet odio venenatis, vel auctor erat consequat. Nunc in purus non erat bibendum dapibus. Morbi hendrerit convallis enim, et faucibus velit auctor a. Proin elit velit, tempor sed sem eget, egestas malesuada est.<br><br>
    
    
    Cras at sagittis libero. Cras laoreet facilisis dictum. Phasellus lectus dolor, eleifend sit amet massa id, suscipit tincidunt libero. Fusce cursus congue dui. Quisque id diam blandit, suscipit velit ac, bibendum nisi. Maecenas cursus eros in magna sagittis, sit amet convallis augue tincidunt. In convallis ex at arcu pellentesque, nec lacinia nisl euismod. Vivamus at libero enim. Nullam quam mi, auctor ac interdum sed, pretium blandit leo.");

    $insert->insertArticle("Try #2", 1, "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque faucibus, risus sed dictum pretium, felis sapien feugiat turpis, et pretium tortor elit ac ligula. In lacus ipsum, euismod sit amet ex id, imperdiet auctor ligula. Curabitur vel justo non arcu laoreet consequat. Sed ullamcorper, justo id ultricies consectetur, neque quam tristique ante, sed eleifend augue lacus quis quam. Donec vel mauris id dolor vulputate dapibus. Suspendisse potenti. Integer ac varius felis. Etiam sit amet libero sit amet orci tincidunt ultrices vel quis mi. Mauris ante dui, ultrices sed neque at, vulputate pretium ante. Pellentesque nec dolor tincidunt, aliquam libero eu, tempus nibh. Vivamus eleifend libero nec dolor ornare egestas.<br><br>


    Quisque dignissim felis non mauris imperdiet hendrerit. In erat justo, consequat sit amet mi in, ornare sollicitudin tellus. Donec blandit tincidunt eros, et interdum nibh posuere sit amet. Vivamus quis congue elit, et malesuada tortor. Suspendisse potenti. Quisque dignissim rhoncus nisl id aliquet. Donec maximus a risus consequat porta.<br><br>
    
    
    Vestibulum vitae diam efficitur, feugiat magna sit amet, rhoncus enim. Etiam vel finibus mauris. Cras interdum sapien et nunc facilisis blandit. Nam finibus risus efficitur finibus efficitur. Nunc eget tortor a eros feugiat ultrices eget nec metus. Integer ut est quis velit pretium sagittis. Donec bibendum sagittis erat. Nulla varius orci sed nulla rutrum pellentesque. Praesent non interdum lorem. Proin ligula urna, consequat sed convallis quis, fermentum eu ante. Morbi bibendum feugiat odio in tincidunt. Morbi in gravida tortor. Nunc sit amet quam quis velit tempus dignissim.<br><br>
    
    
    Morbi blandit ipsum et maximus mollis. Morbi leo nunc, placerat vitae dapibus nec, facilisis vel dui. Aliquam erat volutpat. Ut pulvinar justo eget quam tristique, in tempus nibh aliquet. Phasellus porta sed nibh vel pretium. Integer ligula ex, venenatis eu tristique ac, volutpat eu tortor. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ultricies eros sit amet odio venenatis, vel auctor erat consequat. Nunc in purus non erat bibendum dapibus. Morbi hendrerit convallis enim, et faucibus velit auctor a. Proin elit velit, tempor sed sem eget, egestas malesuada est.<br><br>
    
    
    Cras at sagittis libero. Cras laoreet facilisis dictum. Phasellus lectus dolor, eleifend sit amet massa id, suscipit tincidunt libero. Fusce cursus congue dui. Quisque id diam blandit, suscipit velit ac, bibendum nisi. Maecenas cursus eros in magna sagittis, sit amet convallis augue tincidunt. In convallis ex at arcu pellentesque, nec lacinia nisl euismod. Vivamus at libero enim. Nullam quam mi, auctor ac interdum sed, pretium blandit leo.");

    $insert->insertArticle("Test Alpha", 2, "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque faucibus, risus sed dictum pretium, felis sapien feugiat turpis, et pretium tortor elit ac ligula. In lacus ipsum, euismod sit amet ex id, imperdiet auctor ligula. Curabitur vel justo non arcu laoreet consequat. Sed ullamcorper, justo id ultricies consectetur, neque quam tristique ante, sed eleifend augue lacus quis quam. Donec vel mauris id dolor vulputate dapibus. Suspendisse potenti. Integer ac varius felis. Etiam sit amet libero sit amet orci tincidunt ultrices vel quis mi. Mauris ante dui, ultrices sed neque at, vulputate pretium ante. Pellentesque nec dolor tincidunt, aliquam libero eu, tempus nibh. Vivamus eleifend libero nec dolor ornare egestas.<br><br>


    Quisque dignissim felis non mauris imperdiet hendrerit. In erat justo, consequat sit amet mi in, ornare sollicitudin tellus. Donec blandit tincidunt eros, et interdum nibh posuere sit amet. Vivamus quis congue elit, et malesuada tortor. Suspendisse potenti. Quisque dignissim rhoncus nisl id aliquet. Donec maximus a risus consequat porta.<br><br>
    
    
    Vestibulum vitae diam efficitur, feugiat magna sit amet, rhoncus enim. Etiam vel finibus mauris. Cras interdum sapien et nunc facilisis blandit. Nam finibus risus efficitur finibus efficitur. Nunc eget tortor a eros feugiat ultrices eget nec metus. Integer ut est quis velit pretium sagittis. Donec bibendum sagittis erat. Nulla varius orci sed nulla rutrum pellentesque. Praesent non interdum lorem. Proin ligula urna, consequat sed convallis quis, fermentum eu ante. Morbi bibendum feugiat odio in tincidunt. Morbi in gravida tortor. Nunc sit amet quam quis velit tempus dignissim.<br><br>
    
    
    Morbi blandit ipsum et maximus mollis. Morbi leo nunc, placerat vitae dapibus nec, facilisis vel dui. Aliquam erat volutpat. Ut pulvinar justo eget quam tristique, in tempus nibh aliquet. Phasellus porta sed nibh vel pretium. Integer ligula ex, venenatis eu tristique ac, volutpat eu tortor. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ultricies eros sit amet odio venenatis, vel auctor erat consequat. Nunc in purus non erat bibendum dapibus. Morbi hendrerit convallis enim, et faucibus velit auctor a. Proin elit velit, tempor sed sem eget, egestas malesuada est.<br><br>
    
    
    Cras at sagittis libero. Cras laoreet facilisis dictum. Phasellus lectus dolor, eleifend sit amet massa id, suscipit tincidunt libero. Fusce cursus congue dui. Quisque id diam blandit, suscipit velit ac, bibendum nisi. Maecenas cursus eros in magna sagittis, sit amet convallis augue tincidunt. In convallis ex at arcu pellentesque, nec lacinia nisl euismod. Vivamus at libero enim. Nullam quam mi, auctor ac interdum sed, pretium blandit leo.");

    $insert->insertArticle("Test Omega", 2, "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque faucibus, risus sed dictum pretium, felis sapien feugiat turpis, et pretium tortor elit ac ligula. In lacus ipsum, euismod sit amet ex id, imperdiet auctor ligula. Curabitur vel justo non arcu laoreet consequat. Sed ullamcorper, justo id ultricies consectetur, neque quam tristique ante, sed eleifend augue lacus quis quam. Donec vel mauris id dolor vulputate dapibus. Suspendisse potenti. Integer ac varius felis. Etiam sit amet libero sit amet orci tincidunt ultrices vel quis mi. Mauris ante dui, ultrices sed neque at, vulputate pretium ante. Pellentesque nec dolor tincidunt, aliquam libero eu, tempus nibh. Vivamus eleifend libero nec dolor ornare egestas.<br><br>


    Quisque dignissim felis non mauris imperdiet hendrerit. In erat justo, consequat sit amet mi in, ornare sollicitudin tellus. Donec blandit tincidunt eros, et interdum nibh posuere sit amet. Vivamus quis congue elit, et malesuada tortor. Suspendisse potenti. Quisque dignissim rhoncus nisl id aliquet. Donec maximus a risus consequat porta.<br><br>
    
    
    Vestibulum vitae diam efficitur, feugiat magna sit amet, rhoncus enim. Etiam vel finibus mauris. Cras interdum sapien et nunc facilisis blandit. Nam finibus risus efficitur finibus efficitur. Nunc eget tortor a eros feugiat ultrices eget nec metus. Integer ut est quis velit pretium sagittis. Donec bibendum sagittis erat. Nulla varius orci sed nulla rutrum pellentesque. Praesent non interdum lorem. Proin ligula urna, consequat sed convallis quis, fermentum eu ante. Morbi bibendum feugiat odio in tincidunt. Morbi in gravida tortor. Nunc sit amet quam quis velit tempus dignissim.<br><br>
    
    
    Morbi blandit ipsum et maximus mollis. Morbi leo nunc, placerat vitae dapibus nec, facilisis vel dui. Aliquam erat volutpat. Ut pulvinar justo eget quam tristique, in tempus nibh aliquet. Phasellus porta sed nibh vel pretium. Integer ligula ex, venenatis eu tristique ac, volutpat eu tortor. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec ultricies eros sit amet odio venenatis, vel auctor erat consequat. Nunc in purus non erat bibendum dapibus. Morbi hendrerit convallis enim, et faucibus velit auctor a. Proin elit velit, tempor sed sem eget, egestas malesuada est.<br><br>
    
    
    Cras at sagittis libero. Cras laoreet facilisis dictum. Phasellus lectus dolor, eleifend sit amet massa id, suscipit tincidunt libero. Fusce cursus congue dui. Quisque id diam blandit, suscipit velit ac, bibendum nisi. Maecenas cursus eros in magna sagittis, sit amet convallis augue tincidunt. In convallis ex at arcu pellentesque, nec lacinia nisl euismod. Vivamus at libero enim. Nullam quam mi, auctor ac interdum sed, pretium blandit leo.");


    //comments
    $insert->insertComment(2, 1, 'hurp-a-durp i thikn this is great');
    $insert->insertComment(1, 1, 'blah blah blah Im just trying this out cuz Im bored');
    $insert->insertComment(2, 2, "go home you're drunk");

    $dummyBlogs = $query -> getAllBlogs();
    $dummyArticles = $query -> getAllArticles();

?>




<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="sqlitetutorial.net">
        <title>PHP SQLite DB CONNECT & CREATE</title>
        <link href="http://v4-alpha.getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
 
    </head>
    <body>
        <div class="container">
            <div class="page-header">
                <h1>PHP SQLite DB ADD DUMMIES</h1>
            </div>
 
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Blogs</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dummyBlogs as $blog) : ?>
                        <tr>
 
                            <td><?php echo $blog ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Articles</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dummyArticles as $article) : ?>
                        <tr>
 
                            <td><?php echo $article ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>