function TASelected() {
    var ajaxreq = new XMLHttpRequest(); // New request object
    ajaxreq.open('GET', '../utils/generateAllTA.php', true);
    ajaxreq.send();
    ajaxreq.onreadystatechange = function() {
        if (ajaxreq.readyState == 4 && ajaxreq.status == 200) {
            document.getElementById("TA").innerHTML = ajaxreq.responseText;
        }
    }
}

function set_all_ta_report_event_liteners() {

    // performance log reviews event listener
    $('#load_data').click(function() {
        // update color of curr selected btn
        $('.manage-ta-nav-btn ').css({'color': '#b3b3b3'});
        $(this).css({'color': '#d65050'});

        $.ajax({
            url: "../db/TA_performance_logs.csv",
            dataType: "text",
            success: function(data) {
                var employee_data = data.split(/\r?\n|\r/);
                var table_data = '<table class="table table-bordered table-striped">';
                for (var count = 0; count < employee_data.length; count++) {
                    var cell_data = employee_data[count].split(",");
                    console.log(cell_data);
                    table_data += '<tr>';
                    for (var cell_count = 0; cell_count < cell_data.length; cell_count++) {
                        if (count === 0) {
                            table_data += '<th>' + cell_data[cell_count] + '</th>';
                        } else {
                            table_data += '<td>' + cell_data[cell_count] + '</td>';
                        }
                    }
                    table_data += '</tr>';
                }
                table_data += '</table>';
                $('#employee_table').html(table_data);
            }
        });
    });

    // Student reviews event listener
    $('#load_data2').click(function() {
        // update color of curr selected btn
        $('.manage-ta-nav-btn ').css({'color': '#b3b3b3'});
        $(this).css({'color': '#d65050'});        
        $.ajax({
            url: "../db/TA_review.csv",
            dataType: "text",
            success: function(data) {
                var employee_data = data.split(/\r?\n|\r/);
                var table_data = '<table class="table table-bordered table-striped">';
                for (var count = 0; count < employee_data.length; count++) {
                    var cell_data = employee_data[count].split(",");
                    table_data += '<tr>';
                    for (var cell_count = 0; cell_count < cell_data.length; cell_count++) {
                        if (count === 0) {
                            table_data += '<th>' + cell_data[cell_count] + '</th>';
                        } else {
                            table_data += '<td>' + cell_data[cell_count] + '</td>';
                        }
                    }
                    table_data += '</tr>';
                }
                table_data += '</table>';
                $('#employee_table').html(table_data);
            }
        });
    });

    // OH and responsibilities event listener
    $('#load_data3').click(function() {
        // update color of curr selected btn
        $('.manage-ta-nav-btn ').css({'color': '#b3b3b3'});
        $(this).css({'color': '#d65050'});
        $.ajax({
            url: "../db/office_hours.csv",
            dataType: "text",
            success: function(data) {
                var employee_data = data.split(/\r?\n|\r/);
                var table_data = '<table class="table table-bordered table-striped">';
                for (var count = 0; count < employee_data.length; count++) {
                    var cell_data = employee_data[count].split(",");
                    table_data += '<tr>';
                    for (var cell_count = 0; cell_count < cell_data.length; cell_count++) {
                        if (count === 0) {
                            table_data += '<th>' + cell_data[cell_count] + '</th>';
                        } else {
                            table_data += '<td>' + cell_data[cell_count] + '</td>';
                        }
                    }
                    table_data += '</tr>';
                }
                table_data += '</table>';
                $('#employee_table').html(table_data);
            }
        });
    });
}




function displayScore() {
    var select = document.getElementById('TA');
    var value = select.options[select.selectedIndex].text;
    var ajaxreq = new XMLHttpRequest(); // New request object
    ajaxreq.open('POST', '../utils/average_score.php?TA=' + value, true);
    ajaxreq.send();
    ajaxreq.onreadystatechange = function() {
        if (ajaxreq.readyState == 4 && ajaxreq.status == 200) {
            var info = "The score of the selected TA for this course: ";
            document.getElementById("employee_table").innerHTML = info + ajaxreq.responseText;
        }
    }

}






/* OFFICE HOURS */
//HOW TO GET COURSE NUM? IS MISSIN! //course-name get value by id in javascript and send it to php!
//function to generate dropdown menu for TA names from the selected term.
function termSelected(data){
    var ajaxreq = new XMLHttpRequest(); // New request object
    ajaxreq.open('GET', '../utils/generateTA.php?term='+data, true);
    ajaxreq.send();
    ajaxreq.onreadystatechange = function(){
        if(ajaxreq.readyState==4 && ajaxreq.status==200){
                document.getElementById("TA_dropdown").innerHTML = ajaxreq.responseText;
        }          
    }
}
    
//not sure if it works for sending username and course!!!
function sendusername_course(){
    var name = document.getElementById('username'); 
    var course_selected = document.getElementById('selected-course'); 
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "../utils/generateTA.php?username="+ username, true);
    xhttp.open("GET", "../utils/generateTA.php?course-selected="+ course_selected, true); //is this name true and can multiple variable be sent?
    xhttp.send();
    
}
    
//not sure if it works for sending username and course!!!
function sendusername_course(){
    var name = document.getElementById('username'); 
    var course_selected = document.getElementById('selected-course'); 
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "../utils/generateTA.php?username="+ username, true);
    xhttp.open("GET", "../utils/generateTA.php?course-selected="+ course_selected, true); //is this name true and can multiple variable be sent?
    xhttp.send();
        
}




/* WISHLIST */
function TASelected(data){
    var ajaxreq = new XMLHttpRequest(); // New request object
    ajaxreq.open('GET', '../utils/generateAllTA.php', true);
    ajaxreq.send();
    ajaxreq.onreadystatechange = function(){
        if(ajaxreq.readyState==4 && ajaxreq.status==200){
            document.getElementById("TA").innerHTML = ajaxreq.responseText;
        }          
    }
}

//not sure if it works for sending username and course!!!
function sendusername_course(){
    var username = document.getElementById('username');
    var course_selected =  document.getElementById('course-selected');
    var xhttp = new XMLHttpRequest();
    xhttp.open("GET", "../utils/TA_wish_list.php?username="+ username, true);
    xhttp.open("GET", "../utils/TA_wish_list.php?course_selected="+ course_selected, true); //is this name true and can multiple variable be sent?
    xhttp.send();
    
}