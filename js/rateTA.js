



function sendCourseRequest(){
        let user = document.getElementById('username');
        let course_code = document.getElementById('form-course-code').innerText;
        let course_term = document.getElementById('form-course-term').innerText;
        let review = document.getElementById('review').value;
        let rating = document.getElementById('score').value;
        let target_ta = document.getElementById('TA_dropdown').value;

        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", `../routes/dashboard.php?action=add-ta-review&ta-name=${target_ta}&rating=${rating}rating&review=${review}&course-term=${course_term}&course-code=${course_code}&user=${user}&ticket=${window.sessionStorage.ticket}`, true); //is this name true and can multiple variable be sent?
        xhttp.open("GET", url, true);  
        xhttp.addEventListener("load", function(){           
        if (this.status == 200) {
                $('.dashboard-dynamic-content-main')[0].innerHTML = this.responseText;
        }
        else alert('Server error. Please try again later');

        }, false);

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
