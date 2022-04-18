"use strict";

/*
    Wait for DOM to load and then
    set up all initial event listeners etc.
*/
window.addEventListener('DOMContentLoaded', (event) => {

    // set import profs and courses btn event listener
    $('.user-type-based-btn.sys-ops-btn').on('click', function() {
        $(this).text('Importing...');
        let user = document.getElementById('username').innerText;
        let syncRequest = new XMLHttpRequest();
        var url = `../routes/dashboard.php?user=${user}&action=prof-courses-import&ticket=${window.sessionStorage.ticket}`;
        syncRequest.open("GET", url, true);  
        syncRequest.addEventListener("load", function(){           
            if (this.status == 200) {
                $('.user-type-based-btn.sys-ops-btn').text('Import Professors and Courses');
                //console.log(this.responseText);
            }
            else alert('Server Error.');
    
        }, false);
    
        syncRequest.send();
    });

    // set event listeners for primary nav bar options
    $('.nav-bar-btn-container.first-nav-bar').on('click', function() {



        $(this).css({'background-color': ''})

        if ($(this).attr('id') == 'admin') {
            $('.dashboard-content-side-nav-bar.first-nav-bar').removeClass('open');
            $('.dashboard-content-side-nav-bar.second-nav-bar').addClass('open');
            getSecondaryMenuItems('admin');
        }
        else if ($(this).attr('id') == 'manage') {
            $('.dashboard-content-side-nav-bar.first-nav-bar').removeClass('open');
            $('.dashboard-content-side-nav-bar.second-nav-bar').addClass('open');
            getSecondaryMenuItems('ta-management');
        }
        else if ($(this).attr('id') == 'rate') {
            $('.dashboard-content-side-nav-bar.first-nav-bar').removeClass('open');
            $('.dashboard-content-side-nav-bar.second-nav-bar').addClass('open');
            getSecondaryMenuItems('get-rate-ta-classes');
        }
        else if ($(this).attr('id') == 'sys-ops') {
            $('.dashboard-content-side-nav-bar.first-nav-bar').removeClass('open');
            $('.dashboard-content-side-nav-bar.second-nav-bar').addClass('open');
            fillSecondaryMenu('sys-ops');
        }
    });


    $('#main-dashboard').on('click', function() {
        let user = document.getElementById('username').innerText;
        let syncRequest = new XMLHttpRequest();
        var url = `../routes/dashboard.php?user=${user}&view=main&ticket=${window.sessionStorage.ticket}`;
        syncRequest.open("GET", url, true);  
        syncRequest.addEventListener("load", function(){           
            if (this.status == 200) if (this.status === 200) {
                $('.dashboard-dynamic-content-main')[0].innerHTML = this.responseText;
            }
            else alert('Invalid user role.');
    
        }, false);
    
        syncRequest.send();

    });

    
    // event for back btn in secondary menu
    // takes user back to primary menu
    $('.nav-bar-btn-container.back-btn').on('click', function() {
        $('.dashboard-content-side-nav-bar.first-nav-bar').addClass('open');
        $('.dashboard-content-side-nav-bar.second-nav-bar').removeClass('open');
    })


    $('#settings-btn').on('click', function() {
        $('.settings-menu-container').toggleClass('open');
    })


});


/*
    Ajax request to get the correct options for the secondary menu.
    This function is only called for secondary menus that have dynamic content.
    For example if a student selects "Rate TA" options, we load the classes that the student is taking.

    On the other hand, sys-ops secondary menu is always the same, so this function is bypassed.
*/
function getSecondaryMenuItems(menuName) {
    
    let user = document.getElementById('username').innerText;
    let syncRequest = new XMLHttpRequest();
    var url = `../routes/dashboard.php?user=${user}&action=${menuName}&ticket=${window.sessionStorage.ticket}`;
    syncRequest.open("GET", url, true);  
    syncRequest.addEventListener("load", function(){           
        if (this.status == 200) {
            document.getElementById('second-nav-bar-options-container').innerHTML = this.responseText;
            fillSecondaryMenu(menuName);
        }
        else alert('Server error. Please try again later');

    }, false);

    syncRequest.send(); 
}



