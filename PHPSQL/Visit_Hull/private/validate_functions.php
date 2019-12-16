<?php

// uses string as arguement
// validates data presence, uses trim() so empty spaces dont count, uses === to avoid false positives
// better than empty() which considers a 0 to be empty
function is_blank($value)
{
    // just saying if blank or the trimmed value is an empty string, return the value
    // this just returns true or false
    return !isset($value) || trim($value) === '';
}
// uses string as arg, bascially the opposite of is_blank()
// checks if is_blank() is false
function has_presence($value)
{
    return !is_blank($value);
}
// has_length_greater_than('abcd', 3)
// validate string length
// spaces count towards length
// use trim() if spaces shouldnt count
function has_length_greater_than($value, $min)
{
    $length = strlen($value);
    // again, just a boolean, returns true if the length is longer and false or nothing if not
    return $length > $min;
}
function has_length_less_than($value, $max)
{
    $length = strlen($value);
    return $length < $max;
}
function has_length_exactly($value, $exact)
{
    $length = strlen($value);
    return $length == $exact;
}
// this just deals with all 3 operations in one function
function has_length($value, $option)
{
    // if the option is an array, so can do 'min' => 3, or 'max' => 4. this returns false if the value is less then the minimum you set in the array
    if(isset($option['min']) && !has_length_greater_than($value, $option['min'] - 1)){
        return false;
    }
    // this does the same but with max. the plus one if because arrays start at 0. so if 'max' => 6, if max is set and if length greater than is not true, it returns false
    if (isset($option['max']) && !has_length_greater_than($value, $option['max'] + 1)) {
        return false;
    }
    if (isset($option['exact']) && !has_length_greater_than($value, $option['exact'])) {
        return false;
    } else {
        return true;
    }
    // this is fcking confusing, come back to it later
}

// has_inclusion_of(5, [1, 3, 5, 7])
// validate inclusion in a set
// if the $value is in the $set array, return true
function has_inclusion_of($value, $set)
{
    return in_array($value, $set);
}

function has_exclusion_of($value, $set)
{
    return !in_array($value, $set);
}
// has_string("something something", "thing")
// returns the string start position or false,
// !== prevents position 0 being considered false, so if the required value is at the beginning
function has_string($value, $required_string)
{
    return strpos($value, $required_string) !== false;
}
// validates the correct format for emails, using regex *shudders*
// format: [chars]@[chars].[2+ letters]
// use preg_match for this, built in php function, returns true if match found and false if not
function has_valid_email($value)
{
    $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
    // returns 1 if true 0 if false
    return preg_match($email_regex, $value) === 1;
}
// validates uniqueness of admins.username
// for existing records, provide current id as second arguement
function has_unique_username($username, $current_id = "0"){
    global $db;
    $sql = "SELECT * FROM admins ";
    $sql .= "WHERE username='" . $username . "' ";
    $sql .= "AND id != '" . $current_id . "'";
    $result = mysqli_query($db, $sql);
    $admin_count = mysqli_num_rows($result);
    mysqli_free_result($result);
    return $admin_count === 0;

}