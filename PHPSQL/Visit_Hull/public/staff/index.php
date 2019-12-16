<?php require_once('../../private/initialize.php'); ?>
<!--  this variable is available in staff_header -->

<?php require_login();?>
<?php $page_title = 'Staff menu'; ?>

<?php include(SHARED_PATH . '/staff_header.php') ?>


<div id="content">
    <div id="main-menu">

    </div>


</div>


<!-- using the 2 dots means go back a directory -->
<!-- include means use this  file, require will raise and error if not there -->
<?php include(SHARED_PATH . '/staff_footer.php'); ?>