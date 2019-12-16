<?php require_once('../../../private/initialize.php');
// this grabs the test param from the url, and displays the error/ redirect messages
require_login();
if (!isset($_GET['id'])) {
    redirect_to(url_for('/staff/pages/index.php'));
}
$id = $_GET['id'];

$page = find_page_by_id($id);

if (request_is_post()) {

    $result = delete_page($id);
    redirect_to(url_for('/staff/pages/index.php'));
} else {
    $page = find_page_by_id($id);
}

?>

<?php $page_title = 'delete page'; ?>
<?php include(SHARED_PATH . "/staff_header.php"); ?>

<div id="content">

    <a href="<?php echo url_for('/staff/pages/index.php'); ?>" class="back-link">Back to lists</a>

    <div class="subject-delete">
        <h1>delete subject</h1>
        <p>Are you sure you want to delete this subject?</p>
        <p class="item"><?php echo ht($page['page_name']); ?></p>
        <form action="<?php echo url_for('/staff/pages/delete.php?id=' . ht(u($page['id']))); ?>" method="post">

            <div id="operations">
                <input type="submit" value="delete page">
            </div>
        </form>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php');
