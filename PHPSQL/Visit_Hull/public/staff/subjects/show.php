<?php require_once('../../../private/functions.php'); ?>
<?php require_once('../../../private/initialize.php'); ?>

<?php
require_login();

        // all of this code has been put into one function find_subject_by_id(), much cleaner
// $subject_set = find_all_subjects(['visible' => true]);
$subject_set = find_pages_by_subject_id($id);

?>
<br>
</div>
<!-- <div class="subject-show"> -->

    
    <?php include(SHARED_PATH . '/staff_header.php') ?>
    
    
    
    <div class="subjects_listing"></div>
    <h1>subjects</h1>
    
    <div class="actions">
        <a href="<?php echo url_for('/staff/subjects/new.php') ?>" class="action">Create new subject</a>
    </div>
    <a href="show.php?company=<?php echo urlencode('gener&l Kenobi'); ?>">Link</a>
    <a href="<? //php echo redirect_to(url_for('/staff/subjects/index.php')); 
                ?>">Link2</a>
    <div class="actions">
        <a href="<?php echo url_for('/index.php?id=' . ht(u($subject['id'])) . "&preview=true") ?>" class="action">Preview</a>

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
                <td><?php echo $subject['wagbo']; ?></td>
                <!-- looks like you get ternary operators in php, this just breaks the loop -->
                <td><?php echo $subject['visible'] == 1 ? 'true' : 'false'; ?></td>
                <td><?php echo $subject['page_name']; ?></td>
                <!-- right getting spicy now. the php?id= thing you see is basically a param, later it will query a database, for now it will query the above array. So you use the value in the loop to get the corresponding id. $subject['id'] rememeber is just an int from a loop -->
                <td><a href="<?php echo url_for('/staff/subjects/show.php?id=' . ht(u($subject['id']))); ?>" class="action">View</a></td>
                <td><a href="<?php echo url_for('/staff/subjects/edit.php?id=' . ht(u($subject['id']))); ?>" class="action">Edit</a></td>
                <td><a href="<?php echo url_for('/staff/subjects/delete.php?id=' . ht(u($subject['id']))); ?>" class="action">Delete</a></td>
            </tr>
        <?php } ?>


    </table>
</div>
<!-- urlencode vs rawurlencode
in the search bar, youll get a bunch of shit along with the site name like %20 or & which arent actually part of the file name, They have been urlencoded
this is so strings or file names can translate into the search bar, since it has reserved characters
you would use rawurlencode on anything going to the search bar (file name whatever) before the character ?
after the (?), you would use urlencode, the query string
you would usually use urlencode, since youre dealing with dynamic values, the stuff before the query, you have control over it

encode example, this just changes the & and the space to something different-->
<!-- for thebproject, we'll just go into functions and make one for urlencode, since its a bit long to type -->
<!-- NULL COALESCING OPERATOR -->
<!-- you get the ternary operator in php which is awesome, but you can make it even shorter
$page = $_GET['id'] ?? '1';
this means if there is a value, then use it, if not, then do whats on the other side of the if.
generally only used for singular values, because its checking for if the value is null, still fuckin sweet tho-->
<!-- 
 this just gets the id from the index subjects page
 later this will be used for databases, it just passes the id value back and forth
 do this whenever using super globals like _GET and _SET or whatever -->