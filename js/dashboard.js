"use strict";

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
            if (this.status === 200) fillMainDashboardContent(syncRequest.responseText);
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


});


function getSecondaryMenuItems(menuName) {
    
        let syncRequest = new XMLHttpRequest();
        var url = `../routes/dashboard.php?role=${menuName}`;
        syncRequest.open("POST", url, true);
    
        syncRequest.addEventListener("load", function(){
            
            if (this.status === 200) fillSecondaryMenu();
            else alert('Invalid user role.');
    
        }, false);
    
        syncRequest.send();
    
}



// display correct content in secondary menu in side-nav-bar
function fillSecondaryMenu(menuName) {
    if (menuName == 'sys-ops') {
        document.getElementById('second-nav-bar-options-container').innerHTML = 
        `
        <div id="manage-users" class="nav-bar-btn-container second-nav-bar">
            <div class="nav-bar-btn-wrapper  second-nav-bar">
                <div class="nav-bar-btn">Manage Users</div>
            </div>
        </div>
        <div id="import-users" class="nav-bar-btn-container second-nav-bar">
            <div class="nav-bar-btn-wrapper  second-nav-bar">
                <div class="nav-bar-btn">Import</div>
            </div>
        </div>
        <div id="add-manually-users" class="nav-bar-btn-container second-nav-bar">
            <div class="nav-bar-btn-wrapper  second-nav-bar">
                <div class="nav-bar-btn">Add Manually</div>
            </div>
        </div>
        `;

        // add event listeners that are specific to sys-ops menu

        $('.nav-bar-btn-container.second-nav-bar').on('click', function() {
            $('.nav-bar-btn-container.second-nav-bar').css({'color': 'rgb(103, 103, 103)'});
            $(this).css({'color': '#7474ff'});
        });

        $('#manage-users').on('click', function() {
            let user = document.getElementById('username').innerText;
            let syncRequest = new XMLHttpRequest();
            var url = `../routes/dashboard.php?user=${user}&view=manage-users`;
            syncRequest.open("GET", url, true);  
            syncRequest.addEventListener("load", function(){           
                if (this.status === 200) fillMainDashboardContent(syncRequest.responseText);
                else alert('Invalid user role.');
        
            }, false);
        
            syncRequest.send();
        });

        $('#import-users').on('click', function() {
            let user = document.getElementById('username').innerText;
            let syncRequest = new XMLHttpRequest();
            var url = `../routes/dashboard.php?user=${user}&view=import-users`;
            syncRequest.open("GET", url, true);  
            syncRequest.addEventListener("load", function(){           
                if (this.status === 200) fillMainDashboardContent(syncRequest.responseText);
                else alert('Invalid user role.');
        
            }, false);
        
            syncRequest.send();
        });

        $('#add-manually-users').on('click', function() {
            let user = document.getElementById('username').innerText;
            let syncRequest = new XMLHttpRequest();
            var url = `../routes/dashboard.php?user=${user}&view=add-manually-users`;
            syncRequest.open("GET", url, true);  
            syncRequest.addEventListener("load", function(){           
                if (this.status === 200) fillMainDashboardContent(syncRequest.responseText);
                else alert('Invalid user role.');
        
            }, false);
        
            syncRequest.send();
        });
    }
}


function fillMainDashboardContent(html) {
    $('#dashboard-dynamic-content')[0].innerHTML = html;
}


function submitAddManuallyForm() {
    // make Ajax call to dashboard.php with prof name & course code
    let syncRequest = new XMLHttpRequest();
    let user = document.getElementById('username').innerText;
    let prof = document.getElementById("new-prof").value;
    let courseCode = document.getElementById("course-code").value;  
    var url = `../routes/dashboard.php?user=${user}&new-prof=${prof}&course-code=${courseCode}`;
    syncRequest.open("POST", url, true);
    syncRequest.setRequestHeader("Content-Type", "multipart/form-data");

    syncRequest.addEventListener("load", function(){
            if (this.status === 200) {
                // clear form values and display server response
                document.getElementById("new-prof").value = '';
                document.getElementById("course-code").value = '';
                document.getElementById("form-server-response-container").innerText = syncRequest.responseText;
            }
            else {
                document.getElementById("form-server-response-container").innerText = "Server Error. Failed to add record.";
            }
                    
    }, false);

    syncRequest.send();
}


/*
<div class="nav-bar-btn-container">
    <div class="nav-bar-btn-wrapper  second-nav-bar">
        <div class="nav-bar-btn">COMP 521</div>
        <div class="nav-bar-btn-subtitle">Modern Computer Games</div>
    </div>
</div>
*/


