<?php

include '../db_connect.php';

session_start();
if (!(isset($_SESSION['email']))) {
    header("Location: /view/login.php");
    return;
}

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != true) {
    header("location: inbox.php");
}

$token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_STRING);
if (!$token || $token !== $_SESSION['token']) {
    // return 405 http status code
    echo
    exit;
}

try {
    if (isset($file_db)) {
        // get user email passed through url
        $email = $_GET['email'];
        echo $email;
        // delete user from db
        $sql = $file_db->prepare("DELETE FROM users WHERE email=:email");
        $sql->bindParam('email', $email);
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