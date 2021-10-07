<?php
include '../db_connect.php';
include 'navigation.php';
session_start();
$email = $_SESSION['email'];

// Si l'utilisateur n'est pas connecté, on le redirige vers la page de login
if (!isset($_SESSION['email']) || $_SESSION['email'] != true) {
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/login.css"/>
</head>
<body>
<div class="container">
    <h2 class="title">Add new user</h2>

    <form action="../logic/new_user.php" method="post">
        <div class="form_container">
            <label for="email"><b>Email</b></label>
            <input type="email" placeholder="Enter Email" name="email" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="pswd" required>

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

            <button type="submit">Add</button>
        </div>
    </form>
</div>
</body>
</html>