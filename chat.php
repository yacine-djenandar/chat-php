<div class="chat-container">
    <div class="receiver-infos">
        <?php
            $pdo = new PDO('mysql:host=localhost;dbname=users', 'root', 'pwd');
            $my_email = openssl_decrypt($_SESSION['token'], "AES-128-CTR", "11112000", 0, "1234567890123456");
        if(strpos($_GET['with'], "r")===false) {
            $q4 = $pdo->prepare("select * from chatters where id=?");
            $q4->bindValue(1, (strpos($_GET['with'], "r")===false ? $_GET['with'] : 1));
            $q4->execute();
            $res = $q4->fetch(PDO::FETCH_ASSOC);
            $his_number = ($res['id'] % 70) + 1;
            echo "<img src='https://i.pravatar.cc/150?img=".$his_number."'/>
                <span>".$res['first_name']." ".$res['last_name']."</span>";
        }
        else {
            $rnq = $pdo->prepare('select * from rooms where id=?');
            $rnq->bindValue(1, explode("r", $_GET['with'])[1]);
            $rnq->execute();
            $room = $rnq->fetch(PDo::FETCH_ASSOC);
            echo "<img src='https://www.shareicon.net/data/512x512/2016/06/30/788858_group_512x512.png'/>
                <span>".$room['room_name']."</span>";
        }
        ?>
    </div>
    <ul class="chat-history" id="chat-list">
        <?php
        $my_email = openssl_decrypt($_SESSION['token'], "AES-128-CTR", "11112000", 0, "1234567890123456");
        $pdo = new PDO('mysql:host=localhost;dbname=users', 'root', 'sonicmario1');
        $q4 = $pdo->prepare("select * from chatters where email=?");
        $q4->bindValue(1, $my_email);
        $q4->execute();
        $res = $q4->fetch(PDO::FETCH_ASSOC);
        $my_number = $res['id'] % 70 + 1;
        if (strpos($_GET['with'], "r") === false) {
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
                    . "<img src='https://i.pravatar.cc/150?img=" . ($result['sender'] == $my_email ? $my_number : $his_number)."'/><span>" . $result['message'] . "</span>
                    </li>";
            }
        } else {
            $qs = $pdo->prepare("select * from message where receiver=?");
            $qs->bindValue(1, $_GET['with']);
            $qs->execute();
            while ($result = $qs->fetch(PDO::FETCH_ASSOC)) {
                $his_number = 0;
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
    </ul>
    <div class="msg-container" id="ex">
        <textarea rows="1" placeholder="Write your message!" type="text" id="message" name="message" class="msg-input"></textarea>
        <button onclick="sendMessage()" class="send-btn">
            <i class="material-icons">send</i>
        </button>
    </div>
</div>

<script>
    document.getElementsByClassName('chat-history')[0].scrollTop = document.getElementsByClassName('chat-history')[0].scrollHeight;
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            if (this.responseText == "sent") {
                setTimeout(() => document.getElementsByClassName('chat-history')[0].scrollTop = document.getElementsByClassName('chat-history')[0].scrollHeight, 300);
            } else if (this.responseText) {
                document.getElementById('chat-list').innerHTML = this.responseText;
            }
        }
    }

    function sendMessage() {
        xmlhttp.open('GET', 'handle_message_send.php?with=' + new URLSearchParams(window.location.search).get('with') + "&message=" + document.getElementById('message').value, true);
        xmlhttp.send();
        document.getElementById('message').value = "";
        document.getElementsByClassName('chat-history')[0].scrollTop = document.getElementsByClassName('chat-history')[0].scrollHeight;
    }

    function refresh() {
        xmlhttp.open('GET', "refresh_messages.php?with=" + new URLSearchParams(window.location.search).get('with'), true);
        xmlhttp.send();
    }

    let id = setInterval(() => refresh(), 300);
</script>
