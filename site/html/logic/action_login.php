<?php include "../dbConnect.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = $file_db->prepare("SELECT * FROM Person WHERE `email` = ?");
    $sql->execute([$email]);
    $result = $sql->fetch();

    if (!empty($result) && $result['validity'] && $password == $result['password']) {
        echo "youpi";
    } else {
        echo "probleme";
    }

    echo "User:" . $_POST['username'] . "<br/>";
    echo $email . "<br/>";
    /*
        if ($email == $result['email'] && $password == $result['password']) {
            // User exists
            $numrows = $file_db->query('SELECT Count(*) FROM $result');
            if ($numrows != 0) {
            header('Location: helloworld.php');
            echo "User exist";

            } else {
                 header('Location: authentication.php');
                 echo "User doesn't exist";
                 //die("That user doesn't exist!");
             }


        } else
            echo "error";
        //die("ERROR");


    } else {
        // $username = "";
        // $password = "";
    }
    */
}
?>