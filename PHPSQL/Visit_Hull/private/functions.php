<?php
// inputs the script path as a param, if the path dosent start with a '/', it will add it on. then it will add the root and the path together
// so it will be www.WWW_ROOT/$script_path
    function url_for($script_path){
        // adds the leading '/' if not present
// this ensures its always a url to the correct place, fuggin awesome
        if($script_path[0] != '/'){
            $script_path = '/'. $script_path;
        }
        return WWW_ROOT . $script_path;
    }
    // this is the new urlencode function
    function u($string=""){
        return urlencode($string);
    }
    // same story but for html characters, some assholes will wanna fuck with your project. This makes sure < > & and "" will just become string
    function ht($other_string=""){
        return htmlspecialchars($other_string);
    }
    // ERROR FUNCTIONS
    function error_404(){
        // the header function uses the servers protocal as a parameter, just use the superglobal _SERVER to get it, much easier
        header($_SERVER["SERVER_PROTOCOL"]. " 404 not found, thats numberwang!");
        // you could make your own 404 page, but in this case we'll just exit
        exit();
    }
    // so you can check these work using the command line. Bring it back to hard drive, then type: 
    // curl --head then paste the url here
    // for some reason dealing with errors, you cant have any whitespace, this will be shown in new.php
    function error_500(){
    header($_SERVER["SERVER_PROTOCOL"] . " 500 internal server error");
        exit();
    }
    // this just means you dont always have to use the header function for redirects, optional really
    function redirect_to($location){
        header("Location: ". $location);
        exit;
    }
    // this checks if the form has been submitted by checking if the sbmission was a post
    function request_is_post(){
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }
    function request_is_get(){
        return $_SERVER['REQUEST_METHOD'] == 'GET';
}
function display_errors($errors=array())
{
    // basically just doing what var_dumps does but looks nicer
    $output = '';
    if(!empty($errors)){
        // this class we made waaaaay earlier for css
        $output .= "<div class=\"errors\">";
        $output .= "Please fix the following errors:";
        $output .= "<ul>";
        // this is basically just normal html output by php
        foreach($errors as $error) {
            // this displays the errors as a list, it has the escape quotes so it cant be abused when displaying
            $output .= "<li>" . ht($error) . "</li>";
        }
        $output .= "</ul>";
        $output .= "</div>";
    }
    return $output;
}

?>