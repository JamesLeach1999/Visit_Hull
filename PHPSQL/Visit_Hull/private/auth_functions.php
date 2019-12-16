<?php
function log_in_admin($admin){
    // regenerates session id to stop people from using a previous session thingy. session fixation
    session_regenerate_id();
    $_SESSION['admin_id'] = $admin['id'];
    $_SESSION['last_login'] = time();
    $_SESSION['username'] = $admin['username'];

    return true;
}
// this function contains all the logic to determine whether or not ur making a request as a logged in user. display one link if logged in, another if not
function is_logged_in(){
    // having admin_id indicates they admin is logged in and also which one
    return isset($_SESSION['admin_id']);
}
// if a log in is required and is not true, this will just send the user back
function require_login(){
    if(!is_logged_in()){
        redirect_to(url_for('/staff/login.php'));
    }
}
// opposite of login, could destroy the session too but you may need it for other shit
function logout_admin(){
    unset($_SESSION['admin_id']);
    unset($_SESSION['last_login']);
    unset($_SESSION['username']);

    return true;
}
?>