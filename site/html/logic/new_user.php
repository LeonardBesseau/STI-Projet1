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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //get user credentials
    $email = $_POST['email'];
    $password = $_POST['pswd'];
    $active = $_POST['active'];
    $admin = $_POST['admin'];

    if (isset($file_db)) {
        //query to add user
        $sql = $file_db->prepare("INSERT INTO users VALUES (:email,:password,:active,:admin)");
        $sql->bindParam('email', $email);
        $sql->bindParam('password', $password);
        $sql->bindParam('active', $active);
        $sql->bindParam('admin', $admin);
        $result = $sql->execute();

        //verify if the user is valid and activ
        if (!empty($result)) {
            header('Location: ../view/users.php');
        } else {
            echo "Problem";
        }
    } else {
        echo 'Error: unable to connect to database';
    }
}
