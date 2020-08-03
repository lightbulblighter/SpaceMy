<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/../application/includes.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/../application/database.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/../application/api.php");

    if (isset($_SESSION["user"]))
    {
        redirect("/my/dashboard");
    }

    open_database_connection($sql);

    $logging_in = (isset($_POST["login"]) && $_SERVER["REQUEST_METHOD"] === "POST");
    $login_message = "";
    if ($logging_in)
    {
        login($login_message, $sql, $statement, $_POST); // Pass current SQL connection
        if (empty($login_message))
        {
            redirect("/my/dashboard");
        }
    }

    close_database_connection($sql, $statement);
?>

<!DOCTYPE html>
<html>
    <head>
        <?php
            build_header("Login");
        ?>
    </head>
    <body>
        <?php
            build_navigation_bar();
        ?>

        <div class="container">
            <div class="left">
                <div class="info">Log in</div><br>

                <?php if ($logging_in && !empty($login_message)): ?>
                <br><small style="color: red"><?= $login_message ?></small><br>
                <?php endif; ?>
                
                <form method="post">
                    <input placeholder="Username" type="text" name="username" required><br>
                    <input placeholder="Password" type="password" name="password" required><br>

                    <br>
                    
                    <input type="hidden" name="csrf" value="<?= $_SESSION["csrf"] ?>">
                    <input type="submit" name="login" value="Login">
                </form>
            </div>

            <div class="right">
                Don't have an account? <a href="/register">Register</a>
            </div>
        </div>
    </body>
</html>