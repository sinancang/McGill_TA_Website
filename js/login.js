function sendLoginRequest(){ 

	var username = document.getElementById('user').value;
        var password = document.getElementById('pass').value;
        //var encrypted_password = CryptoJS.AES.encrypt(password, 5);

        // make Ajax call to login.php with username & encrypted password
        syncRequest = new XMLHttpRequest();
        var url = "../php/login.php";
        syncRequest.open("POST", url, true);

        syncRequest.onreadystatechange = function(){
                if (this.responseText == 'success') {
                        console.log(syncRequest.response);
                        alert ('successfully logged in.');
                }
                else {
                        alert ('failed to log in.');
                }
        }

        var fd = new FormData;
        fd.append ('user', document.getElementById("user").value);
        fd.append ('pass', document.getElementById("pass").value);
        syncRequest.send (fd);
}