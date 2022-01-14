<?php
include '../logic/session.php';
include '../db_connect.php';

include '../logic/is_admin.php';
include 'navigation.php';

$value = $_GET['email'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/login.css"/>
</head>
<body>
<div class="container">
    <h2 class="title">Edit user</h2>

    <form action="../logic/modify_user.php" method="post">
        <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
        <div class="form_container">
            <label for="email"><b>Email</b></label>
            <input type="text" name="email" readonly class="form-control" value="<?= $value ?>" " >

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="pswd">
            <?php if (isset($_SESSION['error']) && !empty($_SESSION['error'])) : ?>
                <div class="alert alert-danger">
                    <?php echo $_SESSION['error'];
                    $_SESSION['error'] = '';
                    ?>
                </div>
            <?php endif; ?>

            <label for="active"><b>Active?</b></label>
            <select name="active">
                <option value="1">Yes</option>
                <option value="0" selected>No</option>
            </select>

            <label for="admin"><b>Admin?</b></label>
            <select name="admin">
                <option value="1">Yes</option>
                <option value="0" selected>No</option>
            </select>

            <button type="submit">Ok</button>
        </div>
    </form>
</div>
</body>
</html>