<?php

require_once("../private/initialize.php");
// checks to see if there is an id set, if true, the variable $page is the returned assoc array from the function, so it is just the pages id, if page isnt set, then redirect

$page_id = $_GET['id'] ?? '';

if (isset($_GET['id'])) {
    $page_id = $_GET['id'];
    $page = find_page_by_id($page_id, ['visible' => true]);
    if (!$page) {
        redirect_to(url_for('index.php'));
    }
}

include(SHARED_PATH . '/public_header.php');

?>
<?php
include(SHARED_PATH . '/public_navigation.php');
?>
<div id="main">

    <div id="page">
        <?php
        if (isset($page)) {

            echo ht($page['wagbo']);
        }
        ?>


    </div>
</div>
<?php include(SHARED_PATH . '/public_footer.php'); ?>