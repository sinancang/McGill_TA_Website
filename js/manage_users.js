



/*
    Set up event listeners etc. for when user management view is loaded.
*/
function set_up_manage_users_view() {

    // edit user btns event listener
    $('.edit-user').on('click', function() {
        $('.content-veil').css({'display':'flex'});

        let user_to_edit = $(this).attr('target');
        let user = document.getElementById('username').innerText;

        let syncRequest = new XMLHttpRequest();
        var url = `../routes/dashboard.php?user=${user}&action=edit-user-form&target=${user_to_edit}`;
        syncRequest.open("GET", url, true);  
        syncRequest.addEventListener("load", function(){           
            if (this.status == 200) {
                $('.content-veil')[0].innerHTML = this.responseText;
            }
            else alert('Server Error. Please try again later.');
    
        }, false);
    
        syncRequest.send();
    });

    // add new user btn event listener
    $('.add-new-user-btn').on('click', function() {
        $('.content-veil').css({'display':'flex'});

        let user = document.getElementById('username').innerText;

        let syncRequest = new XMLHttpRequest();
        var url = `../routes/dashboard.php?user=${user}&action=add-new-user-form`;
        syncRequest.open("GET", url, true);  
        syncRequest.addEventListener("load", function(){           
            if (this.status == 200) {
                $('.content-veil')[0].innerHTML = this.responseText;
            }
            else alert('Server Error. Please try again later.');
    
        }, false);
    
        syncRequest.send();
    });


    // event listener for close veil btn
    $('.content-veil').on('click', '#close-veil-btn', function() {
        $('.content-veil').css({'display':'none'});
    });

    // add new user btn event listener
    $('#submit-add-new-user-btn').on('click', function() {
        let user = document.getElementById('username').innerText;
        let new_user_name = document.getElementById('new-user-name').value;
        let new_user_email = document.getElementById('new-user-email').value;
        let new_user_role = document.getElementById('new-user-type').value;

        
        let syncRequest = new XMLHttpRequest();
        var url = `../routes/dashboard.php?user=${user}&action=create-new-user&name=${new_user_name}&email=${new_user_email}&type=${new_user_role}`;
        syncRequest.open("GET", url, true);  
        syncRequest.addEventListener("load", function(){           
            if (this.status == 200) {
                if (this.responseText == "  \nAccount already exists.") {
                    $('.new-user-server-response').text(this.responseText);
                }
                else {
                    $('.content-veil').css({'display':'none'});
                    $('.form-wrapper.add-new-user-form').css({'display':'none'});
                    $('.dashboard-dynamic-content-main')[0].innerHTML = this.responseText;
                    set_up_manage_users_view(); // have to reset events cos ajax content was reloaded
                }
            }
            else alert('Server Error. Please try again later.');
    
        }, false);
    
        syncRequest.send();
    });


    // selectbox events
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


    // deactivate btn event listener
    $('.user-account-entries').on('click', '.remove-user', function() {
        let user = document.getElementById('username').innerText;
        let user_to_delete = $(this).attr('target');

        let selectedOption = $('#user-type-select').val();

        
        let syncRequest = new XMLHttpRequest();
        var url = `../routes/dashboard.php?user=${user}&action=delete-user&target=${user_to_delete}`;
        syncRequest.open("GET", url, true);  
        syncRequest.addEventListener("load", function(){           
            if (this.status == 200) {
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
            
            if (this.status == 200) {
                $('.dashboard-dynamic-content-main')[0].innerHTML = this.responseText;
                set_up_manage_users_view();
                $("#user-type-select").val('deactivated').change();
            }
            else alert('Server Error. Please try again later.');

        }, false);
        syncRequest.send();
    });
}