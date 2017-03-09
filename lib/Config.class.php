<?php

/**
 * Config Class
 * 
 * Class to handle config operations
 * 
 * @author Dave Jay <dave.jay90@gmail.com>
 * @version 1.0
 * @package John Chart
 * 
 */
class Config {

    /**
     * Mechanism to access variable globally
     * @var Array $_vars
     */
    public static $_vars = array();


    # constructor

    public function __construct() {
        
    }

    public static function GetValue($key) {
        return qs("SELECT * FROM config WHERE `key` = '" . $key . "'");
    }

    public static function GetKey() {
        return q("SELECT * FROM config");
    }

    public static function AddValue($key, $val) {
        return q("INSERT INTO config(`key`,`value`,`created_at`,`modified_at`) VALUES('" . $key . "','" . $val . "','" . date('Y-m-d H:i:s') . "','" . date('Y-m-d H:i:s') . "')");
    }

    public static function UpdateValue($key, $val) {
        return q("UPDATE config SET value = '" . $val . "',modified_at = '" . date('Y-m-d H:i:s') . "' WHERE `key` = '" . $key . "'");
    }

    public static function GetEmailValue($key) {
        return q("SELECT * FROM config WHERE `key` = '" . $key . "'");
    }

    public static function AddEmailValue($key, $val) {
        return q("INSERT INTO config(`key`,`value`,`created_at`,`modified_at`) VALUES('" . $key . "','" . $val . "','" . date('Y-m-d H:i:s') . "','" . date('Y-m-d H:i:s') . "')");
    }

    public static function UpdateEmailValue($key, $val) {
        return q("UPDATE config SET value = '" . $val . "',modified_at = '" . date('Y-m-d H:i:s') . "' WHERE `key` = '" . $key . "'");
    }

}

?>