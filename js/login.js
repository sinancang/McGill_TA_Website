function sendLoginRequest(){ 

	var username = document.getElementById('user').value;
        var password = document.getElementById('pass').value;
        //var encrypted_password = CryptoJS.AES.encrypt(password, 5);

        // make Ajax call to login.php with username & encrypted password
        let syncRequest = new XMLHttpRequest();
        var url = "../routes/login.php";
        syncRequest.open("POST", url, true);

        syncRequest.addEventListener("load", function(){
		console.log(this.status);
                if (this.status === 200) {
                        window.location.href = `https://www.cs.mcgill.ca/~dpeter19/McGill_TA_Website/routes/dashboard.php?user=${this.responseText}&view=default`;
                }
                else {
                        alert('failed to log in.');
                }
                        
        }, false);

        var fd = new FormData;
        fd.append('user', document.getElementById("user").value);
        fd.append('pass', document.getElementById("pass").value);
        syncRequest.send(fd);
}