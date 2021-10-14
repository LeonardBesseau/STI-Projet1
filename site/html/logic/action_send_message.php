<?php
include '../db_connect.php';
include 'session.php';

$sender = $_SESSION['email'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // get variables
    $recipient = $_POST['recipient'];
    $subject = $_POST['subject'];
    $subject = str_replace("'", "''", $subject);
    $body = $_POST['body'];
    $body = str_replace("'", "''", $body);
    date_default_timezone_set('Europe/Zurich');
    $date = date('d/m/Y h:i:s', time());

    try {
        if (isset($file_db)) {
            // query to send users message
            $sql = $file_db->prepare("INSERT INTO messages (subject, body, sender, recipient, date) VALUES ('$subject', '$body', '$sender', '$recipient', '$date')");
            $sql->execute();
            //redirect to inbox
            header('Location: ../view/inbox.php');
        } else {
            echo 'Error: unable to send message';
        }
    } catch (PDOException $e) {
        // Close file database.sqlite connection
        $file_db = null;
        // Print PDOException message
        echo $e->getMessage();
    }
}

?>


