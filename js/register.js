// TO DO: add a register procedure method which:
// checks validity of mail
// checks if passwords match
// checks if password is valid
// etc...
function registerProcedure(){
        var email = document.getElementById('email').value;
        var pass1 = document.getElementById('pass1').value;
        var pass2 = document.getElementById('pass2').value;
        
        if (pass1 !== pass2){
                window.alert("allo1");
                return;
        }

	/*

        if(!checkValidMail(email)){
                window.alert("allo");
		return;
        }
	*/

        encryptPassword(email, pass1);
}

function checkValidMail(mail){
        // might want to define username, pass, email etc globally
        // since it's used so much
        var email = document.getElementById('email').value;
        validateMailRequest = new XMLHttpRequest();
        var url = `../utils/validateMail.php?mail=${email}`;
        validateMailRequest.open("GET", url, true);
        validateMailRequest.addEventListener("load", function(){
                if (this.status == 200){
                        console.log(this.responseText);
                        return true;
                } else{
                        return false;
                }
        }, false);
        validateMailRequest.send();
}

// ajax encryption request
// followed by a call to register request
function encryptPassword(email, password){
    encryptRequest = new XMLHttpRequest();
    var url = "../utils/encrypt.php";
    encryptRequest.open("POST", url, true);
   
    encryptRequest.addEventListener("load", function(){
	    window.alert(this.responseText);
	    registerUser(email, this.responseText);
    }, false);
    var fd = new FormData;
    fd.append('pass', password);
    encryptRequest.send(fd);
}

// sends register request
function registerUser(email, encrypted_password){
    syncRequest = new XMLHttpRequest();
    var url = "../routes/register.php";
    syncRequest.open("POST", url, true);

    syncRequest.addEventListener("load", function(){
        if (this.status == 200)
                console.log(this.responseText);
        else
                alert ('Failed to register.');
        }, false);

    var fd = new FormData;
    fd.append('email', email);
    fd.append ('pass', encrypted_password);
    syncRequest.send (fd);      
}

