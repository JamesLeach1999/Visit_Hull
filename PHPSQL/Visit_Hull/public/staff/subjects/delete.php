<?php require_once('../../../private/initialize.php');
// this grabs the test param from the url, and displays the error/ redirect messages
require_login();
if (!isset($_GET['id'])) {
    redirect_to(url_for('/staff/subjects/index.php'));
}
$id = $_GET['id'];

$subject = find_subject_by_id($id);

if (request_is_post()) {
    
    $result = delete_subject($id);
    redirect_to(url_for('/staff/subjects/index.php'));
} else {
    $subject = find_subject_by_id($id);
}

?>
<!-- right this is the create subject page with a whole lot of html  -->

<?php $page_title = 'delete Subject'; ?>
<?php include(SHARED_PATH . "/staff_header.php"); ?>

<div id="content">

    <a href="<?php echo url_for('/staff/subjects/index.php'); ?>" class="back-link">Back to lists</a>

    <div class="subject-delete">
        <h1>delete subject</h1>
        <p>Are you sure you want to delete this subject?</p>
        <p class="item"><?php echo ht($subject['menu_name']); ?></p>
        <form action="<?php echo url_for('/staff/subjects/delete.php?id=' . ht(u($subject['id']))); ?>" method="post">

            <div id="operations">
                <input type="submit" value="delete subject">
            </div>
        </form>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php');
