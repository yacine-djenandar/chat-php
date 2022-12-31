<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=users', 'root', "sonicmario1");
$my_email = openssl_decrypt($_SESSION['token'], "AES-128-CTR", "11112000", 0, "1234567890123456");
$message = $_GET['message'];
$sender = $my_email;
$q = null;
$receiver = null;
if (strpos($_GET['with'], "r") === false) { 
    $q = $pdo->prepare("select * from chatters where id=?");
    $q->bindValue(1, $_GET['with']);
    $q->execute();
    $r = $q->fetch(PDO::FETCH_ASSOC);
    $receiver = $r['email'];
}
else {
    $receiver = $_GET['with'];
}
$query = $pdo->prepare('insert into message(sender, receiver, message, date, isRead) values (?,?,?,NOW(),false)');
$query->bindValue(1, $sender);
$query->bindValue(2, $receiver);
$query->bindValue(3, $message);
$bool = $query->execute();
if ($bool) {
    echo "sent";
} else echo false;
