function sendLoginRequest(){ 
	
        var password = document.getElementById('pass').value;
        var username = document.getElementById('user').value;

	let encryptRequest = new XMLHttpRequest();
	var url1 = "../utils/encrypt.php";
	encryptRequest.open("GET", url1, false);
	encryptRequest.addEventListener("load", function() {
		logUserIn(username, this.responseText);
	}, false);
	var fd = new FormData;
	fd.append('pass', password);
	encryptRequest.send(fd);

}
function logUserIn(username, encrypted_password){
        // make Ajax call to login.php with username & encrypted password
        let syncRequest = new XMLHttpRequest();
        var url = "../routes/login.php";
        syncRequest.open("POST", url, false);

        syncRequest.addEventListener("load", function(){
                console.log(this.status);
                if (this.status === 200) {
                        console.log(this.responseText);
                        window.location.href = `https://www.cs.mcgill.ca/~dpeter19/McGill_TA_Website/routes/dashboard.php?user=${this.responseText}&view=default`;
                }
                else {
                        alert('failed to log in.');
                }
                        
        }, false);

        var fd = new FormData;
        fd.append('user', username);
        fd.append('pass', encrypted_password);
        syncRequest.send(fd);	
}
