<?php
include '../db_connect.php';
include '../logic/session.php';
include 'navigation.php';


$email = $_SESSION['email'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/inbox.css"/>
    <meta charset="ISO-8859-1">
</head>
<body>

<div class="container">

    <div class="header">
        <h2 class="title">My inbox</h2>
        <button type="button" onclick="window.location.href='./new_message.php'">New message</button>
    </div>

    <?php
    if (isset($file_db)) {
        // query to fetch users messages
        $sql = $file_db->prepare("SELECT * FROM messages WHERE recipient = :email ORDER BY date DESC");
        $sql->bindParam('email', $email);
        $sql->execute();
        // display users messages
        foreach ($sql->fetchAll() as $message) {
            ?>
            <div class="message_container">
                <div class="message">
                    <div class="message_info">
                        <p class="sender">From: <?= $message['sender'] ?></p>
                        <div class="message_info2">
                            <p class="subject">Subject: <?= $message['subject'] ?></p>
                            <p><?= $message['date'] ?></p>
                        </div>
                    </div>

                    <div class="message_action">
                        <form action="./read_message.php" method="post">
                            <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
                            <input type="hidden" name="id" value="<?= $message['id'] ?>"/>
                            <input type="submit" class="button_open" value="open"/>
                        </form>
                        <form action="./reply_message.php" method="post">
                            <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
                            <input type="hidden" name="recipient" value="<?= $message['sender'] ?>"/>
                            <input type="hidden" name="subject" value="<?= $message['subject'] ?>"/>
                            <input type="submit" class="button_open" value="reply"/>
                        </form>
                        <form action="../logic/action_delete_message.php" method="post">
                            <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
                            <input type="hidden" name="id" value="<?= $message['id'] ?>"/>
                            <input type="submit" class="button_open" value="delete"/>
                        </form>
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