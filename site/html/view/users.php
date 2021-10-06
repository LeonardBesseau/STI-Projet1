<?php
include '../db_connect.php';
include 'navigation.php';
session_start();
$email = $_SESSION['email'];

// Si l'utilisateur n'est pas connecté, on le redirige vers la page de login
if (!isset($_SESSION['email']) || $_SESSION['email'] != true) {
    header("location: login.php");
}

// Si l'utilisateur est un collaborateur, on le redirige sur l'inbox.
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != true) {
    header("location: inbox.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/inbox.css"/>
</head>
<body>
<div class="container">
    <h2 class="title">User management</h2>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Email</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (isset($file_db)) {
            $sql = $file_db->prepare("SELECT * FROM users");
        }
        $sql->execute();
        foreach ($sql->fetchAll() as $user) {
            ?>
            <tr>
                <td><?=$user['email']?></td>
                <td><?=$user['is_activ'] ? "active" : "inactive"?></td>
                <td><?=$user['is_admin'] ? "admin" : "collaborator"?></td>
                <td><a href="./user/modify_user.php?email=<?=$user['email']?>">Modify</a></td>
                <td><a href="./user/delete_user.php?email=<?=$user['email']?>">Delete</a></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <a href="./user/new_user.php" class="btn btn-dark">Add user</a>
</div>
</body>
</html>