/*
    This function handles the display of the correct options in the secondary menu
    in the dashboard.
    It determines the correct options to display based on the option selected in the primary menu.
    Also sets necessary event listeners for the secondary menu.
*/
function fillSecondaryMenu(menuName) {

    // sys-ops secondary menu
    if (menuName == 'sys-ops') {
        document.getElementById('second-nav-bar-options-container').innerHTML = 
        `
        <div id="manage-users" class="nav-bar-btn-container second-nav-bar">
            <div class="nav-bar-btn-wrapper  second-nav-bar">
                <div class="nav-bar-btn">Manage Users</div>
            </div>
        </div>
        <div id="add-manually-users" class="nav-bar-btn-container second-nav-bar">
            <div class="nav-bar-btn-wrapper  second-nav-bar">
                <div class="nav-bar-btn">Upload Course Record</div>
            </div>
        </div>
        `;

        // add event listeners that are specific to sys-ops menu

        $('.nav-bar-btn-container.second-nav-bar').on('click', function() {
            $('.nav-bar-btn-container.second-nav-bar').css({'color': 'rgb(103, 103, 103)'});
            $(this).css({'color': '#7474ff'});
        });

        // load user management view
        $('#manage-users').on('click', function() {
            let user = document.getElementById('username').innerText;
            let syncRequest = new XMLHttpRequest();
            var url = `../routes/dashboard.php?user=${user}&view=manage-users&ticket=${window.sessionStorage.ticket}`;
            syncRequest.open("GET", url, true);  
            syncRequest.addEventListener("load", function(){           
                if (this.status == 200) {
                    $('.dashboard-dynamic-content-main')[0].innerHTML = this.responseText;
                    set_up_manage_users_view();
                }
                else alert('Invalid user role.');
        
            }, false);
        
            syncRequest.send();
        });

        // load manual upload view
        $('#add-manually-users').on('click', function() {
            let user = document.getElementById('username').innerText;
            let syncRequest = new XMLHttpRequest();
            var url = `../routes/dashboard.php?user=${user}&view=add-manually-users&ticket=${window.sessionStorage.ticket}`;
            syncRequest.open("GET", url, true);  
            syncRequest.addEventListener("load", function(){           
                if (this.status == 200) {
                    $('.dashboard-dynamic-content-main')[0].innerHTML = this.responseText;
                }
                else alert('Invalid user role.');
        
            }, false);
        
            syncRequest.send();
        });
    }
    // admins secondary menu
    else if (menuName == 'admin') {
    }
    // ta management secondary menu
    else if (menuName == 'ta-management') {

        $('.nav-bar-btn-container.second-nav-bar').on('click', function() {
            let user = document.getElementById('username').innerText;
            let course_code = $(this).find('#course-code').text();
            let course_name = $(this).find('#course-name').text();
            let course_term = $(this).find('#course-term').text();
    
            let syncRequest = new XMLHttpRequest();
            var url = `../routes/dashboard.php?user=${user}&view=office-hours&course-code=${course_code}&course-term=${course_term}&ticket=${window.sessionStorage.ticket}`;
            syncRequest.open("GET", url, true);  
            syncRequest.addEventListener("load", function(){           
                if (this.status == 200) {
                    $('.dashboard-dynamic-content-main')[0].innerHTML = this.responseText;
                    set_up_event_listeners_not_all_ta_report();
                }
                else alert('Server error. Please try again later');
        
            }, false);
        
            syncRequest.send();
        })

        $('#all-ta-report').on('click', function() {
            let user = document.getElementById('username').innerText;
            let syncRequest = new XMLHttpRequest();
            var url = `../routes/dashboard.php?user=${user}&view=all-ta-report&ticket=${window.sessionStorage.ticket}`;
            syncRequest.open("GET", url, true);  
            syncRequest.addEventListener("load", function(){           
                if (this.status == 200) {
                    $('.dashboard-dynamic-content-main')[0].innerHTML = this.responseText;
                    set_all_ta_report_event_liteners();
                    load_first_view_manage_ta();
                }
                else alert('Server error. Please try again later');
        
            }, false);
        
            syncRequest.send();
        })


    }
    // ta rating secondary menu
    else if (menuName == 'get-rate-ta-classes') {
        $('.nav-bar-btn-container.second-nav-bar').on('click', function() {
            let user = document.getElementById('username').innerText;
            let course_code = $(this).find('#course-code').text();
            let course_name = $(this).find('#course-name').text();
            let course_term = $(this).find('#course-term').text();
    
            let syncRequest = new XMLHttpRequest();
            var url = `../routes/dashboard.php?user=${user}&view=rate-ta&course-code=${course_code}&course-term=${course_term}&ticket=${window.sessionStorage.ticket}`;
            syncRequest.open("GET", url, true);  
            syncRequest.addEventListener("load", function(){           
                if (this.status == 200) {
                    $('.dashboard-dynamic-content-main')[0].innerHTML = this.responseText;
                }
                else alert('Server error. Please try again later');
        
            }, false);
        
            syncRequest.send();
        })
    }
}


