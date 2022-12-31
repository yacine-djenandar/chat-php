<?php
session_start();
$my_email = openssl_decrypt($_SESSION['token'], "AES-128-CTR", "11112000", 0, "1234567890123456");
$pdo = new PDO('mysql:host=localhost;dbname=users', 'root', 'pwd');
if (!empty($_POST['user'])) {
  $room_name = $_POST['room_name'];
  $q = $pdo->prepare('insert into rooms(room_name) values (?)');
  $q->bindValue(1, $room_name);
  $q->execute();
  $q = $pdo->prepare('select * from rooms');
  $q->execute();
  $n = 0;
  while ($result = $q->fetch(PDO::FETCH_ASSOC)) {
    if ($n < $result['id']) $n = $result['id'];
  }
  $q4 = $pdo->prepare("select * from chatters where email=?");
  $q4->bindValue(1, $my_email);
  $q4->execute();
  $r = $q4->fetch(PDO::FETCH_ASSOC);
  $qs = $pdo->prepare('insert into rooms_members (id_room, first_name, last_name, email) values (?,?,?,?)');
  $qs->bindValue(1, $n);
  $qs->bindValue(2, $r['first_name']);
  $qs->bindValue(3, $r['last_name']);
  $qs->bindValue(4, $r['email']);
  $qs->execute();
  foreach ($_POST['user'] as $value) {
    $query = $pdo->prepare("select * from chatters where email=?");
    $query->bindValue(1, $value);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $q2 = $pdo->prepare('insert into rooms_members (id_room, first_name, last_name, email) values (?,?,?,?)');
    $q2->bindValue(1, $n);
    $q2->bindValue(2, $result['first_name']);
    $q2->bindValue(3, $result['last_name']);
    $q2->bindValue(4, $result['email']);
    $q2->execute();
  }
  header("Location: dashbord.php?show=rooms");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chat App</title>
  <link rel="stylesheet" href="add_room.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body>
  <div class="wrapper">
    <section class="users">
      <form action="add_room.php" method="POST">
        <header>
          <div class="content">
            <img src="https://www.shareicon.net/data/512x512/2016/06/30/788858_group_512x512.png" style="object-fit: contain;" alt="">
            <div class="details">
              <div class="input-data">
                <input name="room_name" required type="text" placeholder="Room name">
              </div>
            </div>
        </header>
        <div class="users-list">
          <?php
          $my_email = openssl_decrypt($_SESSION['token'], "AES-128-CTR", "11112000", 0, "1234567890123456");
          $pdo = new PDO('mysql:host=localhost;dbname=users', 'root', 'sonicmario1');
          $q = $pdo->prepare("select * from chatters where not email=?");
          $q->bindValue(1, $my_email);
          $q->execute();
          while ($result = $q->fetch()) {
            $nom = $result['first_name'] . " " . $result['last_name'];
            echo "<a>
              <div class='content'>
                <img src='https://w7.pngwing.com/pngs/613/636/png-transparent-computer-icons-user-profile-male-avatar-avatar-heroes-logo-black-thumbnail.png' alt=''>
                <div class='details'>
                  <div class='pretty p-default p-round'>
                    <input type='checkbox' id='" . $nom . "' name='user[]' value='" . $result['email'] . "' />
                    <div class='state p-success-o'> 
                      <label for='" . $nom . "'>"
              . $nom .
              "</label>
                    </div>
                  </div>
                </div>
              </div>
            </a>";
          }
          ?>
        </div>
        <footer>
          <input type="submit" value="Create room" href="" class="create" />
        </footer>
      </form>
    </section>
  </div>
</body>

</html>
