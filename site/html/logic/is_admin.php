<?php
// Si l'utilisateur est un collaborateur, on le redirige sur l'inbox.
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != true) {
    header("location: inbox.php");
}