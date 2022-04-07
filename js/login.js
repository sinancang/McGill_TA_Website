function sendLoginRequest(){ 

        window.alert("hi");
	var username = document.getElementById('user').value;
        var password = document.getElementById('pass').value;
        var encrypted_password = CryptoJS.AES.encrypt(password, 5);

        // make Ajax call to login.php with username & encrypted password
        syncRequest = new XMLHttpRequest();
        var url = "login.php";
        syncRequest.open("POST", url, true);

        syncRequest.addEventListener("load", function(){
                if (this.responseText == 'success')
                        alert ('successfully logged in.');
                else
                        alert ('failed to log in.');
        }, false)

        var fd = new FormData;
        fd.append ('user', document.getElementById("user").value);
        fd.append ('pass', document.getElementById("pass").value);
        syncRequest.send (fd);
}