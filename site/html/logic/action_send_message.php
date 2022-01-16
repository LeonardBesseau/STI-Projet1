<?php
include 'session.php';
include '../db_connect.php';


session_start();
if (!(isset($_SESSION['email']))) {
    header("Location: /view/login.php");
    return;
}

$sender = $_SESSION['email'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
    if (!$token || $token !== $_SESSION['token']) {
        // return 405 http status code
        header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
        exit;
    }
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
            $sql = $file_db->prepare("INSERT INTO messages (subject, body, sender, recipient, date) VALUES (:subject,:body,:sender,:recipient,:date)");
            $htmlspecialchars = htmlspecialchars($subject, ENT_QUOTES, 'UTF-8');
            $sql->bindParam('subject', $htmlspecialchars);
            $htmlspecialchars = htmlspecialchars($body, ENT_QUOTES, 'UTF-8');
            $sql->bindParam('body', $htmlspecialchars);
            $sql->bindParam('sender', $sender);
            $sql->bindParam('recipient', $recipient);
            $sql->bindParam('date', $date);
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
