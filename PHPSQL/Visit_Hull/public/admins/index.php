<?php
require_once("../../private/initialize.php");
require_login();
$admin_set = find_all_admins();

?>

<?php $page_title = "admins"; ?>
<?php include(SHARED_PATH . "/staff_header.php"); ?>

<div id="content">
    <div class="admins-listing">
        <h1>Admins</h1>

        <div class="actions">
            <a href="<?php echo url_for("/admins/new.php"); ?>" class="action">Create new admin</a>
        </div>
        <table class="list">
            <tr>
                <th>ID</th>
                <th>First</th>
                <th>Last</th>
                <th>Email</th>
                <th>Username</th>
                <th>Password</th>
            </tr>
            <tr>
            <?php while($admin = mysqli_fetch_assoc($admin_set)) {?>
                <td><?php echo ht($admin['id']); ?></td>
                <td><?php echo ht($admin['first_name']); ?></td>
                <td><?php echo ht($admin['last_name']); ?></td>
                <td><?php echo ht($admin['email']); ?></td>
                <td><?php echo ht($admin['username']); ?></td>
                <td><a href="<?php echo url_for("/admins/show.php?id=" . ht(u($admin['id'])))?>" class="action">View</a></td>
                <td><a href="<?php echo url_for("/admins/edit.php?id=" . ht(u($admin['id'])))?>" class="action">Edit</a></td>
                <td><a href="<?php echo url_for("/admins/delete.php?id=" . ht(u($admin['id'])))?>" class="action">Delete</a></td>
                </tr>
            <?php } ?>
        </table>
        <?php
        
        mysqli_free_result($admin_set);
        ?>
    </div>
</div>