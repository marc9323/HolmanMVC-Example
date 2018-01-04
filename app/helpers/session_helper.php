<?php

// must run this function in order to use sessions
session_start();

// Flash message helper
// EXAMPLE - flash('register_success', 'You are now registered', 'alert alert-danger');
// DISPLAY IN VIEW - echo flash('register_success');
function flash($name='', $message='', $class='alert alert-success') {
    if(!empty($name)) {
        // if name is passed in and message and session not already set
        if(!empty($message) && empty($_SESSION[$name])) {
            // if set,  unset session
            if(!empty($_SESSION[$name])) {
                unset($_SESSION[$name]);
            }

            // do same thing with the class
            if(!empty($_SESSION[$name. '_class'])) {
                unset($_SESSION[$name. '_class']);
            }
            // set the session
            $_SESSION[$name] = $message;
            $_SESSION[$name. '_class'] = $class;
        } elseif(empty($message) && !empty($_SESSION[$name])) {
            $class = !empty($_SESSION[$name. '_class']) ? $_SESSION[$name. '_class'] : '';
            echo '<div class="'.$class.'" id="msg-flash">'.$_SESSION[$name].'</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name. '_class']);
        }
    }
}

function isLoggedIn() {
    if(isset($_SESSION['user_id'])) {
        return true;
    } else {
        return false;
    }
}