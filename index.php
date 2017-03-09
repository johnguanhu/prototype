<?php

/**
 * Main Index File...
 * 
 * App is single point entry
 * 
 * Assigns constant vars
 * 
 * 
 * @author Dave Jay <dave.jay90@gmail.com>
 * @version 1.0
 * @package John Chart
 * 
 */
session_start();
error_reporting(0);

# DB informaitons
define('DB_HOST', 'localhost');
define('DB_PASSWORD', '');
define('DB_UNAME', 'root');
define('DB_NAME', 'little_fish_audio');

include "loader.php";



?>
