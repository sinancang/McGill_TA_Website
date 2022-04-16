"use strict";

/*
    Wait for DOM to load and then
    set up all initial event listeners etc.
*/
window.addEventListener('DOMContentLoaded', (event) => {

    // set event listeners for primary nav bar options
    $('.nav-bar-btn-container.first-nav-bar').on('click', function() {

        $('.dashboard-content-side-nav-bar.first-nav-bar').removeClass('open');
        $('.dashboard-content-side-nav-bar.second-nav-bar').addClass('open');

        $(this).css({'background-color': ''})

        if ($(this).attr('id') == 'admin') {
            getSecondaryMenuItems('admin');
        }
        else if ($(this).attr('id') == 'manage') {
            getSecondaryMenuItems('manage');
        }
        else if ($(this).attr('id') == 'rate') {
            getSecondaryMenuItems('rate');
        }
        else if ($(this).attr('id') == 'sys-ops') {
            fillSecondaryMenu('sys-ops');
        }
    });


    $('#main-dashboard').on('click', function() {
        let user = document.getElementById('username').innerText;
        let syncRequest = new XMLHttpRequest();
        var url = `../routes/dashboard.php?user=${user}&view=main`;
        syncRequest.open("GET", url, true);  
        syncRequest.addEventListener("load", function(){           
            if (this.status === 200) if (this.status === 200) {
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
    
        let syncRequest = new XMLHttpRequest();
        var url = `../routes/dashboard.php?role=${menuName}`;
        syncRequest.open("GET", url, true);
    
        syncRequest.addEventListener("load", function(){
            
            if (this.status === 200) fillSecondaryMenu();
            else console.log('invalid user role');
    
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
            var url = `../routes/dashboard.php?user=${user}&view=manage-users`;
            syncRequest.open("GET", url, true);  
            syncRequest.addEventListener("load", function(){           
                if (this.status === 200) {
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
            var url = `../routes/dashboard.php?user=${user}&view=add-manually-users`;
            syncRequest.open("GET", url, true);  
            syncRequest.addEventListener("load", function(){           
                if (this.status === 200) {
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
    else if (menuName == 'manage-ta') {
    }
    // ta rating secondary menu
    else if (menuName == 'rate-ta') {
    }
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
    

    var url = `../routes/dashboard.php?action=manual-upload&user=${user}&new-prof=${prof}&course-code=${courseCode}&course-name=${courseName}&term=${term}`;
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


/*
    Set up event listeners etc. for when user management view is loaded.
*/
function set_up_manage_users_view() {
    $('#user-type-select').on('change', function() {
        let value = $('#user-type-select').val();
        $('.user-accounts').removeClass('open');

        console.log('here');


        if (value == 'TA') {
            $('.user-accounts.ta').addClass('open');
        }
        if (value == 'Professor') {
            $('.user-accounts.prof').addClass('open');
        }
        if (value == 'Administrator') {
            $('.user-accounts.admin').addClass('open');
        }
        if (value == 'Student') {
            $('.user-accounts.student').addClass('open');
        }
        if (value == 'All') {
            $('.user-accounts.all').addClass('open');
        }
        if (value == 'Sys-Op') {
            $('.user-accounts.sys-op').addClass('open');
        }
        if (value == 'deactivated') {
            $('.user-accounts.deactivated').addClass('open');
        }

    });


    // add delete event listener
    $('.user-account-entries').on('click', '.remove-user', function() {
        let user = document.getElementById('username').innerText;
        let user_to_delete = $(this).attr('target');

        let selectedOption;
        if ($('#user-type-select').val() == 'All') selectedOption = 'all';
        if ($('#user-type-select').val() == 'TA') selectedOption = 'ta';
        if ($('#user-type-select').val() == 'Administrator') selectedOption = 'admin';
        if ($('#user-type-select').val() == 'Professor') selectedOption = 'prof';
        if ($('#user-type-select').val() == 'Sys-Op') selectedOption = 'sysop';
        
        let syncRequest = new XMLHttpRequest();
        var url = `../routes/dashboard.php?user=${user}&action=delete-user&target=${user_to_delete}`;
        syncRequest.open("GET", url, true);  
        syncRequest.addEventListener("load", function(){           
            if (this.status === 200) {
                $('.dashboard-dynamic-content-main')[0].innerHTML = this.responseText;
                $(`.user-accounts.${selectedOption}`).addClass('open');
                set_up_manage_users_view();
                $("#user-type-select").val(selectedOption).change();
            }
            else alert('Server Error. Please try again later.');
    
        }, false);
    
        syncRequest.send();
    });

    // reactivate button event handler
    $(".user-account-entries").on("click", '.reactivate-user', function(){
        let user = document.getElementById('username').innerText;
        let user_to_reactivate = $(this).attr('target');

        let syncRequest = new XMLHttpRequest();
        var url = `../routes/dashboard.php?user=${user}&action=reactivate-user&target=${user_to_reactivate}`;
        syncRequest.open("GET", url, true);  
        syncRequest.addEventListener("load", function(){     
            
            if (this.status === 200) {
                $('.dashboard-dynamic-content-main')[0].innerHTML = this.responseText;
                set_up_manage_users_view();
                $("#user-type-select").val('deactivated').change();
            }
            else alert('Server Error. Please try again later.');

        }, false);
        syncRequest.send();
    });
}



