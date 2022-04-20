function TASelected() {
    let ajaxreq = new XMLHttpRequest(); // New request object
    ajaxreq.open('GET', '../utils/generateAllTA.php', true);
    ajaxreq.send();
    ajaxreq.onreadystatechange = function() {
        if (ajaxreq.readyState == 4 && ajaxreq.status == 200) {
            document.getElementById("TA").innerHTML = ajaxreq.responseText;
        }
    }
}

// load first view in all TAs report page
function load_first_view_all_ta_report() {
     // update color of curr selected btn
     $('.manage-ta-nav-btn ').css({'color': '#b3b3b3'});
     $('#load_data').css({'color': '#d65050'});

     $.ajax({
         url: "../db/TA_performance_logs.csv",
         dataType: "text",
         success: function(data) {
             let employee_data = data.split(/\r?\n|\r/);
             let table_data = '<table id="performance-table" class="manage-ta-table sortable">';
             for (let count = 0; count < employee_data.length; count++) {
                 let cell_data = employee_data[count].split(",");

                 if (count == 0) {
                     table_data += '<thead>';
                     table_data += '<tr class="manage-ta table-row header">';
                 }
                 else table_data += '<tr class="manage-ta table-row">';

                 for (let cell_count = 0; cell_count < cell_data.length; cell_count++) {
                     if (count === 0) {
                         table_data += '<th>' + cell_data[cell_count] + '</th>';
                     } else {
                         table_data += '<td>' + cell_data[cell_count] + '</td>';
                     }
                 }
                 table_data += '</tr>';
                 if (count == 0) {
                    table_data += '</thead>';
                    table_data += '<tbody>';
                 }
             }
            table_data += '</tbody>';
             table_data += '</table>';
             $('#manage-ta-view-container').html(table_data);
         }
     });
}


// set event listeners to display every view in all TA's report
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
                let employee_data = data.split(/\r?\n|\r/);
                let table_data = '<table class="manage-ta-table sortable">';
                for (let count = 0; count < employee_data.length; count++) {
                    let cell_data = employee_data[count].split(",");

                    if (count == 0) table_data += '<tr class="manage-ta table-row header">';
                    else table_data += '<tr class="manage-ta table-row">';

                    for (let cell_count = 0; cell_count < cell_data.length; cell_count++) {
                        if (count === 0) {
                            table_data += '<th>' + cell_data[cell_count] + '</th>';
                        } else {
                            table_data += '<td>' + cell_data[cell_count] + '</td>';
                        }
                    }
                    table_data += '</tr>';
                }
                table_data += '</table>';
                $('#manage-ta-view-container').html(table_data);
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
                let employee_data = data.split(/\r?\n|\r/);
                let table_data = '<table class="manage-ta-table sortable">';
                for (let count = 0; count < employee_data.length; count++) {
                    let cell_data = employee_data[count].split(",");

                    if (count == 0) table_data += '<tr class="manage-ta table-row header">';
                    else table_data += '<tr class="manage-ta table-row">';

                    for (let cell_count = 0; cell_count < cell_data.length; cell_count++) {
                        if (count === 0) {
                            table_data += '<th>' + cell_data[cell_count] + '</th>';
                        } else {
                            table_data += '<td>' + cell_data[cell_count] + '</td>';
                        }
                    }
                    table_data += '</tr>';
                }
                table_data += '</table>';
                $('#manage-ta-view-container').html(table_data);
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
                let employee_data = data.split(/\r?\n|\r/);
                let table_data = '<table class="manage-ta-table sortable">';

                for (let count = 0; count < employee_data.length; count++) {
                    let cell_data = employee_data[count].split(",");

                    if (count == 0) table_data += '<tr class="manage-ta table-row header">';
                    else table_data += '<tr class="manage-ta table-row">';

                    for (let cell_count = 0; cell_count < cell_data.length; cell_count++) {
                        if (count === 0) {
                            table_data += '<th>' + cell_data[cell_count] + '</th>';
                        } else {
                            table_data += '<td>' + cell_data[cell_count] + '</td>';
                        }
                    }
                    table_data += '</tr>';
                }
                table_data += '</table>';
                $('#manage-ta-view-container').html(table_data);
            }
        });
    });
}


