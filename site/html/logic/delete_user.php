<?php

include '../db_connect.php';

try {
    if (isset($file_db)) {
        // get user email passed through url
        $email = $_GET['email'];
        echo $email;
        // delete user from db
        $sql = $file_db->prepare("DELETE FROM users WHERE email='$email'");
        $sql->execute();
        //redirect to users management
        header('Location: ../view/users.php');
    }
} catch (PDOException $e) {
    // Close file database.sqlite connection
    $file_db = null;
    // Print PDOException message
    echo $e->getMessage();
}