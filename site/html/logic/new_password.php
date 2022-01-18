<?php
session_start();
include '../db_connect.php';

if (!(isset($_SESSION['email']))) {
    header("Location: /view/login.php");
    return;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
    if (!$token || $token !== $_SESSION['token']) {
        // return 405 http status code
        header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
        exit;
    }

    //get user credentials
    $email = $_SESSION['is_admin'] ? $_POST['email'] : $_SESSION['email'];;
    $password = $_POST['pswd'];

    if (!empty($password)) {
        if (preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password)) {

            if (isset($file_db)) {
                error_reporting(E_ALL);
                ini_set("display_errors", 1);
                $sql = $file_db->prepare("UPDATE users SET password=:password WHERE email=:email");
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql->bindParam('password', $hash);
                $sql->bindParam('email', $email);
                $result = $sql->execute();
                header('Location: ../view/inbox.php');
            }
        } else {
            $_SESSION['error'] = "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
            header('Location: ../view/password.php');
        }
    }

} else {
    echo 'Error: unable to connect to database';
}

