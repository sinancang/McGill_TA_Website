function registerProcedure(){
        var username = document.getElementById('username').value;
	var email = document.getElementById('email').value;
        var pass1 = document.getElementById('pass1').value;
        var pass2 = document.getElementById('pass2').value;
	var type = document.getElementById('type').value;

	if (username == "" || email == "" || pass1 == "" || pass2 == "" || type == ""){
		displayWarning("Please fill out all of the fields!", false);
		return;
	}

	// check valid e-mail
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	if(!email.match(mailformat)){
		displayWarning("Please enter a valid e-mail", false);
		return;
	}

        if (pass1 !== pass2){
		displayWarning("Passwords do not match!", false);
		return;
        }

	if (pass1.length < 8 || pass1.length > 20){
		displayWarning("Password must be between 8 and 20 characters!", false);
		return;
	}

	
	var passwordformat = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
	if (!pass1.match(passwordformat)) {
		displayWarning("Please make sure your password contains at least one number and one special character.", false);
		return;
	}

	
	syncRequest = new XMLHttpRequest();
	var url = "../routes/register.php";
	syncRequest.open("POST", url, true);

	syncRequest.addEventListener("load", function() {
		if (this.status == 200){
			displayWarning("Register success.", true);
			
			// TO DO: redirect user & log them in

		} else if (this.status == 409) {
			displayWarning("E-mail or username already in use! Try another.", false);
		
		} else if (this.status == 404) {
			displayWarning("TA/Prof/Admin has not been pre-added. Please contact sysops.", false);

		} else {
			console.log("Unexpected error!");
		}
	}, false);
	var fd = new FormData;
	fd.append('username', username);
	fd.append('email', email);
	fd.append('password', pass1);
	fd.append('type', type);
	syncRequest.send(fd);
}

function displayWarning(warning, isGreen){
	const node = document.createElement("p");
        const textnode = document.createTextNode(warning);
        node.appendChild(textnode);
        document.getElementById("warning").textContent = '';
	document.getElementById("warning").appendChild(node);
        
	if (isGreen) {
		document.getElementById("warning").style.color = "green";
	} else {
		document.getElementById("warning").style.color = "#ca1818";
	}
}

