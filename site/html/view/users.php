<?php
include '../db_connect.php';
include 'navigation.php';
session_start();
$email = $_SESSION['email'];

// Si l'utilisateur n'est pas connecté, on le redirige vers la page de login
if (!isset($_SESSION['email']) || $_SESSION['email'] != true) {
    header("location: login.php");
}
?>

<html>
<head>
    <title>PHP Test</title>
</head>
<body>
<?php echo '<p>Users management</p>';
?>
</body>
</html>