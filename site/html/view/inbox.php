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
            $id = $message['id']
            ?>
            <div class="message_container">
                <div class="message">
                    <div class="message_info">
                        <p class="sender">From: <?= $message['sender'] ?></p>
                        <div class="message_info2">
                            <p class="subject">Subject: <?= $message['subject'] ?></p>
                            <p><?= $message['date'] ?></p>
                        </div>
                        <p id="message_body"></p>
                    </div>
                    <div class="message_action">
                        <button class="button_open" onclick="document.getElementById('message_body').innerHTML = '<?php echo $message['body'];?>'">Open</button>
                        <button class="button_respond" onclick="window.location.href='./open_message.php?id=<?php echo $message['id'];?>'">Respond</button>
                        <button class="button_delete" onclick="window.location.href='../logic/delete_message.php?id=<?php echo $message['id'];?>'">Delete</button>
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