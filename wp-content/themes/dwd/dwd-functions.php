<?php

function bsimple_scripts() {
    wp_enqueue_style( 'bsimple-style', get_stylesheet_uri() );
    wp_enqueue_style( 'bsimple-clean', get_template_directory_uri() . '/css/clean-blog.min.css' );
    wp_enqueue_style( 'bsimple-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
    wp_enqueue_style( 'bsimple-fontawesome', get_template_directory_uri() . '/css/fa-all.min.css' );
    wp_enqueue_style( 'bsimple-font1', "https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" );
    wp_enqueue_style( 'bsimple-font2', "https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" );

    wp_enqueue_script( 'bsimple-jq', get_template_directory_uri() . '/js/jquery.min.js');
    wp_enqueue_script( 'bsimple-bootstrap', get_template_directory_uri() . '/js/bootstrap.bundle.min.js');
    wp_enqueue_script( 'bsimple-clean', get_template_directory_uri() . '/js/clean-blog.min.js');
    wp_enqueue_script( 'bsimple-js', get_template_directory_uri() . '/js/clean-blog.min.js');
    wp_enqueue_script( 'dwd-js', get_template_directory_uri() . '/js/dwd.js');
}    
add_action( 'wp_enqueue_scripts', 'bsimple_scripts' ); 

?>

<script>
    (function() {
    var contact_btn = document.getElementById('contact_form');

    var contact_submit = document.getElementById('contact_submit');
    contact_submit.addEventListener('click', sendEmail);

    function validateName() {
        var name = document.getElementById('contact_name').value;
        var re = '';
        return name !== re;
    }

    function validateEmail() {
        var email = document.getElementById('contact_email').value;
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    function validateMsg() {
        var msg = document.getElementById('contact_body').value;
        var re = '';
        return msg !== re;
    }

    function validateAll() {
        return (!validateName() || !validateEmail() || !validateMsg() ) 
        ? false
        : true;
    }

    function enableSubmit() {
        if (validateAll()) {
            contact_submit.classList.remove('disabled');
            contact_submit.disabled = false;
        }
    }

    var contact_name_input = document.getElementById('contact_name');
    var contact_email_input = document.getElementById('contact_email');
    var contact_body_input = document.getElementById('contact_body');

    contact_name_input.addEventListener('keyup', enableSubmit);
    contact_email_input.addEventListener('keyup', enableSubmit);
    contact_msg_input.addEventListener('keyup', enableSubmit);

    function sendEmail(e) {
        e.preventDefault();
        if (validateAll()) {
        var name = contact_name_input.value;
        var email = contact_email_input.value;
        var msg = contact_body_input.value;
        var send_to = 'hi@dwd.work';
        var success_msg = document.getElementById('contact_success');
        var error_msg = document.getElementById('contact_error');
        var url = admin_url.ajax_url;
        var xhr = new XMLHttpRequest(); 
        var params = 'action=zp_send_email' +
            '&name=' + name +
            '&email=' + email +
            '&message=' + msg +
            '&send_to=' + send_to;

        xhr.onreadystatechange = function() {
            console.log('xhr started');
            if (xhr.readyState === 4) {
            console.log('readyState === 4');
            if (xhr.status !== 200) {
                console.log('Error: xhr ' + xhr.status);
                console.log('Error: $http.response ', xhr.response);
                zavvie_contact.style.display = 'none';
                error_msg.style.display = 'block';
            } else {
                var response = JSON.parse(xhr.response);
                console.log('Success: xhr.response ', response);
                zavvie_contact.style.display = 'none';
                success_msg.style.display = 'block';
            }
            }
        }

        console.log('params:', params);
        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send(params);
        }
    }
    })()
</script>