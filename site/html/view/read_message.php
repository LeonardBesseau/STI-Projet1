<?php
include '../db_connect.php';
include 'navigation.php';

// check if user is logged
session_start();
$email = $_SESSION['email'];
if (!isset($_SESSION['email']) || $_SESSION['email'] != true) {
    header("location: login.php");
}

//get variable
$id = $_POST['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/read_message.css"/>
</head>
<body>
<div class="container">
    <h2 class="title">My message</h2>
    <?php
    if (isset($file_db)) {
        // query to fetch users message
        $sql = $file_db->prepare("SELECT * FROM messages WHERE id = '$id'");
        $sql->execute();
        $message = $sql->fetch();
        ?>

        <div class="message_container">
            <div class="message">
            <p class="sender">From: <?= $message['sender'] ?></p>
            <div class="message_info">
                <p class="subject">Subject: <?= $message['subject'] ?></p>
                <p><?= $message['date'] ?></p>
            </div>
            <p><?= $message['body'] ?></p>
            </div>
        </div>

        <?php
    }
    ?>
</div>
</body>
</html>