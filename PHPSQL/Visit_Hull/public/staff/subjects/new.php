<?php require_once('../../../private/initialize.php');
// this grabs the test param from the url, and displays the error/ redirect messages
// if it is a post aka a new subject, it will do this. the function will return true or false based on if its a post
require_login();
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
    // display the blank form
}
// --------------------------------------------//
// THE CODE ABOVE WAS FROM CREATE.PHP, BUT WE ARE MAKING IT A SINGLE PAGE SUBMISSION
// so when you hightlight the url and hit enter, it makes a get request, so sends you back

$subject_set = find_all_subjects();
// adding the one because it is the position and the new row you created
$subject_count = mysqli_num_rows($subject_set) + 1;
mysqli_free_result($subject_set);

$subject = [];
$subject['position'] = $subject_count;
?>
<!-- right this is the create subject page with a whole lot of html  -->

<?php $page_title = 'Create Subject'; ?>
<?php include(SHARED_PATH . "/staff_header.php"); ?>

<div id="content">

    <a href="<?php echo url_for('/staff/subjects/index.php'); ?>" class="back-link">Back to lists</a>

    <div class="subject-new">
        <h1>create subject</h1>
<!-- these weird d tags stand for data list, data terms and data definitions, can use any other tbh -->
<!-- the form sends the data to the create.php bit -->
<?php echo display_errors($errors); ?>
        <form action="<?php echo url_for('/staff/subjects/create.php'); ?>" method="post">
            <dl>
                <dt>Menu name</dt>
                <dd><input type="text" name="menu_name" value=""></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position">
                        <option value="1" <?php
                        for($i=1; $i <= $subject_count; $i++ ){
                            echo "<option value=\"{$i}\"";
                            if ($subject['position'] == $i) {
                                echo "Selected";
                        }
                        echo ">{$i}</option>";
                            };
                            ?>>1</option>
                    </select>
                </dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd>
                    <input type="hidden" name="visible" value="0">
                    <input type="checkbox" name="visible" value="1">
                </dd>
            </dl>
            <div id="operations">
                <input type="submit" value="Create subject">
            </div>
        </form>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php');