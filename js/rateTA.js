//When rating at TA, the user must specify which course and term.
//Rating a TA gives a score from 0 to 5 (where 5 means the best). 
//This option also provides a space to leave a short twitter- like comment.

function sendRateTArequest(){
    var course = document.getElementById('course').value;
    var term = document.getElementById('term').value;
    var score = document.getElementById('score').value;
    var comment = document.getElementById('comment').value;
    
    syncRequest = new XMLHttpRequest();
    var url = "../php/rateTA.php";
    syncRequest.open("POST", url, true);

    syncRequest.addEventListener("load", function(){
        if (this.responseText == 'success')
                alert ('rating has been submitted');
        else
                alert ('failed to submit rating');
        }, false);

        var fd = new FormData;
        fd.append ('course', username);
        fd.append ('term', password);
        fd.append('score', email);
        fd.append('comment', studentid);
        syncRequest.send (fd);

}

