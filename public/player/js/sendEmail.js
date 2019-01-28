/////////////////////////////////////////////////////////////////////////////////
////////////////////start of send email from FOOTER/////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
$(document).on('click', "#sendemail", function (e) {    
    e.preventDefault();
    var errors = 0;

    var message_name = $("input[name=message_name]").val();

    if (message_name.replace(/\s/g, "") === "") {

        errors = 1;
        $("input[name=message_name]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("input[name=message_name]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var message_email = $("input[name=message_email]").val();
    
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    console.log(re.test(String(message_email).toLowerCase()));

    if (message_email.replace(/\s/g, "") === "" || re.test(String(message_email).toLowerCase()) === false) {

        errors = 1;
        $("input[name=message_email]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("input[name=message_email]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var message_subject = $("input[name=message_subject]").val();

    if (message_subject.replace(/\s/g, "") === "") {

        errors = 1;
        $("input[name=message_subject]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("input[name=message_subject]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var message_subject = $("input[name=message_subject]").val();

    if (message_subject.replace(/\s/g, "") === "") {

        errors = 1;
        $("input[name=message_subject]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("input[name=message_subject]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var message_message = $.trim($("#message_message").val());

    if (message_message.replace(/\s/g, "") === "") {

        errors = 1;
        $("#message_message").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("#message_message").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    if (errors === 0) {
        $('#sendemailLoader').fadeIn();

        $("input[name=message_name]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("input[name=message_email]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("input[name=message_subject]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("#message_message").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        
        var _token = $("input[name=_token]").val();
        $.ajax({
            type: 'POST',
            url: '/contactus',

            data: {
                //playerId: playerId,
                _token: _token,
                name: message_name,
                email: message_email,
                subject: message_subject,
                E_message: message_message,
            },
            success: function (data) {
                console.log(data);
                if (data === 'true') {
                    //alert('sendded') ;
                    $('#sendemailLoader').fadeOut();
                    setTimeout(function () {
                        $('#contactSuccess').fadeIn();
                    }, 1000);
                    setTimeout(function () {
                        $('#contactSuccess').fadeOut();
                    }, 5000);
                } else if (data === 'false') {
                    //alert('error');
                    $('#sendemailLoader').fadeOut();
                    setTimeout(function () {
                        $('#contactError').fadeIn();
                    }, 1000);
                    setTimeout(function () {
                        $('#contactError').fadeOut();
                    }, 5000);
                }


            }
        });

    } else {

    }

});
/////////////////////////////////////////////////////////////////////////////////
////////////////////end of send email from FOOTER/////////////////////////////
/////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////
////////////////////start of send email from contact us page/////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
$(document).on('click', "#sendemail_page", function (e) {    
    e.preventDefault();
    var errors = 0;

    var message_name_page = $("input[name=message_name_page]").val();

    if (message_name_page.replace(/\s/g, "") === "") {

        errors = 1;
        $("input[name=message_name_page]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("input[name=message_name_page]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var message_email_page = $("input[name=message_email_page]").val();
    
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    console.log(re.test(String(message_email_page).toLowerCase()));

    if (message_email_page.replace(/\s/g, "") === "" || re.test(String(message_email_page).toLowerCase()) === false) {

        errors = 1;
        $("input[name=message_email_page]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("input[name=message_email_page]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var message_subject_page = $("input[name=message_subject_page]").val();

    if (message_subject_page.replace(/\s/g, "") === "") {

        errors = 1;
        $("input[name=message_subject_page]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("input[name=message_subject_page]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var message_subject_page = $("input[name=message_subject_page]").val();

    if (message_subject_page.replace(/\s/g, "") === "") {

        errors = 1;
        $("input[name=message_subject_page]").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("input[name=message_subject_page]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    var message_message_pages = $.trim($("#message_message_pages").val());

    if (message_message_pages.replace(/\s/g, "") === "") {

        errors = 1;
        $("#message_message_pages").css({
            border: '2px solid #e80f0f',
            background: '#f7e7e7'
        });

    } else {
        $("#message_message_pages").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
    }

    if (errors === 0) {
        $('#sendemailLoader_page').fadeIn();

        $("input[name=message_name_page]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("input[name=message_email_page]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("input[name=message_subject_page]").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        $("#message_message_pages").css({
            border: '2px solid #5cb85c',
            background: '#b2e8b2'
        });
        
        var _token = $("input[name=_token]").val();
        $.ajax({
            type: 'POST',
            url: '/contactus',

            data: {
                //playerId: playerId,
                _token: _token,
                name: message_name_page,
                email: message_email_page,
                subject: message_subject_page,
                E_message: message_message_pages,
            },
            success: function (data) {
                console.log(data);
                if (data === 'true') {
                    //alert('sendded') ;
                    $('#sendemailLoader_page').fadeOut();
                    setTimeout(function () {
                        $('#contactSuccess_page').fadeIn();
                    }, 1000);
                    setTimeout(function () {
                        $('#contactSuccess_page').fadeOut();
                    }, 5000);
                } else if (data === 'false') {
                    //alert('error');
                    $('#sendemailLoader_page').fadeOut();
                    setTimeout(function () {
                        $('#contactError_page').fadeIn();
                    }, 1000);
                    setTimeout(function () {
                        $('#contactError_page').fadeOut();
                    }, 5000);
                }


            }
        });

    } else {

    }

});
/////////////////////////////////////////////////////////////////////////////////
////////////////////end of send email from contact us page/////////////////////////////
/////////////////////////////////////////////////////////////////////////////////