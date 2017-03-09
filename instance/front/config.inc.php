<?php
# Commit Test
//error_reporting(E_ALL);
$auth_pages = array();
//$auth_pages[] = "main-page";

if ($_REQUEST['logout']) {
    Users::killSession();
    _R(lr('login'));
}
_auth_url($auth_pages, "home");
?>