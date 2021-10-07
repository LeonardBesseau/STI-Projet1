<?php

include '../db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //get user credentials
    $email = $_POST['email'];
    $password = $_POST['pswd'];
    $active = $_POST['active'];
    $admin = $_POST['admin'];

    if (isset($file_db)) {
        //query to add user
        $sql = $file_db->prepare("INSERT INTO users VALUES ('$email','$password','$active','$admin')");
        $result = $sql->execute();
        
        //verify if the user is valid and activ
        if (!empty($result)) {
            header('Location: ../view/users.php');
        } else {
            //redirect to login page
            //header('Location: ../view/login.php');
            echo "Problem";
        }
    } else {
        echo 'Error: unable to connect to database';
    }
}
