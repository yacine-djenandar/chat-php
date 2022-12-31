<?php
    $my_email = openssl_decrypt($_SESSION['token'], "AES-128-CTR", "11112000", 0, "1234567890123456");
    $pdo = new PDO('mysql:host=localhost;dbname=users','root','sonicmario1');
    $query = $pdo->prepare("select * from chatters where email=?");
    $query->bindValue(1, $my_email);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $number = $result['id']%70 + 1;
    echo "<div class='account-container'>
    <h1 class='username'>My account</h1>
    <div class='account-infos-container'>
        <img src='https://i.pravatar.cc/1000?img=".$number."'/>
        <div class='account-infos'>
            <span class='fullname'>".$result['first_name']." ".$result['last_name']."</span>
            <span class='email'>".$result['email']."</span>
            <button class='logout' onclick='logout()'>
                Logout
            </button>
        </div>
    </div>
</div>"
?>

<script>
    function logout() {
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if(this.status==200 && this.readyState==4) {
                console.log(this.response);
                window.location.href = "login.php"
            }
        }
        xmlhttp.open('GET', 'logout.php', true);
        xmlhttp.send();
    }
</script>