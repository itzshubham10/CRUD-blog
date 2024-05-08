<?php

require 'config/constants.php';

// gert back form data if there was a registsration error
$firstname = $_SESSION['signup-data']['firstname'] ?? null;
$lastname = $_SESSION['signup-data']['lastname'] ?? null;
$username = $_SESSION['signup-data']['username'] ?? null;
$email = $_SESSION['signup-data']['email'] ?? null;
$createpassword = $_SESSION['signup-data']['createpassword'] ?? null;
$confirmpassword = $_SESSION['signup-data']['confirmpassword'] ?? null;

// delete signup data session
unset($_SESSION['sign_up']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP & MySql Blog Application with Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- ===================CSS Style======================= -->
    <link rel="stylesheet" href="<?= ROOT_URL?>css/style.css">
</head>

<body>



    <section class="form_section">
        <div class="container form_section_container">
            <h2>Sign Up</h2>
            <?php if (isset($_SESSION['signup'])) : ?>
            <div class="alert_message error">
                <p>
                    <?= $_SESSION['signup'];
                    unset($_SESSION['signup']);
                    ?>
                </p>
            </div>
        <?php endif ?>

        <form action="<?= ROOT_URL ?>signup_logic.php" enctype="multipart/form-data" method="post">
            <input type="text" name="firstname" value="<?= $firstname ?>" placeholder="First Name">
            <input type="text" name="lastname" value="<?= $lastname ?>" placeholder="Last Name">
            <input type="text" name="username" value="<?= $username ?>" placeholder="Username">
            <input type="email" name="email" value="<?= $email ?>" placeholder="email">
            <input type="password" name="createpassword" value="<?= $createpassword ?>" placeholder="Create Password">
            <input type="password" name="confirmpassword" value="<?= $confirmpassword ?>" placeholder="Confirm Password">
            <div class="form_control">
                <label for="avatar">User Avatar</label>
                <input type="file" name="avatar" id="avatar">
            </div>
            <button class="btn" name="submit" submit">Sign Up</button>
            <small>Already have an account? <a href="signin.php">Sign In</a></small>
        </form>
        </div>
    </section>

</body>

</html>