function set_up_event_listeners_not_all_ta_report() {
    $('#ta-display-select').on('change', function() {
        if ($('#ta-display-select')[0].value == 'office-hours') {
            $('.display-option-ta-management').css({'display':'none'});
            $('.display-option-ta-management.office-hours').css({'display':'flex'});
        }
        if ($('#ta-display-select')[0].value == 'performance-log') {
            $('.display-option-ta-management').css({'display':'none'});
            $('.display-option-ta-management.performance-log').css({'display':'flex'});
        }
        if ($('#ta-display-select')[0].value == 'ta-wishlist') {
            $('.display-option-ta-management').css({'display':'none'});
            $('.display-option-ta-management.ta-wishlist').css({'display':'flex'});
        }
    })
}




/* 
    Function is called from manual upload page.
    Tries to add a record to the db.
    The new record specifies a specific prof that is teaching a specific class.
*/
function submitAddManuallyForm() {
    // make Ajax call to dashboard.php with prof name & course code
    let syncRequest = new XMLHttpRequest();
    

    let user = document.getElementById('username').innerText;
    
    let courseName = document.getElementById("course-name").value;
    let courseCode = document.getElementById("course-code").value;
    let term = document.getElementById("term").value;
    let prof = document.getElementById("new-prof").value;
    

    var url = `../routes/dashboard.php?action=manual-upload&user=${user}&new-prof=${prof}&course-code=${courseCode}&course-name=${courseName}&term=${term}&ticket=${window.sessionStorage.ticket}`;
    syncRequest.open("POST", url, true);
    syncRequest.setRequestHeader("Content-Type", "multipart/form-data");
    

    syncRequest.addEventListener("load", function(){
            if (this.status === 200) {
                // clear form values and display server response
                document.getElementById("new-prof").value = '';
                document.getElementById("course-code").value = '';
                document.getElementById("course-name").value = '';
                document.getElementById("term").value = '';
                document.getElementById("form-server-response-container").innerHTML = syncRequest.responseText;
                document.getElementById("form-server-response-container").style.animation = 'fadeIn 0.3s ease-in-out 0s forwards';
            }
            else {
                document.getElementById("form-server-response-container").innerText = "Server Error. Failed to add record.";
            }
                    
    }, false);

    syncRequest.send();
}

function signOut() {
	window.location.href = "https://www.cs.mcgill.ca/~dpeter19/McGill_TA_Website/matter/home.html";
}





