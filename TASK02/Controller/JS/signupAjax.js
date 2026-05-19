function checkUsername(){

    let username = document.getElementById("username").value;

    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("usernameMsg").innerHTML = this.responseText;
        }
    };

    xhttp.open("POST", "../Controller/checkUsername.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhttp.send("username=" + encodeURIComponent(username));
}


function checkEmail(){

    let email = document.getElementById("email").value;

    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            document.getElementById("emailMsg").innerHTML = this.responseText;
        }
    };

    xhttp.open("POST", "../Controller/checkEmail.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhttp.send("email=" + encodeURIComponent(email));
}


/* SHOW PASSWORD */
function togglePassword(id){
    let input = document.getElementById(id);

    input.type = (input.type === "password") ? "text" : "password";
}