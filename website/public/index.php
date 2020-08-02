<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/../application/includes.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/../application/database.php");
    
    if (isset($_SESSION["user"]))
    {
        redirect("/my/dashboard");
    }

    open_database_connection($sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <?php
            build_header("Landing");
        ?>
    </head>
    <body>
        <?php
            build_navigation_bar();
        ?>

        <div class="container">
            <div class="left">
                <div class="info">Log in</div>
                
                <br>
                <form method="post" action="/login">
                    <input placeholder="Username / E-Mail" type="text" name="username" required>
                    <br>
                    <input placeholder="Password" type="password" name="password" required>
                    <br><br>
                    <input type="submit" value="Login">
                    <span><small>New user? <a href="/register">Register</a></small></span>
                </form>
                <br>

                <div class="info">Latest Blog Posts</div>
                <?php
                    $statement = $sql->prepare("SELECT `id`, `title`, `author` FROM `blogs` ORDER BY `id` DESC LIMIT 5");
                    $statement->execute();

                    foreach ($statement as $result):
                        $user = $sql->prepare("SELECT `username` FROM `users` WHERE `id` = ?");
                        $user->execute($result["author"]);
                        $username = $user->fetch(PDO::FETCH_ASSOC)["username"];
                ?>
                        <a href="/blogs/view?id=<?= $result["id"] ?>"><?= $result["title"] ?> - by <a href="/users/view?id=<?= $author ?>"><?= $username ?></a></a><br><br>
                <?php
                    endforeach;
                ?>

                <a href="/blogs/">View more blog posts</a>
                <br><br>

                <div class="topBarWithItemsThing">
                    <a href="/blogs/">Blogs</a>
                    <a href="/groups/">Groups</a>
                    <a href="/register">Register</a>
                    <a href="/login">Login</a>
                </div>
            </div>

            <div class="right">
                <div class="info">Features</div>
            </div>
        </div>
    </body>
</html>