"use strict";


window.addEventListener('DOMContentLoaded', (event) => {
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

