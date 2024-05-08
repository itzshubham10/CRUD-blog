<?php
// session_start();
require 'config/constants.php';
$username_email = $_SESSION['signin-data']['username_email'] ?? null;
$password = $_SESSION['signin-data']['password'] ?? null;
unset($_SESSION['signin-data']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP & MySql Blog Application with Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- ===================CSS Style======================= -->
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style.css">
</head>

<body>


    <section class="form_section">
        <div class="container form_section_container">
            <h2>Sign In</h2>
            <?php if (isset($_SESSION['signup-success'])) : ?>
                <div class="alert_message success">
                    <p>
                        <?= $_SESSION['signup-success'];
                        unset($_SESSION['signup-success']);
                        ?>
                    </p>
                </div>
            <?php elseif (isset($_SESSION['signin'])) : ?>
                <div class="alert_message error">
                    <p>
                        <?= $_SESSION['signin'];
                        unset($_SESSION['signin']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action=" <?= ROOT_URL ?>signin_logic.php" method="post">
                <input type="text" name="username_email" value="<?= $username_email ?>" placeholder="Username or Email">
                <input type="password" name="password" value="<?= $password ?>" placeholder="Password">
                <button class="btn" name="submit" submit">Sign In</button>
                <small>Don't have an account? <a href="signup.php">Sign Up</a></small>
            </form>
        </div>
    </section>

</body>

</html>