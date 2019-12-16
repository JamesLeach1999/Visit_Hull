<?php require_once('../../../private/initialize.php'); ?>

<!-- so this page dosent even have any html, its just a form processing page -->
<?php
// if it is a post aka a new subject, it will do this. the function will return true or false based on if its a post
if(request_is_post()){

//  this handles form values sent by new.php
$subject = [];
$subject['menu_name'] = $_POST['menu_name'] ?? "";
$subject['position'] = $_POST['position'] ?? "";
$subject['visible'] = $_POST['visible'] ?? "";
// putting it into an array just makes it a bit more compact
$result = insert_subject($subject);
if($result === true){
    $new_id = mysqli_insert_id($db);
    redirect_to(url_for('/staff/subjects/show.php?id=' . $new_id . ""));
} else {
    $errors = $result;
}

} else {
    // if it isnt a post it will just redirect you to here, these functions are all proper simple
    redirect_to(url_for('/staff/subjects/new.php'));
}
// so when you hightlight the url and hit enter, it makes a get request, so sends you back

?>