<?php
require_once("../../../private/initialize.php");
require_login();


$page = [];
if (request_is_post()) {
    
    //  this handles form values sent by new.php
    $page = [];
    $page['page_name'] = $_POST['page_name'] ?? "";
    $page['wagbo'] = $_POST['wagbo'] ?? "";
    $page['visible'] = $_POST['visible'] ?? "";
    // putting it into an array just makes it a bit more compact
    $result = insert_page($page);
    $new_id = mysqli_insert_id($db);
    redirect_to(url_for('/staff/pages/show.php?id=' . $new_id . ""));
} else {
    $page = [];
    $page['page_id'] = '';
    $page['page_name'] = '';
    $page['wagbo'] = '';
    $page['visible'] = '';
    $page_set = find_all_pages();
    $page_count = mysqli_num_rows($page_set) + 1;
    mysqli_free_result($page_set);
    $page['wagbo'] = $page_count;
    
    
}
?>

<?php $page_title = 'Create page'; ?>
<?php include(SHARED_PATH . "/staff_header.php"); ?>

<div id="content">

    <a href="<?php echo url_for('/staff/pages/index.php'); ?>" class="back-link">Back to lists</a>

    <div class="page-new">
        <h1>create page</h1>
        
        <form action="<?php echo url_for('/staff/pages/new.php'); ?>" method="post">
            <dl>
                <dt>Menu name</dt>
                <dd><input type="text" name="page_name" value=""></dd>
            </dl>
            <dl>
                <dt>Position</dt>
                <dd>
                    <select name="position">
                        <option value="1" <?php
                                            for ($i = 1; $i <= $page_count; $i++) {
                                                echo "<option value=\"{$i}\"";
                                                if ($page['wagbo'] == $i) {
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
