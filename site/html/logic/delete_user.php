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
//csrf protection
$token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_STRING);
if (!$token || $token !== $_SESSION['token']) {
    $_SESSION['error'] = "Not allowed";
    header('Location: ../view/users.php');
    exit;
}

try {
    if (isset($file_db)) {
        // get user email passed through url
        $email = $_GET['email'];

        if ($email != $_SESSION['email']) {
            // delete user from db
            $sql = $file_db->prepare("DELETE FROM users WHERE email=:email");
            $sql->bindParam('email', $email);
            $sql->execute();
            //redirect to users management
            header('Location: ../view/users.php');
        } else {
            $_SESSION['error'] = "You can't delete yourself";
            header('Location: ../view/users.php');
        }
    } else {
        echo 'Error: unable to connect to database';
        echo '<br/><a href="../view/users.php">Return</a>';
    }
} catch (PDOException $e) {
    // Close file database.sqlite connection
    $file_db = null;
    // Print PDOException message
    echo $e->getMessage();
}