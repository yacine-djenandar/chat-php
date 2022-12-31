<?php
    $pdo = new PDO('mysql:host=localhost;dbname=users','root','sonicmario1');
    $query = $pdo->prepare("update chatters set isConfirmed=true where email=?");
    $query->bindValue(1,$_GET['email']);
    $query->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="confirm.css">
    <title>Email confirmed with success</title>
</head>
<body>
    <h1>Your email address <?php $email=$_GET['email']; echo "<i>$email</i>"; ?> has been confirmed with success</h1>
    <a href="login.php">Log in</a>
</body>
</html>