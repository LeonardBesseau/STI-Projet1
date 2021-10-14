<?php
session_start();
$email = $_SESSION['email'];
// check if user is logged
if (!isset($_SESSION['email']) || $_SESSION['email'] != true) {
    header("location: login.php");
}