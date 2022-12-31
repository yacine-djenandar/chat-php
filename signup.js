var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {
    if(this.readyState==4 && this.status==200) {
        console.log(this.responseText)
        document.getElementById('email-err').innerText = "This email address is already used!"
        if(this.responseText.includes('@')) {
            window.location.href = "confirm_mail.php?email=" + this.responseText;
        }
        else {
            document.getElementById('loading').style.display = "none";
            if(this.responseText.includes('SMTP')) {
                document.getElementById('email-err').innerText = this.responseText;
            }
            document.getElementById('email-err').style.display = "inline-block";
        }
    }
}


function postRequest() {
    window.event.preventDefault();

    const passwordInput = document.getElementById('password')
    
    const confirmPasswordInput = document.getElementById('confirm_password')

    let err = false;

    if(passwordInput.value.length<8) {
        document.getElementById('password-err').style.display = "inline-block"
        err = true;
    }

    if(confirmPasswordInput.value !== passwordInput.value) {
        document.getElementById('confirmPassword-err').style.display = "inline-block"
        err = true;
    }

    if(!err) {
        document.getElementById('loading').style.display = "flex";
        let formData = new FormData(document.getElementById('signup_form'));
        xmlhttp.open("POST", "verify_data_signup.php", true);
        xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
        xmlhttp.send(`first_name=${formData.get('first_name')}&last_name=${formData.get('last_name')}&email=${formData.get('email')}&password=${formData.get('password')}`);
    }
}

function checkChanges(name) {
    document.getElementById(name + "-err").style.display = "none"
}