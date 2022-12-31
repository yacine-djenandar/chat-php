<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    
    $pdo = new PDO('mysql:host=localhost;dbname=users','root','pwd');
    $query = $pdo->prepare("select * from chatters where email=?");
    $query->bindValue(1,$_POST['email']);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if(empty($result)) {
        $addUsersQuery = $pdo->prepare("insert into chatters(first_name, last_name, email, password, isConfirmed, connected) values (?, ?, ?, ?, false, false)");
        $addUsersQuery->bindValue(1,$_POST['first_name']);
        $addUsersQuery->bindValue(2,$_POST['last_name']);
        $addUsersQuery->bindValue(3,$_POST['email']);
        $addUsersQuery->bindValue(4,$_POST['password']);
        $addUsersQuery->execute();
        
    require_once "vendor/autoload.php";
    $mail = new PHPMailer(true);

    //Set PHPMailer to use SMTP.
    $mail->isSMTP();            
    //Set SMTP host name                          
    $mail->Host = "smtp.elasticemail.com";
    // $mail->Host = "smtp.google.com";
    //Set this to true if SMTP host requires authentication to send email
    $mail->SMTPAuth = true;                          
    //Provide username and password     
    $mail->Username = "yacinejnano@gmail.com";            
    // $mail->Password = "sonicmario1";                           
    $mail->Password = "4AE00AC1264C0D2FA104C4C45F0C51E74BE2";                           
    //If SMTP requires TLS encryption then set it
    // $mail->SMTPSecure = "tls";                           
    //Set TCP port to connect to
    $mail->Port = 2525;                                   
    // $mail->Port = 25;                  

    $mail->From = "yacinejnano@gmail.com";
    $mail->FromName = "Chatly team";

    $mail->addAddress($_POST['email'], "captain falcon");

    $mail->isHTML(true);

    $mail->Subject = "You are almost done!";
    $mail->Body = "<h3>Hi, please confirm your email address by <a href='http://localhost/chatly/confirm.php?email=" . $_POST['email'] ."'>clicking here</a></h3>";
    // $mail->AltBody = "Please copy paste this link to your browser:\n ";

        try {
            $mail->send();
            echo $_POST['email'];
        } catch (Exception $e) {
            echo $mail->ErrorInfo;
        }
    }
    else {
        echo "not empty: ".$result['first_name'];
    }
