<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/../application/includes.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/../application/database.php");
    require_once($_SERVER["DOCUMENT_ROOT"] . "/../application/api.php");

    if (isset($_SESSION["user"]))
    {
        redirect("/my/dashboard");
    }

    open_database_connection($sql);
    $statement = $sql->prepare("SELECT COUNT(*) FROM `users`");
    $statement->execute();
    $users = ceil((int)$statement->fetchColumn() / 10) * 10; // Get user count, convert to integer, round to nearest 10

    $registering = false;
    $registration_message = "";
    if (isset($_POST["register"]) && $_SERVER["REQUEST_METHOD"] === "POST")
    {
        create_account($registration_message, $sql, $statement, $_POST); // Pass statement and sql to get de-initialized
    }

    close_database_connection($sql, $statement);
?>

<!DOCTYPE html>
<html>
    <head>
        <?php
            build_header("Register");
        ?>
    </head>
    <body>
        <?php
            build_navigation_bar();
        ?>

        <div class="container">
            <h1>Register</h1>

            <div class="left">
                <?php if ($registering && !empty($registration_message)): ?>
                <small style="color: red"><?= $registration_message ?></small>
                <?php elseif ($registering && empty($registration_message)): ?>
                <small style="color: green">Successfully created account, <?= $_POST["username"] ?>!</small>
                <?php endif; ?>
                
                <form method="post">
                    <input placeholder="Username" type="text" name="username" required><br>

                    <?php if (PROJECT["REFERRAL"]): ?>
                    <input placeholder="Invite key" type="Text" name="key" required><br>
                    <?php endif; ?>

                    <input placeholder="E-Mail" type="email" name="email" required><br>

                    <hr>
                    <input placeholder="Password" type="password" name="password" required><br>
                    <input placeholder="Confirm password" type="password" name="confirmed_password" required><br>
                    <br>
                    
                    <input type="hidden" name="csrf" value="<?= $_SESSION["csrf"] ?>">
                    <input type="submit" name="register" value="Register">
                </form>
            </div>

            <div class="right">
                <div class="contactInfo">
                    <div class="info">
                        <div class="text-align: center">Benefits</div>
                    </div>
                    - Make new friends!
                    - Talk to people!
                    <?php /* save embarrassment */ if ($users > 20): ?>
                    - Over <?= $users ?> members!
                    <?php endif; ?>
                    - Share your favorite videos and music!
                </div>
                <br>
                Already have an account? <a href="/login">Log in</a>
            </div>
        </div>
    </body>
</html>