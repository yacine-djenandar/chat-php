<div class="padding-container">
    <h2>Rooms</h2>
    <div class="search">
        <i class="material-icons">search</i>
        <input type="search" name="search-rooms" id="search-rooms" placeholder="search for rooms that you are a member in" />
    </div>
    <div class="members-container">
        <?php
        $pdo = new PDO('mysql:host=localhost;dbname=users', 'root', 'sonicmario1');
        $query = $pdo->prepare("select * from rooms");
        $query->execute();
        $my_email = openssl_decrypt($_SESSION['token'], "AES-128-CTR", "11112000", 0, "1234567890123456");
        while ($result = $query->fetch(PDO::FETCH_ASSOC)) {
            $q = $pdo->prepare("select * from rooms_members where id_room=?");
            $q->bindValue(1,$result['id']);
            $q->execute();
            $b = true;
            while($r = $q->fetch(PDO::FETCH_ASSOC) and $b) {
                if($r['email']==$my_email) $b = false;
            }
            if(!$b) echo "<a href='dashbord.php?show=message&with=r".$result['id']."' class='member'>
            <i class='material-icons'>assignment_ind</i>
            <span class='member-name'>". $result['room_name']."</span>
        </a>";
        }
        ?>
    </div>
    <a href="add_room.php" class="add-room-btn">
        <i class="material-icons">add</i>
    </a>
</div>