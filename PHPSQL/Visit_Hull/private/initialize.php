<?php
// this just lets us know output buffering is turned on
ob_start();
// this starts the session whenever you load a page
session_start();
// assign file paths to php constants
// __FILE__ returns the current path to this file
// dirname()returns the path to the parents directory
// so this is assingning initialize.php to private path

define("PRIVATE_PATH", dirname(__FILE__));

// this assigns private path to Visit_hull
define("PROJECT_PATH", dirname(PRIVATE_PATH));

// this basically says Visit_Hull/Public, cos its concatenating Visit hull and public

define("PUBLIC_PATH", PROJECT_PATH. '/public');

// this does the same but adds shared onto the end

define("SHARED_PATH", PRIVATE_PATH. '/shared');

// just using the same old constant function
// this is just way cleaner then using the dots
// this first line finds the position of /public in the scripts full file tag and puts it in public_end
// it finds everything in the url up to public, this is for making a www site not a localhost one
$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public')+7;
// this starts at the start of the file name and ends when the public tag ends, then stores it in doc_root 
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define("WWW_ROOT", $doc_root);


require_once('functions.php');
require_once('database.php');
require_once('query_functions.php');
require_once('validate_functions.php');

$db = db_connect();
$errors = [];
?>
