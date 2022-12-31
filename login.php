<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
        <title>Welcome back</title>
        <link rel="stylesheet" href="./login.css" />
        <script src="login.js"></script>
    </head>

    <body>
        <div class="container">
            <div class="background"></div>
            <div class="form-container">
                <span class="form-title">Login</span>
                <form id="login-form" onsubmit="getRequest()">
                    <div class="input-container">
                        <input required onkeydown='checkChanges()' autocomplete="off" placeholder="Email address" type="email" id="email" name="email" />
                        <label></label>
                    </div>
                    <div class="input-container">
                        <input required onkeydown='checkChanges()' autocomplete="off" placeholder="Password" type="password" id="password" name="password" />
                        <label></label>
                    </div>
                    <span style="display: none;" class="form_err" id="err">Wrong credentials!</span>
                    <input type="submit" value="Submit" />
                    <a href="/chatly/signup.php">New user? Click here to sign up</a><br/>
                </form>
            </div>
        </div>
    </body>

</html>