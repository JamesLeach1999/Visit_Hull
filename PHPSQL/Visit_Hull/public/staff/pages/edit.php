<?php require_once('../../../private/initialize.php'); ?>

<?php
require_login();
if (!isset($_GET['id'])) {
    redirect_to(url_for('/staff/pages/index.php'));
}

$id = $_GET["id"];

if (request_is_post()) {

    $page = [];
    $page['id'] = $id;
    $page['page_name'] = $_POST['page_name'] ?? "";
    $page['wagbo'] = $_POST['wagbo'] ?? "";
    $page['visible'] = $_POST['visible'] ?? "";

    $result = update_page($page);
} else {
    $page = find_page_by_id($id);
}
$page_set = find_all_pages();
$page_count = mysqli_num_rows($page_set);
mysqli_free_result($page_set);
?>

<?php $page_title = "Edit page"; ?>

<?php include(SHARED_PATH . "/staff_header.php"); ?>

<div id="content">

    <a href="<?php echo url_for('/staff/pages/index.php'); ?>" class="back-link">Back to lists</a>

    <div class="page-edit">
        <h1>edit page</h1>

        <form action="<?php echo url_for('/staff/pages/edit.php?id=' . ht(u($id))); ?>" method="post">
            <dl>
                <dt>Menu name</dt>

                <dd><input type="text" name="page_name" value="<?php echo ht($page['page_name']) ?>"></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position">
                        <option value="1">1</option>
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
                <input type="submit" value="Create page">
            </div>
        </form>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php');
?>