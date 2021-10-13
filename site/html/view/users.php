<?php
include '../db_connect.php';
include '../logic/session.php';
include '../logic/is_admin.php';
include 'navigation.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="css/inbox.css"/>
</head>
<body>
<div class="container">
    <h2 class="title">User management</h2>
    <a href="add_user.php" class="btn btn-dark">Add user</a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Email</th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (isset($file_db)) {
            $sql = $file_db->prepare("SELECT * FROM users");
        }
        $sql->execute();
        foreach ($sql->fetchAll() as $email) {
            ?>
            <tr>
                <td><?= $email['email'] ?></td>
                <td><?= $email['is_activ'] ? "active" : "inactive" ?></td>
                <td><?= $email['is_admin'] ? "admin" : "collaborator" ?></td>
                <td><a href="edit_user.php?email=<?php echo $email['email']; ?>">Edit</a></td>
                <td><a href="../logic/delete_user.php?email=<?php echo $email['email']; ?>">Delete</a></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>

</div>
</body>
</html>