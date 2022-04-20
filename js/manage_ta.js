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
    $('.manage-ta-nav-btn ').css({
        'color': '#b3b3b3'
    });
    $('#load_data').css({
        'color': '#d65050'
    });

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
                } else table_data += '<tr class="manage-ta table-row">';

                for (let cell_count = 0; cell_count < cell_data.length; cell_count++) {
                    if (count === 0) {
                        table_data += '<th>' + cell_data[cell_count] + '</th>';
                    } else {
                        if (document.getElementById('user-type').innerText == 'sysop' ||
                            cell_data[0] == document.getElementById('username').innerText) {
                            table_data += '<td>' + cell_data[cell_count] + '</td>';
                        }
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
        $('.manage-ta-nav-btn ').css({
            'color': '#b3b3b3'
        });
        $(this).css({
            'color': '#d65050'
        });

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
        $('.manage-ta-nav-btn ').css({
            'color': '#b3b3b3'
        });
        $(this).css({
            'color': '#d65050'
        });
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
        $('.manage-ta-nav-btn ').css({
            'color': '#b3b3b3'
        });
        $(this).css({
            'color': '#d65050'
        });
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

    $(`<select id="all-tas-report-view-select" name = "day"class="drop">
    <option value='performance-log'> Performance Log </option>
    <option value='student-reviews'> Student Reviews </option>
    <option value='office-hours'> Office Hours </option>
    </select>`).insertAfter('#selected-course-term');

    $('#all-tas-report-view-select').css({'display':'none'});

    $('#all-tas-report-view-select').on('change', function() {
        $('.all-tas-report.performance-log-all-tas').removeClass('open');
        $('.all-tas-report.student-reviews-all-tas').removeClass('open');
        $('.all-tas-report.office-hours-all-tas').removeClass('open');
        if (document.getElementById('all-tas-report-view-select').value == 'performance-log') {
            $('.all-tas-report.performance-log-all-tas').addClass('open');
        }
        if (document.getElementById('all-tas-report-view-select').value == 'student-reviews') {
            $('.all-tas-report.student-reviews-all-tas').addClass('open');
        }
        if (document.getElementById('all-tas-report-view-select').value == 'office-hours') {
            $('.all-tas-report.office-hours-all-tas').addClass('open');
        }
    });

    $('#office-hours').on('click', function() {

        $('.manage-ta-nav-btn ').css({
            'color': '#b3b3b3'
        });
        $(this).css({
            'color': '#d65050'
        });
        $('.display-option-ta-management').removeClass('open');
        $('.display-option-ta-management.office-hours').addClass('open');

        $('#all-tas-report-view-select').css({'display':'none'});
    });

    $('#performance-log').on('click', function() {
        $('.manage-ta-nav-btn ').css({
            'color': '#b3b3b3'
        });
        $(this).css({
            'color': '#d65050'
        });
        $('.display-option-ta-management').removeClass('open');
        $('.display-option-ta-management.performance-log').addClass('open');
        $('#all-tas-report-view-select').css({'display':'none'});
    });

    $('#wishlist').on('click', function() {
        $('.manage-ta-nav-btn ').css({
            'color': '#b3b3b3'
        });
        $(this).css({
            'color': '#d65050'
        });
        $('.display-option-ta-management').removeClass('open');
        $('.display-option-ta-management.ta-wishlist').addClass('open');
        $('#all-tas-report-view-select').css({'display':'none'});
    });

    $('#all-tas-report').on('click', function() {

        $('.all-tas-report.performance-log-all-tas').removeClass('open');
        $('.all-tas-report.student-reviews-all-tas').removeClass('open');
        $('.all-tas-report.office-hours-all-tas').removeClass('open');
        
        $('.manage-ta-nav-btn ').css({
            'color': '#b3b3b3'
        });
        $(this).css({
            'color': '#d65050'
        });
        $('.display-option-ta-management').removeClass('open');
        $('.display-option-ta-management.all-tas-report').addClass('open');
        $('#all-tas-report-view-select').css({'display':'block'});


        document.getElementById('all-tas-report-view-select').value = 'performance-log';
        $('.all-tas-report.performance-log-all-tas').addClass('open');

    })

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
        syncRequest.addEventListener("load", function() {
            if (this.status == 200) {
                //alert(this.responseText);
                document.getElementById('oh-day-select').value = "";
                document.getElementById('oh-start-time').value = "";
                document.getElementById('oh-end-time').value = "";
                document.getElementById('oh-location').value = "";
                document.getElementById('oh-duties').value = "";
            } else alert('Server error. Please try again later');

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
function submit_performance_log() {
    let user = document.getElementById('username').innerText;
    let course_code = document.getElementById('selected-course-code').innerText;
    let course_term = document.getElementById('selected-course-term').innerText;
    let target_ta = document.getElementById('TA_dropdown').value;
    let review = document.getElementById('review').value;

    let syncRequest = new XMLHttpRequest();
    var url = `../utils/submit_performance_log.php?user=${user}&review=${review}&target-ta=${target_ta}&course-code=${course_code}&course-term=${course_term}&ticket=${window.sessionStorage.ticket}`
    syncRequest.open("GET", url, true);

    syncRequest.addEventListener("load", function() {
        if (this.status == 200) {
            //alert(this.responseText);
            document.getElementById('TA_dropdown').value = "";
            document.getElementById('review').value = "";

        } else alert('Server error. Please try again later');

    }, false);

    syncRequest.send();

}


function submit_wishlist() {
    let user = document.getElementById('username').innerText;
    let course_code = document.getElementById('selected-course-code').innerText;
    let course_term = document.getElementById('selected-course-term').innerText;
    let target_ta = document.getElementById('selected-ta').value;


    let syncRequest = new XMLHttpRequest();
    var url = `../utils/TA_wish_list.php?user=${user}&target-ta=${target_ta}&course-code=${course_code}&course-term=${course_term}&ticket=${window.sessionStorage.ticket}`
    syncRequest.open("GET", url, true);

    syncRequest.addEventListener("load", function() {
        if (this.status == 200) {
            //alert(this.responseText);
            document.getElementById('selected-ta').value = "";

        } else alert('Server error. Please try again later');

    }, false);

    syncRequest.send();
}
