<!DOCTYPE html>
<html lang="en">
<head>
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
            <div class="g-recaptcha" data-sitekey="6LcMMRYeAAAAAMN-yVTC-44p2BzRQtRISRH2RbAn"></div>
            <br>
            <button type="submit">Login</button>
        </div>
    </form>
</div>
</body>
</html>