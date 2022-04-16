// TO DO: add a register procedure method which:
// checks validity of mail
// checks if passwords match
// checks if password is valid
// etc...
function registerProcedure(){
        var username = document.getElementById('username').value;
	var email = document.getElementById('email').value;
        var pass1 = document.getElementById('pass1').value;
        var pass2 = document.getElementById('pass2').value;
	var type = document.getElementById('type').value;

        if (pass1 !== pass2){
                window.alert("Passwords do not match! Try again.");
                return;
        }
	
	syncRequest = new XMLHttpRequest();
	var url = "../routes/register.php";
	syncRequest.open("POST", url, true);

	syncRequest.addEventListener("load", function() {
		if (this.status == 200){
			console.log('Register success.');
		} else {
			console.log('Failed to register...');
		}
	}, false);
	var fd = new FormData;
	fd.append('username', username);
	fd.append('email', email);
	fd.append('password', pass1);
	fd.append('type', type);
	syncRequest.send(fd);
}

