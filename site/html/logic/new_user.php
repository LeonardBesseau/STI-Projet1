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

    $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
    if (!$token || $token !== $_SESSION['token']) {
        // return 405 http status code
        header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
        exit;
    }

    //get user credentials
    $email = $_POST['email'];
    $password = $_POST['pswd'];
    $active = $_POST['active'];
    $admin = $_POST['admin'];

    if (isset($file_db)) {
        //verify if user already exist
        $request = "SELECT * FROM users WHERE email = :email";
        $query = $file_db->prepare($request);
        $query->bindParam(':email', $email);
        $query->execute();

        $results = $query->fetch();
        if (empty($results['email'])) {

            //query to add user
            if (preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password)) {
                $sql = $file_db->prepare("INSERT INTO users VALUES (:email,:password,:active,:admin)");
                $htmlspecialchars = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql->bindParam('email', $htmlspecialchars);
                $sql->bindParam('password', $hash);
                $sql->bindParam('active', $active);
                $sql->bindParam('admin', $admin);
                $result = $sql->execute();

                //verify if the user is valid and activ
                if (!empty($result)) {
                    header('Location: ../view/users.php');
                } else {
                    $_SESSION['error'] = "Error";
                    header('Location: ../view/add_user.php');
                }
            } else {
                $_SESSION['error'] = "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
                header('Location: ../view/add_user.php');
            }
        } else {
            $_SESSION['error'] = "User already exists";
            header('Location: ../view/add_user.php');
        }
    } else {
        echo 'Error: unable to connect to database';
    }
}
