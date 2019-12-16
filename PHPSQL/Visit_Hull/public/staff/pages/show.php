<?php require_once('../../../private/functions.php') ?>
<?php require_once('../../../private/initialize.php'); ?>
<?php include(SHARED_PATH . "/staff_header.php"); ?>
<?php require_login();?>

<?php

$id = $_GET['id'] ?? '1';
// lol this dosent work, since you sent it through after clicking the link
// actually kinda does so they cant fuck up the page whilst on it
$id = ht($id);
$id = u($id);
echo $id;
$page = find_page_by_id($id);


?>
<div class="actions">
    <a href="<?php echo url_for('/index.php?id=' . ht(u($page['id'])) . "&preview=true") ?>" class="action">Preview</a>
</div>
<br>
<a href="<?php echo url_for('/staff/pages/index.php') ?>" class="action">Back to menu</a>
<?php include(SHARED_PATH . "/staff_footer.php"); ?>