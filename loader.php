<?php

/**
 * Loader file.
 * Includes libraries
 * Inititaes controller + view
 * 
 * 
 * @author Dave Jay <dave.jay90@gmail.com>
 * @version 1.0
 * @package John Chart
 * 
 */
define("_PATH", str_replace("loader.php", "", __FILE__));

function __autoload($class_name) {
    include_once(_PATH . 'lib/' . $class_name . '.class.php');
}

include "lib/utils.php"; # includes general function
include "lib/utils_checklist.php";
_getInstance($_REQUEST['q']);
$instance = _cg("instance");

$host = $_SERVER['HTTP_HOST'];

//$http_protocol = $_SERVER['HTTPS'] == "on" ? "https://" : "http://";
$http_protocol = "//";
define('_UPlain', $http_protocol . $host . substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/') + 1));
if (_cg("url_instance") != '') {
    define('_U', $http_protocol. $host . substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/') + 1) . _cg("url_instance") . "/");
} else {
    define('_U', $http_protocol. $host . substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/') + 1));
}
define("_MEDIA_URL", _UPlain . "instance/{$instance}/media/");

$db = Db::__d();

include _PATH . "instance/{$instance}/config.inc.php";

$url = _cg("url"); // set from _getInstance function
define(_URL, $url);

if(isset($_SESSION['DEFAULT_TIMEZONE'])){
    date_default_timezone_set($_SESSION['DEFAULT_TIMEZONE']);
}
else{ //else if(isset($_SESSION['current_user'])){ $timezone = $_SESSION['current_user']->timezone; date_default_timezone_set($timezone); }
    date_default_timezone_set(CLIENT_TIMEZONE_UI);
}

$modulePage = $url . ".php";
@include _PATH . "instance/{$instance}/controller/{$url}.inc.php";

include _PATH . "instance/{$instance}/tpl/index.tpl.php";
?>