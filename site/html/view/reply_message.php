<?php
include '../db_connect.php';
include '../logic/session.php';
include 'navigation.php';

// get variables
$recipient = $_POST['recipient'];
$subject = $_POST['subject'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/reply_message.css"/>
</head>
<body>
<div class="container">
    <h2 class="title">My response</h2>

    <form action="../logic/action_send_message.php" method="post">
        <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
        <div class="form_container">
            <label for="email"><b>To: <?= $recipient ?></b></label>
            <input type="hidden" name="recipient" value="<?= $recipient ?>"/>
            <input type="hidden" name="subject" value="<?= $subject ?>"/>

            <textarea name="body" placeholder="Enter Message" rows="5" cols="30"></textarea>
            <input class="button" type="submit" value="Send"/>
        </div>

    </form>
</div>
</body>