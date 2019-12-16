<?php require_once('../../../private/initialize.php'); ?>

<?php

$pages_set = find_all_pages();
require_login();
?>

<?php $page_title = 'Pages'; ?>

<?php include(SHARED_PATH . "/staff_header.php"); ?>

<div id="content">
    <div class="page-listing">
        <h1>Pages</h1>


        <div class="actions">
            <a href="<?php echo url_for('/staff/pages/new.php') ?>" class="action">Create new page</a>


            <table class="list">
                <tr>
                    <th>ID</th>
                    <th>Position</th>
                    <th>Working?</th>
                    <th>Name</th>
                    <th>ID test</th>
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                </tr>

                <?php
                while ($page = mysqli_fetch_assoc($pages_set)) { ?>

                    <tr>
                        <td><?php echo $page['id']; ?></td>
                        <td><?php echo $page['wagbo']; ?></td>
                        <td><?php echo $page['visible'] == 1 ? "true" : "false"; ?></td>
                        <td><?php echo $page['page_name']; ?></td>
                        <td><a href="<?php echo url_for('/staff/pages/show.php?id=' . $page['id']); ?>" class="action">View</a></td>
                        <td><a href="<?php echo url_for('/staff/pages/edit.php?id=' . $page['id']); ?>" class="action">Edit</a></td>
                        <td><a href="<?php echo url_for('/staff/pages/delete.php?id=' . $page['id']); ?>" class="action">Delete</a></td>
                    </tr>

                <?php  }  ?>
            </table>

        </div>
    </div>
</div>
<?php
db_disconnect($db);

?>