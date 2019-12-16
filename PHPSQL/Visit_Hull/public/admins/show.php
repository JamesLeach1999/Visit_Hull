<?php
require_once("../../private/initialize.php");
require_login();
$id = $_GET['id'] ?? "1";
$admin_set = find_admin_by_id($id);

?>

<?php $page_title = " show admins"; ?>
<?php include(SHARED_PATH . "/staff_header.php"); ?>

<div id="content">

    <a href="<?php echo url_for("/staff/admins/index.php"); ?>" class="back-link">Back to lists</a>

    <div class="admin-show">
        <h1>Admin: <?php echo ht($admin_set['username']); ?></h1>

        <div class="actions">
            <a href="<?php echo url_for("/staff/admins/edit.php?id=" . ht(u($admin['id']))); ?>" class="action">Edit</a>
            <a href="<?php echo url_for("/staff/admins/delete.php?id=" . ht(u($admin['id']))); ?>" class="action">delete</a>

        </div>

        <div class="attributes">
            <dl>
                <dt>First name</dt>
                <dd><?php echo ht($admin_set['first_name']); ?></dd>
            </dl>
            <dl>
                <dt>Last name</dt>
                <dd><?php echo ht($admin_set['last_name']); ?></dd>
            </dl>
            <dl>
                <dt>email</dt>
                <dd><?php echo ht($admin_set['email']); ?></dd>
            </dl>
            <dl>
                <dt>username</dt>
                <dd><?php echo ht($admin_set['username']); ?></dd>
            </dl>
            

        </div>
    </div>
</div>