<?php

require_once("../../private/initialize.php");
require_login();
if (request_is_post()) {

    // this handles form values sent by new.php
    $subject = [];
    $admin['id'] = $_GET['id'] ?? "1";

    $admin['first_name'] = $_POST['first_name'] ?? "";
    $admin['last_name'] = $_POST['last_name'] ?? "";
    $admin['email'] = $_POST['email'] ?? "";
    $admin['username'] = $_POST['username'] ?? "";
    $admin['password'] = $_POST['password'] ?? "";
    $admin['confirm_password'] = $_POST['confirm_password'] ?? "";

    // putting it into an array just makes it a bit more compact
    $result = update_admin($admin);
    if ($result === true) {
        $new_id = mysqli_insert_id($db);
        $_SESSION['message'] = "Admin created";
        redirect_to(url_for('/staff/subjects/show.php?id=' . $new_id));
    } else {
        $errors = $result;
    }
} else {
    $admin = find_admin_by_id($admin['id']);
}
?>
<form action="<?php echo url_for('/admins/edit.php'); ?>" method="post">
    <dl>
        <dt>First name</dt>
        <dd><input type="text" name="first_name" value="<?php echo ht($admin['first_name']); ?>"></dd>
    </dl>
    <dl>
        <dt>Last name</dt>
        <dd><input type="text" name="last_name" value="<?php echo ht($admin['last_name']); ?>"></dd>
    </dl>
    <dl>
        <dt>username</dt>
        <dd><input type="text" name="username" value="<?php echo ht($admin['username']); ?>"></dd>
    </dl>
    <dl>
        <dt>email</dt>
        <dd><input type="text" name="email" value="<?php echo ht($admin['email']); ?>"></dd>
    </dl>
    <dl>
        <dt>Password</dt>
        <dd><input type="password" name="password" value=""></dd>
    </dl>
    <dl>
        <dt>Confirm password</dt>
        <dd><input type="password" name="confirm_password" value=""></dd>
    </dl>
    <div id="operations">
        <input type="submit" value="edit admin" />
    </div>
</form>