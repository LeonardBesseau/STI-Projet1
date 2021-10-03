<?php
include '../db_connect.php';
session_start();
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/inbox.css"/>
</head>
<body>
    <div class="container">
        <h2 class="title">My inbox</h2>
        <?php
        if (isset($file_db)) {
            //query to fetch users messages
            $sql = $file_db->prepare("SELECT * FROM messages WHERE recipient = '$email' ORDER BY date DESC");
            $sql->execute();
            foreach ($sql->fetchAll() as $message) {
            ?>
            <div class="message_container">
                <div class="message">
                <div class="message_info">
                    <p class="sender">From: <?=$message['sender']?></p>
                    <div class="message_info2">
                        <p class="subject"><?=$message['subject']?></p>
                        <p><?=$message['date']?></p>
                    </div>
                </div>
                <div class="message_action">
                    <button class="button_open">Open</button>
                    <button class="button_respond">Respond</button>
                    <button class="button_delete">Delete</button>
                </div>
                </div>
            </div>
        <?php
        }
    }
    ?>


</div>
</body>
</html>