function set_up_event_listeners_ta_course_options() {
    $('#office-hours').on('click', function() {
        $('.manage-ta-nav-btn ').css({'color': '#b3b3b3'});
        $(this).css({'color': '#d65050'});
        $('.display-option-ta-management').removeClass('open');
        $('.display-option-ta-management.office-hours').addClass('open');
    });

    $('#performance-log').on('click', function() {
        $('.manage-ta-nav-btn ').css({'color': '#b3b3b3'});
        $(this).css({'color': '#d65050'});
        $('.display-option-ta-management').removeClass('open');
        $('.display-option-ta-management.performance-log').addClass('open');
    });

    $('#wishlist').on('click', function() {
        $('.manage-ta-nav-btn ').css({'color': '#b3b3b3'});
        $(this).css({'color': '#d65050'});
        $('.display-option-ta-management').removeClass('open');
        $('.display-option-ta-management.ta-wishlist').addClass('open');
    });

    $('#submit-oh-hours-btn').on('click', function() {
        let user = document.getElementById('username').innerText;
        let course_code = document.getElementById('selected-course-code').innerText;
        let course_term = document.getElementById('selected-course-term').innerText;
        let day = document.getElementById('oh-day-select').value;
        let start_time = document.getElementById('oh-start-time').value;
        let end_time = document.getElementById('oh-end-time').value;
        let location = document.getElementById('oh-location').value;
        let duties = document.getElementById('oh-duties').value;

        let syncRequest = new XMLHttpRequest();
        var url = `../routes/dashboard.php?user=${user}&action=submit-oh-hours&duties=${duties}&location=${location}&end=${end_time}&start=${start_time}&day=${day}&course-code=${course_code}&course-term=${course_term}&ticket=${window.sessionStorage.ticket}`;
        syncRequest.open("POST", url, true);  
        syncRequest.addEventListener("load", function(){           
            if (this.status == 200) {
                console.log(this.responseText);
                //alert(this.responseText);
            }
            else alert('Server error. Please try again later');
    
        }, false);
    
        syncRequest.send();
    });
}




function displayScore() {
    let select = document.getElementById('TA');
    let value = select.options[select.selectedIndex].text;
    let ajaxreq = new XMLHttpRequest(); // New request object
    ajaxreq.open('POST', '../utils/average_score.php?TA=' + value, true);
    ajaxreq.send();
    ajaxreq.onreadystatechange = function() {
        if (ajaxreq.readyState == 4 && ajaxreq.status == 200) {
            let info = "The score of the selected TA for this course: ";
            document.getElementById("manage-ta-view-container").innerHTML = info + ajaxreq.responseText;
        }
    }

}


//not sure if it works for sending username and course!!!
function submit_performance_log(){
    let user = document.getElementById('username').innerText;
    let course_code = document.getElementById('selected-course-code').innerText;
    let course_term = document.getElementById('selected-course-term').innerText;
    let target_ta = document.getElementById('TA_dropdown').value;

    let syncRequest = new XMLHttpRequest();
    var url = `../utils/submit_performance_log.php?user=${user}&target-ta=${target_ta}&course-code=${course_code}&course-term=${course_term}&ticket=${window.sessionStorage.ticket}`
    syncRequest.open("GET", url, true);
 
    syncRequest.addEventListener("load", function(){           
        if (this.status == 200) {
            console.log(this.responseText);
            
        }
        else alert('Server error. Please try again later');

    }, false);

    syncRequest.send();
    
}






/* OFFICE HOURS */
//HOW TO GET COURSE NUM? IS MISSIN! //course-name get value by id in javascript and send it to php!
//function to generate dropdown menu for TA names from the selected term.
/*
function termSelected(data){
    let ajaxreq = new XMLHttpRequest(); // New request object
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
    let name = document.getElementById('username'); 
    let course_selected = document.getElementById('selected-course'); 
    let xhttp = new XMLHttpRequest();
    xhttp.open("GET", "../utils/generateTA.php?username="+ username, true);
    xhttp.open("GET", "../utils/generateTA.php?course-selected="+ course_selected, true); //is this name true and can multiple letiable be sent?
    xhttp.send();
        
}





// WISHLIST 
function TASelected(data){
    let ajaxreq = new XMLHttpRequest(); // New request object
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
    let username = document.getElementById('username');
    let course_selected =  document.getElementById('course-selected');
    let xhttp = new XMLHttpRequest();
    xhttp.open("GET", "../utils/TA_wish_list.php?username="+ username, true);
    xhttp.open("GET", "../utils/TA_wish_list.php?course_selected="+ course_selected, true); //is this name true and can multiple letiable be sent?
    xhttp.send();
    
}
*/