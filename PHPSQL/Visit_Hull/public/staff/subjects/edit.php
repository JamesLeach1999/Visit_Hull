<?php require('../../../private/initialize.php'); ?>

<?php
require_login();
// this is how you would do single page form processing, has the advantage of if the user fucks up you can repopulate with their values

// this line says if there isnt an id, dont sho the page, if there is then use it, as shown 3 lines down
if (!isset($_GET['id'])) {
    redirect_to(url_for('/staff/subjects/index.php'));
}
$id = $_GET['id'];

// with no id, just goes back to subjects
if (request_is_post()) {
    // this handles form values sent by new.php
    // just doing these so the form dosent blow up, in 
    $subject = [];
    $subject['id'] = $id;
    $subject['menu_name'] = $_POST['menu_name'] ?? "";
    $subject['position'] = $_POST['position'] ?? "";
    $subject['visible'] = $_POST['visible'] ?? "";
    // this carries out everything in one line, this is the beauty of functions
    $result = update_subject($subject);
    // remember update, create and delete all retrn booleans, if subject did update, redirect to show.php
    // if not, dump the errors on the screen
    if ($result === true) {
        redirect_to(url_for("/staff/subjects/show.php?id=" . $id));
    } else {
        $errors = $result;
        // var_dump($errors);
    }
} else {
    // if its not a post request, it will find the subject by its id
    $subject = find_subject_by_id($id);
};
// these 3 lines tell us what the subject count is
$subject_set = find_all_subjects();
$subject_count = mysqli_num_rows($subject_set);
mysqli_free_result($subject_set);
?>

<?php $page_title = 'Edit Subject'; ?>
<?php include(SHARED_PATH . "/staff_header.php"); ?>

<div id="content">

    <a href="<?php echo url_for('/staff/subjects/index.php'); ?>" class="back-link">Back to lists</a>

    <div class="subject-edit">
        <h1>Edit subject</h1>
        <!-- these weird d tags stand for data list, data terms and data definitions, can use any other tbh -->
        <?php echo display_errors($errors); ?>
        <form action="<?php echo url_for('/staff/subjects/new.php'); ?>" method="post">
            <dl>
                <dl>
                    <dt>Menu name</dt>
                    <!-- setting the value as menu_name from above, so it stays there even after submission -->
                    <dd><input type="text" name="menu_name" value="<?php echo ht($subject['menu_name']); ?>"></dd>
                </dl>
                <dl>
                    <dt>Position</dt>
                    <dd>
                        <select name="position">
                            <option value="1" <?php
                                                // this is instead of outputting a single option
                                                for ($i = 1; $i <= $subject_count; $i++) {
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
                        <input type="checkbox" name="visible" value="0">
                        <option value="1" <?php
                                            if ($subject['visible'] == "1") {
                                                echo "Selected";
                                            };
                                            ?>></option>

                    </dd>
                </dl>
                <div id="operations">
                    <input type="submit" value="Edit subject">
                </div>
        </form>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php');
