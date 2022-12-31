<?php
    session_start();
    $email = openssl_decrypt($_SESSION['token'], "AES-128-CTR", "11112000", 0, "1234567890123456");
    $pdo = new PDO('mysql:host=localhost;dbname=users','root','sonicmario1');
    $query = $pdo->prepare("select * from chatters where email=?");
    $query->bindValue(1,$email);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if(empty($result)) {
        session_unset();
        session_destroy();
        header('Location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatly | Home page</title>
</head>
<body>
    <h1>Welcome to the home page sonic the: 
        <?php 
            echo $result['first_name'];
        ?>
    </h1>
</body>
</html>