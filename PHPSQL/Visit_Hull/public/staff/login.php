<?php require_once('../../private/initialize.php'); ?>
<?php
require_once("../../private/auth_functions.php");

$errors = [];
$username = '';
$password = '';
if (request_is_post()) {

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if(is_blank($username)){
        $errors[] = "username cannot be blank";
    }
    if (is_blank($password)) {
        $errors[] = "password cannot be blank";
    }
    if(empty($errors)){

        $admin = find_admin_by_username($username);
        // using one variable ensures messages are the same
        // var_dump($admin);
        $login_failure_msg = "log in unsuccessful";
        if($admin){
            if(password_verify($password, $admin['hashed_password'])){
                log_in_admin($admin);
                // if login succesful, reirect to index
                redirect_to(url_for('/staff/index.php'));
            } else {
                // username found but password dont match
                $errors[] = $login_failure_msg;
            }
            
        } else {
            echo "numberwang";
            $errors[] = $login_failure_msg;

        }
    }

//     log_in_admin($admin);
// // if login succesful, reirect to index
//     redirect_to(url_for('/staff/index.php'));
}
var_dump($_SESSION);



?>
<?php $page_title = 'Staff login'; ?>

<?php include(SHARED_PATH . '/staff_header.php') ?>


<div id="content">
    <div id="main-menu">
        <h1>Log in</h1>
        <form action="login.php" method="post">
            Username: <input type="text" name="username" id="username">
            <br>
            Password: <input type="password" name="password" id="password">
            <br>
            <input type="submit" value="submit">
        </form>
    </div>


</div>


<!-- using the 2 dots means go back a directory -->
<!-- include means use this  file, require will raise and error if not there -->
<?php include(SHARED_PATH . '/staff_footer.php'); ?>