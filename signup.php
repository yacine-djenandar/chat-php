<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300&display=swap" rel="stylesheet">
    <title>Sign up | Chatly</title>
    <link rel="stylesheet" href="./signup.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="signup.js"></script>
</head>

<body>
    <div id="loading" style="display: none;" class="loading-page">
        <div class="loading-container">
            <span class="loading-text">Loading, please wait...</span>
        </div>
    </div>
    <div class="container">
        <div class="background"></div>
        <div class="form-container">
            <span class="form-title">Sign up</span>
            <form id="signup_form" onsubmit="postRequest()">
                <div class="input-container">
                    <input required autocomplete="off" placeholder="First name" type="text" id="first_name" name="first_name" />
                    <input required autocomplete="off" placeholder="Last name" type="text" id="last_name" name="last_name" />
                </div>
                <div class="input-container">
                    <input onkeydown="checkChanges('email')" required autocomplete="off" placeholder="Email address" type="email" id="email" name="email" />
                </div>
                <span style="display:none;" class="form_err" id="email-err">This email address is already used!</span>
                <div class="input-container">
                    <input onkeydown="checkChanges('password')" required autocomplete="off" placeholder="Password" type="password" id="password" name="password" />
                </div>
                <span style="display:none;" class="form_err" id="password-err">Password must be at least 8 characters in length</span>
                <div class="input-container">
                    <input onkeydown="checkChanges('confirmPassword')" required autocomplete="off" placeholder="Confirm password" type="password" id="confirm_password" name="confirm_password" />
                </div>
                <span style="display:none;" class="form_err" id="confirmPassword-err">This field must match the password field required</span>
                <input type="submit" value="Submit" />
                <a href="/chatly/login.php">Already have an account? Click here to log in</a><br/>
            </form>
        </div>
    </div>
</body>

</html>