<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/login.css"/>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<div class="container">
    <h2 class="title">Login</h2>

    <form action="../logic/action_login.php" method="post">
        <div class="form_container">
            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Enter Email" name="email" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="pswd" required>
            <?php if (isset($_SESSION['error']) && !empty($_SESSION['error'])) : ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['error'];
                    $_SESSION['error'] = '';
                    ?>
                </div>
            <?php endif; ?>
            <div class="g-recaptcha" data-sitekey="6LcMMRYeAAAAAMN-yVTC-44p2BzRQtRISRH2RbAn"></div>
            <br>
            <button type="submit">Login</button>
        </div>
    </form>
</div>
</body>
</html>