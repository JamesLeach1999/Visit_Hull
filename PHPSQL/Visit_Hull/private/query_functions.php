<?php

require_once("/XAMPP1/htdocs/R2FS/Lynda/PHPSQL/Visit_Hull/private/initialize.php");
require_once("auth_functions.php");
global $db;
echo $db;
function find_all_subjects($options=[])
{
    // this is just a function to handle this particular search function, calling in global db to extend its scope
    global $db;

    $visible = $options['visible'] ?? false;

    $sql = 'SELECT * FROM subjects ';
    // if visible is true, add this to the query
    if($visible){
        $sql .= "WHERE visible = true ";
    }

    $sql .= 'ORDER BY position ASC';
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_subject_by_id($id, $options=[])
{
    global $db;
    // $sql is 2 lines just concatenating with the .=
    $visible = $options['visible'] ?? false;
    $sql = "SELECT * FROM subjects ";
    // the reason for the weird quotes is to prevent injection attacks
    // so is the db_escape() function, explained in database.php
    $sql .= "WHERE id='" . db_escape($db, $id) . "'";
    if($visible){
        $sql .= " AND visible = true";
    }
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject; //returns an assoc array
}
function validate_subject($subject)
{
    // just makes an array full of error messages
    $errors = [];

    // for menu name
    if (is_blank($subject['menu_name'])) {
        $errors[] = "Name cannot be blank";
        // just using the functions from validate functions, this one needed the array for a param
    } elseif (!has_length($subject['menu_name'], ['min' => 2, 'max' => 255])) {
        $errors[] = "Name must be between 2 and 255 characters";
    }


    // make sure we are working with an int
    // this is type casting to turn it into an integer, by default its a string
    $position_int = (int) $subject['position'];
    if ($position_int <= 0) {
        $errors[] = "position must be greater than 0";
    }
    if ($position_int > 999) {
        $errors[] = "position must be less than 999";
    }
    // this typecasts visible to be a string, and if it dosent include 0 or 1, true or false, it will raise an error
    $visible_str = (string) $subject['visible'];
    if (!has_inclusion_of($visible_str, ["0", "1"])) {
        $errors[] = "Visible must be true or false";
    }
    // then dumps the array back to you
    return $errors;
}
function insert_subject($subject)
{
    global $db;
    // just another bog standard fairly easy sql statement
    $errors = validate_subject($subject);
    if (empty($errors)) {
        return $errors;
    }
    $sql =  "INSERT INTO subjects ";
    $sql .= "(menu_name, position, visible) ";
    $sql .= "VALUES (";
    // again quotes for sql attacks
    // the commas are for the sql statement, if youre ever having trouble just echo the sql statement
    $sql .= "'" . db_escape($db, $subject['menu_name']) . "',";
    $sql .= "'" . db_escape($db, $subject['position']) . "',";
    $sql .= "'" . db_escape($db, $subject['visible']) . "')";
    $result = mysqli_query($db, $sql);
    // for insert statements, the result is true/false, but it will still send the data
    if ($result) {
        return true;
        // this all looks a bit fucked but the functions are helping you out alot
    } else {
        // mysqli_error just asks for what the error was from the data base, just general errors
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}
function update_subject($subject)
{
    global $db;
    // this makes an array of errors if there are any
    $errors = validate_subject($subject);
    if (!empty($errors)) {
        // this is so it returns back only erros, dosent run the rest of the code if theres a problem
        return $errors;
    }
    // this is just gathering the vallue in a single array instead of variables
    $sql = "UPDATE subjects SET ";
    $sql .= "menu_name='" . $subject['menu_name'] . "', ";
    $sql .= "position='" . $subject['position'] . "', ";
    $sql .= "visible='" . $subject['visible'] . "' ";
    $sql .= "WHERE id='" . $subject['id'] . "' ";
    // this limit bit is so we only target one row from the database
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    // for update statements, the result is true/false
    if ($result) {
        return true;
    } else {
        // update failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}
function delete_subject($id)
{
    global $db;
    $sql = "DELETE FROM subjects ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);

    // for delete statements the result is true/false

    if ($result) {
        return true;
    } else {
        // delete failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}
function find_all_pages()
{
    global $db;
    $sql = 'SELECT * FROM pages ';
    $sql .= 'ORDER BY wagbo ASC';
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}
function delete_page($id)
{
    global $db;
    $sql = "DELETE FROM pages ";
    $sql .= "WHERE id='" . $id . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);

    // for delete statements the result is true/false

    if ($result) {
        return true;
    } else {
        // delete failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}
function update_page($page)
{
    global $db;
    // this is just gathering the vallue in a single array instead of variables
    $sql = "UPDATE pages SET ";
    $sql .= "page_name='" . $page['page_name'] . "', ";
    $sql .= "wagbo='" . $page['wagbo'] . "', ";
    $sql .= "visible='" . $page['visible'] . "' ";
    $sql .= "WHERE id='" . $page['id'] . "' ";
    // this limit bit is so we only target one row from the database
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    // for update statements, the result is true/false
    if ($result) {
        return true;
    } else {
        // update failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}
function insert_page($page)
{
    global $db;
    // just another bog standard fairly easy sql statement
    $sql =  "INSERT INTO pages ";
    $sql .= "(page_name, wagbo, visible) ";
    $sql .= "VALUES (";
    // again quotes for sql attacks
    // the commas are for the sql statement, if youre ever having trouble just echo the sql statement
    $sql .= "'" . $page['page_name'] . "',";
    $sql .= "'" . $page['wagbo'] . "',";
    $sql .= "'" . $page['visible'] . "')";
    $result = mysqli_query($db, $sql);
    // for insert statements, the result is true/false, but it will still send the data
    if ($result) {
        return true;
        // this all looks a bit weird but the functions are helping you out alot
    } else {
        // mysqli_error just asks for what the error was from the data base, just general errors
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}
function find_page_by_id($id, $options=[])
{
    global $db;
    // $sql is 2 lines just concatenating with the .=
    $visible = $options['visible'] ?? false;


    $sql = "SELECT * FROM pages ";
    // the reason for the weird quotes is to prevent injection attacks
    $sql .= "WHERE id='" . $id . "'";
    if($visible){
        $sql .= " AND visible = true";
    }
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    // in an array it looks like ['$result', 'id'. $page contains that fetched id
    $page = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $page; //returns an assoc array
}
function find_pages_by_subject_id($subject_id, $options=[])
{
    global $db;

    // if there is no value for the visible key in the array, set it to false
    $visible = $options['visible'] ?? false;

    $sql = "SELECT * FROM pages ";
    $sql .= "WHERE subject_id='" . $subject_id . "' ";
    if($visible){
        $sql .= "AND visible = true ";

    }


    $sql .= "ORDER BY wagbo ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_all_admins() {

    global $db;

    $sql = "SELECT * FROM admins ";
    $sql .= "ORDER BY last_name ASC, first_name ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;

}

function find_admin_by_id($id){

    global $db;
    $sql = "SELECT * FROM admins ";
    $sql .= "WHERE id='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $admin = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $admin;

}
function validate_admin($admin, $options=[]){

    $password_required = $options['password_required'] ?? true;

    if(is_blank($admin['first_name'])){
        $errors[] = "First name cannot be blank";
    } elseif (!has_length($admin['first_name'], array("min" => 2, "max" => 255))){
        $errors[] = "First name must be between 2 and 255 chars";
    }
    if (is_blank($admin['last_name'])) {
        $errors[] = "last name cannot be blank";
    } elseif (!has_length($admin['last_name'], array("min" => 2, "max" => 255))) {
        $errors[] = "last name must be between 2 and 255 chars";
    }
    if (is_blank($admin['email'])) {
        $errors[] = "email cannot be blank";
    } elseif (!has_length($admin['email'], array("min" => 2, "max" => 255))) {
        $errors[] = "email must be between 2 and 255 chars";
    } elseif (!has_valid_email($admin['email'])){
        $errors[] = "email must be valid format";
    }
    if (is_blank($admin['username'])) {
        $errors[] = 'username cannot be blank';
    } elseif (!has_length($admin['username'], array("min" => 2, "max" => 255))) {
        $errors[] = 'username must be between 2 and 255 chars';
    } elseif (!has_unique_username($admin['username'], $admin['id'] ?? 0)){
        $errors[] = "Username not allowed";
    }

    if($password_required){

    if (is_blank($admin['password'])) {
        $errors[] = 'password cannot be blank';
    }
}
}

function insert_admin($admin){
    global $db;

    $errors = validate_admin($admin);
    if(!empty($errors)){
        return $errors;
    }
    $hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO admins ";
    $sql .= "(first_name, last_name, email, username, hashed_password)";
    $sql .= " VALUES (";
    $sql .= "'" . $admin['first_name'] . "',";
    $sql .= "'" . $admin['last_name'] . "',";
    $sql .= "'" . $admin['email'] . "',";
    $sql .= "'" . $admin['username'] . "',";
    $sql .= "'" . $hashed_password . "'";
    $sql .= ")";
    // if($db === true){
    
    // 
    // echo $sql;
    $result = mysqli_query($db, $sql);
    if($result){
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
    }
}

function update_admin($admin)
{
    global $db;

    $password_sent = !is_blank($admin['password']);

    $errors = validate_admin($admin, ['password_required' => $password_sent]);
    if (!empty($errors)) {
        return $errors;
    }
    $hashed_password = password_hash($admin['password'], PASSWORD_BCRYPT);
    $sql = "UPDATE admins SET ";
    $sql .= "first_name='" . $admin['first_name'] . "',";
    $sql .= "last_name'" . $admin['last_name'] . "',";
    $sql .= "email='" . $admin['email'] . "',";
    if($password_sent){
    $sql .= "hashed_password='" . $hashed_password . "',";
    }
    $sql .= "username='" . $admin['username'] . "',";

    $sql .= "WHERE id='" . $admin['id'] . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    if($result){
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

function delete_admin($admin){
    global $db;

    $sql = "DELETE FROM admins ";
    $sql .= "WHERE id='" . $admin['id'] . "',";
    $sql .= "LIMIT 1";
    
    $result = mysqli_query($db, $sql);

    if ($result) {
        return true;
    } else {
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}
function find_admin_by_username($username)
{
    global $db;
    $sql = "SELECT * FROM admins ";
    $sql .= "WHERE username='" . $username . "' ";
    $sql .= "LIMIT 1";
    // echo $sql;
    $result = mysqli_query($db, $sql);
    // blaze it
    confirm_result_set($result);
    $admin = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $admin;
}
