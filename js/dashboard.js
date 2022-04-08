"use strict";

window.addEventListener('DOMContentLoaded', (event) => {

    $('.nav-bar-btn-container.first-nav-bar').on('click', function() {

        $('.dashboard-content-side-nav-bar.first-nav-bar').removeClass('open');
        $('.dashboard-content-side-nav-bar.second-nav-bar').addClass('open');

        // make ajax call to show secondary menu
        // secondary menu depends on which optino was selected in primary menu
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
    })
    
    // event for back btn in secondary menu
    // takes user back to primary menu
    $('.nav-bar-btn-container.back-btn').on('click', function() {
        $('.dashboard-content-side-nav-bar.first-nav-bar').addClass('open');
        $('.dashboard-content-side-nav-bar.second-nav-bar').removeClass('open');
    })
});


function getSecondaryMenuItems(menuName) {
    
        syncRequest = new XMLHttpRequest();
        var url = `../dashboard.php?role=${menuName}`;
        syncRequest.open("POST", url, true);
    
        syncRequest.addEventListener("load", function(){
            
            if (this.status === 200) fillSecondaryMenu();
            else alert('Invalid user role.');
    
        }, false);
    
        syncRequest.send ();
    
}

function fillSecondaryMenu(menuName) {
    if (menuName == 'sys-ops') {
        document.getElementById('second-nav-bar-options-container').innerHTML = 
        `
        <div id="manage-users" class="nav-bar-btn-container">
            <div class="nav-bar-btn-wrapper  second-nav-bar">
                <div class="nav-bar-btn">Manage Users</div>
            </div>
        </div>
        <div id="import-users" class="nav-bar-btn-container">
            <div class="nav-bar-btn-wrapper  second-nav-bar">
                <div class="nav-bar-btn">Import</div>
            </div>
        </div>
        <div id="add-manually-users" class="nav-bar-btn-container">
            <div class="nav-bar-btn-wrapper  second-nav-bar">
                <div class="nav-bar-btn">Add Manually</div>
            </div>
        </div>
        `
    }
}


/*
<div class="nav-bar-btn-container">
    <div class="nav-bar-btn-wrapper  second-nav-bar">
        <div class="nav-bar-btn">COMP 521</div>
        <div class="nav-bar-btn-subtitle">Modern Computer Games</div>
    </div>
</div>
*/


