<?php
// this is incase the variable from index dosent load
if (!isset($page_title)) {
    $page_title = 'Staff area';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- here we use the function from functions.php -->
    <link rel="stylesheet" media="all" href="<?php echo url_for('/styles/staff.css'); ?>" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>VH <?php echo $page_title ?></title>
</head>

<body>
    <header>
        <h1>VH staff area</h1>
    </header>
    <nav>
        <ul>
            <!-- get the username string from session and display it here -->
            <li>User: <?php echo $_SESSION['username'] ?? ''; ?></li>
            <li><a href="<?php echo url_for('/staff/index.php'); ?>">Menu</a></li>
            <li><a href="<?php echo url_for('/staff/logout.php'); ?>">logout</a></li>
            <li><a href="<?php echo url_for('/admins/index.php'); ?>">Admins</a></li>
        </ul>
    </nav>

    <div id="content">
        <div id="main-menu">
            <h2>main menu</h2>
            <ul>
                <li>
                    <a href="<?php echo url_for('/staff/subjects/index.php'); ?>">Subjects</a>
                </li>
                <li>
                    <a href="<?php echo url_for('/staff/pages/index.php'); ?>">Pages</a>
                </li>
            </ul>
            <!-- NULL COALESCING OPERATOR -->
            <!-- you get the ternary operator in php which is awesome, but you can make it even shorter
$page = $_GET['page'] ?? '1';
this means if there is a value, then use it, if not, then do whats on the other side of the if.
generally only used for singular values, because its checking for if the value is null, still fuckin sweet tho
-->