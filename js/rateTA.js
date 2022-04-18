



function sendCourseRequest(){
        let course_selected = document.getElementById('selected-course'); 
        let user = document.getElementById('username');


        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", `../routes/dashboard.php?action=add-ta-review&user=${user}&ticket=${window.sessionStorage.ticket}&selected-course=${course_selected}`, true); //is this name true and can multiple variable be sent?
        xhttp.onreadystatechange = function(){
                if(xhttp.readyState==4 && xhttp.status==200){
                        let response_div = `<div>${this.responseText}</div>`;
                        $('.sign-up-form').append(response_div);
                } 
        }
        xhttp.send();
}




//When rating at TA, the user must specify which course and term.
//Rating a TA gives a score from 0 to 5 (where 5 means the best). 
//This option also provides a space to leave a short twitter- like comment.

function sendRateTArequest(){
    let course = document.getElementById('course').value;
    let term = document.getElementById('term').value;
    let score = document.getElementById('score').value;
    let comment = document.getElementById('comment').value;
    
    syncRequest = new XMLHttpRequest();
    let url = "../php/rateTA.php";
    syncRequest.open("POST", url, true);

    syncRequest.addEventListener("load", function(){
        if (this.responseText == 'success') alert ('rating has been submitted');
        else alert('failed to submit rating');
        }, false);

        let fd = new FormData;
        fd.append ('course', username);
        fd.append ('term', password);
        fd.append('score', email);
        fd.append('comment', studentid);
        syncRequest.send (fd);

}
