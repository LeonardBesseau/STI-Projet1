<?php

include '../db_connect.php';

try {
    if (isset($file_db)) {
        // get message id passed through url
        $id = $_GET['id'];
        echo $id;
        // delete message from db
        $sql = $file_db->prepare("DELETE FROM messages WHERE id='$id'");
        $sql->execute();
        //redirect to inbox
        header('Location: ../view/inbox.php');
    }
} catch (PDOException $e) {
    // Close file database.sqlite connection
    $file_db = null;
    // Print PDOException message
    echo $e->getMessage();
}
