<?php
    session_start();
    if(empty($_GET['show'])) {
        header("Location: dashbord.php?show=account");
    }
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
    <link rel="stylesheet" href="dashbord.css" />
    <title>Welcome Again!</title>
</head>

<body>
    <div class="left-bar-container">
        <a href="dashbord.php?show=account" class="left-bar-title">Chatly</a>
        <ul class="left-bar-list">
            <li>
                <a class="<?php echo $_GET['show']=="account" ? "on" : "" ; ?>" href="dashbord.php?show=account">
                    <i class="material-icons">account_circle</i>
                    My account
                </a>
            </li>
            <li>
                <a class="<?php echo $_GET['show']=="members" ? "on" : "" ; ?>" href="dashbord.php?show=members">
                    <i class="material-icons">account_box</i>
                    Members
                </a>
            </li>
            <li>
                <a class="<?php echo $_GET['show']=="rooms" ? "on" : "" ; ?>" href="dashbord.php?show=rooms">
                    <i class="material-icons">assignment_ind</i>
                    Rooms
                </a>
            </li>
            <li>
                <a class="<?php echo $_GET['show']=="new-messages" ? "on" : "" ; ?>" href="dashbord.php?show=new-messages">
                    <i class="material-icons">notifications</i>
                    New messages
                </a>
            </li>
        </ul>
    </div>
    <div class="right-side-container">
        <?php
            switch($_GET['show']) {
                case "account": 
                    include "account.php";
                    break;
                case "members":
                    include "members.php";
                    break;
                case "rooms":
                    include "rooms.php";
                    break;
                case "new-messages":
                    include "new_messages.php";
                    break;
                case "message":
                    include "chat.php";
                    break;
            };
        ?>
    </div>
</body>

</html>