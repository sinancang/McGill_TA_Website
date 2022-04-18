



function sendCourseRequest(){
        let user = document.getElementById('username').innerText;
        let course_code = document.getElementById('form-course-code').innerText;
        let course_term = document.getElementById('form-course-term').innerText;
        let review = document.getElementById('review').value;
        let rating = document.getElementById('score').value;
        let target_ta = document.getElementById('TA_dropdown').value;

        var xhttp = new XMLHttpRequest();
        let url = `../routes/dashboard.php?action=add-ta-review&ta-name=${target_ta}&rating=${rating}&review=${review}&course-term=${course_term}&course-code=${course_code}&user=${user}&ticket=${window.sessionStorage.ticket}`;
        xhttp.open("GET", url, true);  
        xhttp.addEventListener("load", function(){           
        if (this.status == 200) {
                alert(this.responseText);
        }
        else alert('Server error. Please try again later');

        }, false);

        xhttp.send();
}

