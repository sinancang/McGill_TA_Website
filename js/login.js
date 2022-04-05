function sendLoginRequest(){ 
	username = document.getElementById('user').value;
        password = document.getElementById('pass').value;
        encrypted_password = CryptoJS.AES.encrypt(password, 5);

        // make Ajax call to login.php with username & encrypted password
        syncRequest = new XMLHttpRequest();
        // TO DO: create event listener
        // prepare the request
        // then send it
}
