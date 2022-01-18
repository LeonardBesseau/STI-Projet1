<?php
session_start();
include '../db_connect.php';


if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['g-recaptcha-response'])) {

    //get user credentials
    $email = $_POST['email'];
    $password = $_POST['pswd'];

    try {
        $secret = '6LcMMRYeAAAAAPdcZI7JQ1j-cM5ury_SRU3phglw'; //challenge for reCAPTCHA
        //verify challenge
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);

        //verify reCAPTCHA
        if ($responseData->success) {
            if (isset($file_db)) {
                //query to fetch user
                $sql = $file_db->prepare("SELECT * FROM users WHERE email = :email AND is_activ");
                $sql->bindParam('email', $email);
                $sql->execute();
                $result = $sql->fetch();
                $hashed_password = $result["password"];

                //verify if the user is valid and activ
                if (!empty($result) && password_verify($password, $hashed_password)) {
                    //create session and redirect to user inbox
                    $_SESSION['email'] = $result['email'];
                    $_SESSION['is_admin'] = $result['is_admin'];
                    $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
                    header('Location: ../view/inbox.php');
                } else {
                    $_SESSION['error'] = "Wrong email or password or user is disabled";
                    header('Location: ../view/login.php');
                }
            } else {
                echo 'Error: unable to connect to database';
                echo '<br/><a href="../view/login.php">Return</a>';
            }
        } else {
            $_SESSION['error'] = "reCAPTCHA error";
            header('Location: ../view/login.php');
        }
    } catch (PDOException $e) {
        // Close file database.sqlite connection
        $file_db = null;
    }
} else {
    $_SESSION['error'] = "reCAPTCHA error";
    header('Location: ../view/login.php');
}

