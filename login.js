var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {
    if(this.readyState==4 && this.status==200) {
        console.log(this.response)
        if(this.responseText.includes("error")) {
            document.getElementById('err').style.display = "block";
        }
        else if(this.responseText.includes("confirm")) {
            window.location.href = "login.php";            
        }
        else {
            window.location.href = "dashbord.php?show=account";
        }
    }
}

function getRequest() {
    window.event.preventDefault();
    let fd = new FormData(document.getElementById('login-form'));
    xmlhttp.open('POST','verify_data_login.php',true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
    xmlhttp.send(`email=${fd.get('email')}&password=${fd.get('password')}`)
}

function checkChanges() {
    document.getElementById('err').style.display = 'none';
}