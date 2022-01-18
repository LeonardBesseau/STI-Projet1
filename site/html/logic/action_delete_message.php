<?php

include '../db_connect.php';

session_start();
if (!(isset($_SESSION['email']))) {
    header("Location: /view/login.php");
    return;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //csrf protection
    $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
    if (!$token || $token !== $_SESSION['token']) {
        $_SESSION['error'] = "Not allowed";
        header('Location: ../view/inbox.php');
        exit;
    }
    $id = $_POST['id'];

    try {
        if (isset($file_db)) {
            // delete message from db
            $sql = $file_db->prepare("DELETE FROM messages WHERE id=:id and recipient = :recipient");
            $sql->bindParam('id', $id);
            $sql->bindParam('recipient', $_SESSION['email']);
            $sql->execute();
            //redirect to inbox
            header('Location: ../view/inbox.php');
        } else {
            echo 'Error: unable to connect to database';
            echo '<br/><a href="../view/inbox.php">Return</a>';
        }
    } catch (PDOException $e) {
        // Close file database.sqlite connection
        $file_db = null;
        // Print PDOException message
        echo $e->getMessage();
    }

}