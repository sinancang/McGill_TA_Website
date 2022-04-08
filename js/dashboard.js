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
            getSecondaryMenuItems('sys-ops');
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
    var username = document.getElementById('user').value;
    var password = document.getElementById('pass').value;
    //var encrypted_password = CryptoJS.AES.encrypt(password, 5);

    // make Ajax call to login.php with username & encrypted password
    syncRequest = new XMLHttpRequest();
    var url = "../php/login.php";
    syncRequest.open("POST", url, true);

    syncRequest.addEventListener("load", function(){
    console.log(this.status);
            if (this.status === 200) {
                    window.location.href = `../php/dashboard.php?user=${this.responseText}`;
            }
            else {
                    alert('failed to log in.');
            }
                    
    }, false);

    var fd = new FormData;
    fd.append ('user', document.getElementById("user").value);
    fd.append ('pass', document.getElementById("pass").value);
    syncRequest.send (fd);
}

