<div class="ch-container">
    <h1>New messages</h1>
    <?php
        $pdo = new PDO('mysql:host=localhost;dbname=users', 'root', 'pwd');
        $query = $pdo->prepare("select * from message where receiver=? and isRead=false order by date");
        $query->bindValue(1, openssl_decrypt($_SESSION['token'], "AES-128-CTR", "11112000", 0, "1234567890123456"));
        $query->execute();
        while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
            $q2 = $pdo->prepare("select * from chatters where email=?");
            $q2->bindValue(1, $result['receiver']);
            $q2->execute();
            $r = $q2->fetch();
            echo "<a href='dashbord?show=message&with=".$r['id']."' class='ch-element'>
            <img src='https://i.pravatar.cc/150?img=69' />
            <span>".$r['first_name']." ".$r['last_name']."</span>
            <p>".$result['message']."</p>
        </a>";
        }
    ?>
</div>
