<?php

include '../db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    try {
        if (isset($file_db)) {
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

}