<?php
    session_start();
    $email = $_POST['email'];
    $password = $_POST['password'];
    $pdo = new PDO('mysql:host=localhost;dbname=users','root','pwd');
    $query = $pdo->prepare("select * from chatters where email=? and password=?");
    $query->bindValue(1,$email);
    $query->bindValue(2,$password);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if(empty($result)) {
        echo "error";
    }
    else if(!$result['isConfirmed']) {
        echo "confirm";
    }
    else {
        $_SESSION['token'] = openssl_encrypt($_POST['email'], "AES-128-CTR", "11112000", 0, "1234567890123456");
        $q2 = $pdo->prepare('update chatters set connected=true where email=?');
        $q2->bindValue(1, $email);
        $q2->execute();
        echo true;
    }
?>
