
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



// ajax login request
function sendRegisterRequest(){
    var username = document.getElementById('user').value;
    var email = document.getElementById('email').value;
    var studentid = document.getElementById('studentid').value;
    var password = document.getElementById('pass1').value;
    
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
        fd.append ('user', username);
        fd.append ('pass', password);
        fd.append('email', email);
        fd.append('studentid', studentid);
        syncRequest.send (fd);
}
