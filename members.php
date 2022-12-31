<div class="padding-container">
    <h2>Members</h2>
    <div class="search">
        <i class="material-icons">search</i>
        <input type="search" name="search-members" id="search-members" placeholder="search for members"/>
    </div>
    <div class="members-container">
        <?php
            $pdo = new PDO('mysql:host=localhost;dbname=users','root','pwd');
            $query = $pdo->prepare("select * from chatters where email!=?");
            $my_email = openssl_decrypt($_SESSION['token'], "AES-128-CTR", "11112000", 0, "1234567890123456");
            $query->bindValue(1, $my_email);
            $query->execute();
            while($result = $query->fetch(PDO::FETCH_ASSOC)) {
                $number = $result['id']%70 + 1;
                echo "<a href='dashbord.php?show=message&with=".$result['id']."' class='member ".
                 ($result['connected'] ? "online": "offline")."'>
                <img src='https://i.pravatar.cc/150?img=".$number."'/>
                <span class='member-name'>".$result['first_name']." ".$result['last_name']."</span>
            </a>";
            }
        ?>
    </div>
</div>
