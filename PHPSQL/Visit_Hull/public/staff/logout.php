<?php
require_once('../../private/initialize.php');
// this just removes or unsets whatever the username was set to in the session superglobal
logout_admin();
redirect_to(url_for('/staff/login.php'));

?>