
function sendRegisterRequest(){
    var username = document.getElementById('name').value;
    var email = document.getElementById('email').value;
    var studentid = document.getElementById('studentid').value;
    var password = document.getElementById('pass1').value;
    
    syncRequest = new XMLHttpRequest();
    var url = "../php/register.php";
    syncRequest.open("POST", url, true);

    syncRequest.addEventListener("load", function(){
        if (this.responseText == 'success')
                alert ('successfully logged in.');
        else
                alert ('failed to log in.');
        }, false);

        var fd = new FormData;
        fd.append ('user', username);
        fd.append ('pass', password);
        fd.append('email', email);
        fd.append('studentid', studentid);
        syncRequest.send (fd);

}
