let pass1 = document.querySelector("#pass1");
let pass2 = document.querySelector("#pass2");
let warning = document.querySelector("#warning");

function checkMatch(){
        if(pass1.value==pass2.value){
        warning.innerText = "";
        }
        else{
        warning.innerText = "Paswords don't match";
        }
}

pass1.addEventListener("keyup", () => {
        if(pass2.value.lenght != 0) checkMatch();
})
pass2.addEventListener("keyup", checkMatch);



// ajax register request
function sendRegisterRequest(){
    var username = document.getElementById('user').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('pass1').value;
    
    // encrypt request
    encryptRequest = new XMLHttpRequest();
    var url1 = "../utils/encrypt.php";
    encryptRequest.open("GET", url1, true);
    
    encryptRequest.addEventListener("load", function(){
    	registerUser(username, email, this.responseText);
    }, false);
    var fd1 = new FormData;
    fd1.append('pass', password);
    encryptRequest.send(fd1);
}

function registerUser(user, mail, encrypted_password){
    syncRequest = new XMLHttpRequest();
    var url = "../routes/register.php";
    syncRequest.open("POST", url, true);

    syncRequest.addEventListener("load", function(){
        if (this.responseText == 'success')
                alert ('successfully registered.');
        else
                alert ('failed to register.');
        }, false);

    var fd = new FormData;
    fd.append ('user', user);
    fd.append('mail', mail);
    fd.append ('pass', encrypted_password);
    syncRequest.send (fd);	
}
