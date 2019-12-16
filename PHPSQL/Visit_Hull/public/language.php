<?php

require_once("../private/initialize.php");
// checks to see if there is an id set, if true, the variable $page is the returned assoc array from the function, so it is just the pages id, if page isnt set, then redirect

$page_id = $_GET['id'] ?? '';
// cookies are just arrays with key:value pairs which you can access with the cookie superglobal
if(request_is_post()){
    // form was submitted
    $language = $_POST['language'] ?? "Any";
    $expire = time() + 60*60*24*365;
    // setcookie takes the name of the value in the cookie key:value dictionary as first param, the value as the second and expiration as the third. there are some other values you can set to but these are the most basic
    setcookie("language", $language, $expire);
} else {
    // read the stored value if any
    $language = $_COOKIE['language'] ?? "None";
}

include(SHARED_PATH . '/public_header.php');

?>
<?php
include(SHARED_PATH . '/public_navigation.php');
?>
<div id="main">

    <div id="page">
        <p>the currently selected language is:
        <?php
            echo $language;
        ?>
        </p>
        <div name="language">
            <form action="language.php" method="post">
                <select name="language" id="language">
                    <?php
                        $language_choices = ['Any', 'English', 'Spanish', 'French'];
                        foreach($language_choices as $language_choice){
                            echo "<option value=\"{$language_choice}\"";
                            if($language == $language_choice){
                                echo "selected";
                            }
                            echo ">{$language_choice}</options>";
                        }
                    ?>
                    <input type="submit">
                </select>
            </form>
        </div>



    </div>
</div>
<?php include(SHARED_PATH . '/public_footer.php'); ?>