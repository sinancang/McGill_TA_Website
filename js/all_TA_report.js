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

    $('#load_data').click(function() {
        $.ajax({
            url: "../db/TA_notes.csv",
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



    $('#load_data2').click(function() {
        $.ajax({
            url: "../db/TA_review.csv",
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

    $('#load_data3').click(function() {
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