<?php
    session_start();
    $my_email = openssl_decrypt($_SESSION['token'], "AES-128-CTR", "11112000", 0, "1234567890123456");
    $pdo = new PDO('mysql:host=localhost;dbname=users', 'root', 'pwd');
    $q4 = $pdo->prepare("select * from chatters where email=?");
    $q4->bindValue(1, $my_email);
    $q4->execute();
    $res = $q4->fetch(PDO::FETCH_ASSOC);
    $my_number = $res['id'] % 70 + 1;
    if(strpos($_GET['with'], "r")===false) {
        $q = $pdo->prepare("select * from chatters where id=?");
        $q->bindValue(1, $_GET['with']);
        $q->execute();
        $r = $q->fetch(PDO::FETCH_ASSOC);
        $query = $pdo->prepare("select * from message where (sender=? and receiver=?) or (sender=? and receiver=?) order by date");
        $query->bindValue(1, $my_email);
        $query->bindValue(2, $r['email']);
        $query->bindValue(3, $r['email']);
        $query->bindValue(4, $my_email);
        $query->execute();
        $q3 = $pdo->prepare('update message set isRead=true where sender=? and receiver=? and isRead=false');
        $q3->bindValue(1, $r['email']);
        $q3->bindValue(2, $my_email);
        $q3->execute();
        $his_number = $r['id'] % 70 + 1;
        while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
            echo "<li class='" . ($result['sender'] == $my_email ? "sender" : "receiver") . "'>"
            . "<img src='https://i.pravatar.cc/150?img=" . ($result['sender'] == $my_email ? $my_number : $his_number) . "
            '/><span>" . $result['message'] . "</span>
            </li>";
        }
    }
    else {
        $query = $pdo->prepare("select * from message where receiver=?");
        $query->bindValue(1, $_GET['with']);
        $query->execute();
        $his_number = 0;
        while($result = $query->fetch(PDO::FETCH_ASSOC)) {
            if ($result['sender'] != $my_email) {
                $q7 = $pdo->prepare("select * from chatters where email=?");
                $q7->bindValue(1, $result['sender']);
                $q7->execute();
                $temp = $q7->fetch(PDO::FETCH_ASSOC);
                $his_number = $temp['id']%70 + 1;
            }
            echo "<li class='" . ($result['sender'] == $my_email ? "sender" : "receiver") . "'>"
            . "<img src='https://i.pravatar.cc/150?img=" . ($result['sender'] == $my_email ? $my_number : $his_number) . "'/>"
            . "<span>" . $result['message'] . "</span>" .
            "</li>";
        }
    }
    ?>
