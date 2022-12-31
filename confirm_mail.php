<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./confirm_mail.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
    <title>Confirm your email address</title>
</head>

<body>
    <a class="logo" href="/chatly/login.php">Chatly</a>
    <div class="container">
        <div class="background-image"></div>
        <span class="title">You're almost there!</span>
        <p class="paragraph">
            We've sent you a confirmation mail to your email address: <?php $email=$_GET['email']; echo "<i>$email</i>";?>.
            Click on the link sent to you in that email to confirm your email address<br />
        </p>
    </div>
</body>

</html>