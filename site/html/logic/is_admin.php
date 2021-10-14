<?php
// Check if user is admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != true) {
    header("location: inbox.php");
}