<?php

include '../db_connect.php';
include '../logic/session.php';
include 'navigation.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/new_message.css"/>
</head>
<body>
<div class="container">
    <h2 class="title">Message</h2>

    <form action="../logic/action_send_message.php" method="post">
        <div class="form_container">

            <label for="email"><b>To</b></label>
            <select name="recipient">
            <?php
            if (isset($file_db)) {
                // query to fetch users messages
                $sql = $file_db->prepare("SELECT email FROM users");
                $sql->execute();
                // display users messages
                foreach ($sql->fetchAll() as $result) {
            ?>
                <option value="<?= $result['email'] ?>"><?= $result['email'] ?></option>
            <?php
                }
            }
            ?>
                </select>
            <label for="subject"><b>Subject</b></label>
            <input type="text" placeholder="Enter Subject" name="subject" required>

            <label for="message"><b>Message</b></label>
            <textarea name="body" placeholder="Enter Message" rows="5" cols="30"></textarea>

            <button type="submit">Send</button>
        </div>
    </form>
</div>
</body>
</html>