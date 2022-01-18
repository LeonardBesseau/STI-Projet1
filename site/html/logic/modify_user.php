<?php
session_start();
include '../db_connect.php';

if (!(isset($_SESSION['email']))) {
    header("Location: /view/login.php");
    return;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //csrf protection
    $token = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
    if (!$token || $token !== $_SESSION['token']) {
        $_SESSION['error'] = "Not allowed";
        header('Location: ../view/users.php');
        exit;
    }

    //get user credentials
    $email = $_POST['email'];
    $password = $_POST['pswd'];
    $active = $_POST['active'];
    $admin = $_POST['admin'];

    $changePassword = false;

    // if password is edited
    if (!empty($password)) {
        if (preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#", $password)) {
            if (isset($file_db)) {
                $sql = $file_db->prepare("UPDATE users SET password=:password WHERE email=:email");
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql->bindParam('password', $hash);
                $sql->bindParam('email', $email);
                $result = $sql->execute();
            } else {
                echo 'Error: unable to connect to database';
                echo '<br/><a href="../view/users.php">Return</a>';
            }
        } else {
            $changePassword = true;
            $_SESSION['error'] = "Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter and one special character.";
            header('Location: ../view/edit_user.php?email=' . $email);
        }
    }

    if (isset($file_db) && !$changePassword) {
        //query to add user
        $sql = $file_db->prepare("UPDATE users SET is_activ=:active, is_admin=:admin WHERE email=:email");
        $sql->bindParam('active', $active);
        $sql->bindParam('admin', $admin);
        $sql->bindParam('email', $email);
        $result = $sql->execute();
        header('Location: ../view/users.php');
    }
} else {
    echo 'Error: unable to connect to database';
}

