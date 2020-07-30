<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/../application/includes.php");

    if (isset($_SESSION["user"]))
    {
        redirect("/my/dashboard");
    }
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
                <?php // TODO ?>
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
                <div class="info">Users</div>
                <?php // TODO ?>
                <a href="/users/">View more users</a>
            </div>
        </div>
    </body>
</html>