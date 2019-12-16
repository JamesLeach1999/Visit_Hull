<!-- this is where we store functions related to the database -->
<?php

require_once('db_credentials.php');

function db_connect()
{
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    return $connection;
}

function db_disconnect($connection)
{
    // only close the function if actually set
    if (isset($connection)) {
        mysqli_close($connection);
    }
}
function confirm_db_connect()
{
    if (mysqli_connect_errno()) {
        $msg = "Database connection failed: ";
        $msg .= mysqli_connect_error();
        exit($msg);
    }
}
function confirm_result_set($result_set)
{
    if (!$result_set) {
        exit("Databse search failed");
    }
}
// this is just a shorter way of typing the whole mysqli thing, used for stopping injection attacks
function db_escape($connection, $string){
    return mysqli_real_escape_string($connection, $string);
}

?>