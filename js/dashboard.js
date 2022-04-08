"use strict";


window.addEventListener('DOMContentLoaded', (event) => {

    // ajax call to get main dashboard content

    /*
    syncRequest = new XMLHttpRequest();
    var url = "../php/dashboard_home.php";
    syncRequest.open("GET", url, true);
        
    syncRequest.addEventListener("load", function(){
    console.log(this.status);
            if (this.status === 200) {
                    console.log(this.response);
            }
            else {
                    alert ('failed to log in.');
            }
                    
    }, false);

    var fd = new FormData;
    fd.append ('user', document.getElementById("user").value);
    fd.append ('pass', document.getElementById("pass").value);
    syncRequest.send (fd);
    */




    $('.nav-bar-btn-container.first-nav-bar').on('click', function() {
        console.log('hi');
        $('.dashboard-content-side-nav-bar.first-nav-bar').removeClass('open');
        $('.dashboard-content-side-nav-bar.second-nav-bar').addClass('open');
    })
    
    $('.nav-bar-btn-container.back-btn').on('click', function() {
        $('.dashboard-content-side-nav-bar.first-nav-bar').addClass('open');
        $('.dashboard-content-side-nav-bar.second-nav-bar').removeClass('open');
    })
});

