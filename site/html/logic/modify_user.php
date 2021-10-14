<?php

include '../db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //get user credentials
    $email = $_POST['email'];
    $password = $_POST['pswd'];
    $active = $_POST['active'];
    $admin = $_POST['admin'];

    // if password is edited
    if (!empty($password)) {
        if (isset($file_db)) {
            $sql = $file_db->prepare("UPDATE users SET password='$password' WHERE email='$email'");
        }
        $result = $sql->execute();
    }

    if (isset($file_db)) {
        //query to add user
        $sql = $file_db->prepare("UPDATE users SET is_activ='$active', is_admin='$admin' WHERE email='$email'");
        $result = $sql->execute();
    }

    //verify if the user is valid and activ
    header('Location: ../view/users.php');

} else {
    echo 'Error: unable to connect to database';
}

