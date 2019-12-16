<?php require_once('../../../private/initialize.php'); ?>

<?php
require_login();
// this isall done in query_functions.php
// $sql = 'SELECT * FROM subjects ';
// // this is concatenating to the first part of the query, and saying by ascending order
// $sql .= 'ORDER BY position ASC';
// // just passes through the connection and query
// $subject_set = mysqli_query($db, $sql);
$subject_set = find_all_subjects(['visible' => true]);

var_dump($subject_set);
// this is just a bog standard 2 d array, with the key value pairs, seperated by commas, just like any other language
// dont need this for the moment as we're using the database
// $subjects = [
//     ['id' => '1', 'position' => '1', 'visible' => '1', 'menu_name' => 'About Hull'],
//     ['id' => '2', 'position' => '2', 'visible' => '1', 'menu_name' => 'Consumer'],
//     ['id' => '3', 'position' => '3', 'visible' => '1', 'menu_name' => 'Business'],
//     ['id' => '4', 'position' => '4', 'visible' => '1', 'menu_name' => 'Commercial'],
// ];
// just testing to see if it works, outputs consumer
// this is just a dummy database pretty much
// echo $subjects[1]['menu_name'];

?>


<?php $page_title = 'Subjects'; ?>

<?php include(SHARED_PATH . '/staff_header.php') ?>



<div class="subjects_listing"></div>
<h1>subjects</h1>

<div class="actions">
    <a href="<?php echo url_for('/staff/subjects/new.php') ?>" class="action">Create new subject</a>
</div>

<table class="list">
    <tr>
        <th>ID</th>
        <th>Poisition</th>
        <th>Visible</th>
        <th>Name</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
    </tr>

    <?php
    while ($subject = mysqli_fetch_assoc($subject_set)) { ?>

        <tr>
            <td><?php echo $subject['id']; ?></td>
            <td><?php echo $subject['position']; ?></td>
            <!-- looks like you get ternary operators in php, this just breaks the loop -->
            <td><?php echo $subject['visible'] == 1 ? 'true' : 'false'; ?></td>
            <td><?php echo $subject['menu_name']; ?></td>
            <!-- right getting spicy now. the php?id= thing you see is basically a param, later it will query a database, for now it will query the above array. So you use the value in the loop to get the corresponding id. $subject['id'] rememeber is just an int from a loop -->
            <td><a href="<?php echo url_for('/staff/subjects/show.php?id=' . ht(u($subject['id']))); ?>" class="action">View</a></td>
            <td><a href="<?php echo url_for('/staff/subjects/edit.php?id=' . ht(u($subject['id']))); ?>" class="action">Edit</a></td>
            <td><a href="<?php echo url_for('/staff/subjects/delete.php?id=' . ht(u($subject['id']))); ?>" class="action">Delete</a></td>
        </tr>
    <?php } ?>


</table>
</div>
</div>
<?php
// this is for memory managment
mysqli_free_result($subject_set);
?>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>