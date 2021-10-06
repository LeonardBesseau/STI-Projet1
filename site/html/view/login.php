<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/login.css"/>
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
            <button type="submit">Login</button>
        </div>
    </form>
</div>
</body>
</html>