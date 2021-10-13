<?php

include '../db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //get user credentials
    $email = $_POST['email'];
    $password = $_POST['pswd'];

    try {
        if (isset($file_db)) {
            //query to fetch user
            $sql = $file_db->prepare("SELECT * FROM users WHERE email = '$email' and password = '$password'");
            $sql->execute();
            $result = $sql->fetch();
            //verify if the user is valid and activ
            if (!empty($result) && $result['is_activ']) {
                //create session and redirect to user inbox
                session_start();
                $_SESSION['email'] = $result['email'];
                $_SESSION['is_admin'] = $result['is_admin'];
                header('Location: ../view/inbox.php');
            } else {
                //redirect to login page
                header('Location: ../view/login.php');
            }
        } else {
            echo 'Error: unable to connect to database';
        }
    } catch (PDOException $e) {
        // Close file database.sqlite connection
        $file_db = null;
        // Print PDOException message
        echo $e->getMessage();
    }
}

