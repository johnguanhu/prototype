<?php

/**
 * General Functions
 * 
 * 
 * @author Dave Jay <dave.jay90@gmail.com>
 * @version 1.0
 * @package Brilliant
 * 
 */

/**
 * Function to check whether variable is set or not.
 * @param String $var
 * @return Boolean
 * 
 * @author Dave Jay <dave.jay90@gmail.com>
 * @version 1.0
 * @package Brilliant
 * 
 */
function _set($var) {
    return isset($var) && $var ? true : false;
}

/**
 * Checks if variable is set or not. if
 * variable is not set, it will reutnr second arc
 * @param String $var
 * @param String $var
 * @return String $var
 * 
 * @author Dave Jay <dave.jay90@gmail.com>
 * @version 1.0
 * @package Brilliant
 * 
 */
function _e(&$s, $a = null) {
    return !empty($s) ? $s : $a;
}

/**
 * function to escape string
 * 
 * @param String $string
 * @return String escaped string
 * @author Dave Jay <dave.jay90@gmail.com>
 * @version 1.0
 * @package Brilliant
 */
function _escape($string) {
    $string = stripslashes($string);
    return mysql_real_escape_string(trim($string));
}

/**
 * Wrapper function for db insert query
 * 
 * @author Dave Jay <dave.jay90@gmail.com>
 * @version 1.0
 * @package Brilliant
 */
function qi($table, $fields, $operation = 'INSERT') {
    $db = Db::__d();
    return $db->insert_query($table, $fields, $operation);
}

function mqi($table, $fields, $operation = 'INSERT') {
    $dbase = Dbase::__d();   
    return $dbase->$table->save($fields);
}

function qd($table, $condition) {
    $db = Db::__d();
    return $db->delete_query($table, $condition);
}

function mqd($table, $condition) {
    $dbase = Dbase::__d();
    return $dbase->$table->remove($condition);
}

function q($query) {
    $db = Db::__d();
    return $db->format_data($db->query($query));
}

function qs($query) {
    $result = q($query);
    return $result[0];
}

/**
 * Wrapper function for db update query
 * 
 * @author Dave Jay <dave.jay90@gmail.com>
 * @version 1.0
 * @package Brilliant
 */
function qu($table, $fields, $condition) {
    $db = Db::__d();
    return $db->update_query($table, $fields, $condition);
}

/**
 * Return date format that mysql likes YYYY-MM-DD H:I:S
 * 
 * @param String $timestamp optional unixtimestamp
 * @return String $date
 * 
 * @author Dave Jay <dave.jay90@gmail.com>
 * @version 1.0
 * @package Brilliant
 */
function _mysqlDate($timestamp = 0) {
    $timestamp = $timestamp ? $timestamp : time();
    return date('Y-m-d H:i:s');
}

function _getInstance($url) {
    $arg = explode("/", $url);
    switch ($arg[0]) {
        case 'admin':
            _cg('url', _e($arg[1], "home"));
            _cg("url_instance", $arg[0]);
            _cg("instance", "admin");
            break;
        default:
            if ($arg[0] != '') {
                $url_d = $arg[0];
            } else {
                $url_d = 'home';
            }
            _cg('url', $url_d);
            _cg("url_instance", '');
            _cg("instance", "front");

            if ($arg[1]) {
                array_shift($arg);
                _cg("url_vars", $arg);
            }
    }
}

/**
 *  Wrapper function for application level
 *  global variable
 * 
 *  set/get key/value
 * 
 *  @param String $key key
 *  @param $value value
 * 
 *  @return Array 
 * 
 */
function _cg($key, $value = null) {

    if (is_null($value)) {
        return Config::$_vars[$key];
    } else {
        Config::$_vars[$key] = $value;
    }
}

/**
 *  Wrapper function for application level
 *  global variable
 * 
 *  set/get key/value
 * 
 *  @param String $key key
 *  @param $value value
 * 
 *  @return Array 
 * 
 */
function _cgd($key, $value = null) {

    if (is_null($value)) {

        return Config::$_vars[$key];
    } else {
        Config::$_vars[$key] = $value;
    }
}

function lr($url) {
    return _U . $url;
}

function l($url) {
    print lr($url);
}

function d($arr, $hideStyle = "block") {
    if (is_array($arr) || is_object($arr)) {
        print "<pre style='display:{$hideStyle}'>" . "...";
        print_r($arr);
        print "</pre>";
    } else {
        print "<div class='debug' style='display:{$hideStyle}'>Debug:<br>$arr</div>";
    }
}

function _R($url) {
    header("Location:{$url}");
    exit;
}

function _auth_url($pages, $return_page) {
    if (!$_SESSION['user'] && in_array(_cg("url"), $pages)) {
        _cg("url", $return_page);
    }
}

function _level_auth_url($pages, $return_page) {

    if (!in_array(_cg("url"), $pages)) {
        _cg("url", $return_page);
    }
}

function back_trace() {
    $array = debug_backtrace();
    $output = 'Execution Backtrace:<br><ul>';
    foreach ($array as $debug_data) {
        $output .= "<li><b> " . $debug_data['file'] . "</b> [ Line : <b>" . $debug_data['line'] . "</b> ] <br></li>";
    }
    $output .= '</ul>';
    d($output);
}

function random_string() {
    return date("ymd") . mt_rand(1, 1000) . mt_rand(99, 99999);
}

function _escapeArray($array) {
    $array = array_map('mysql_real_escape_string', $array);
    return array_map('trim', $array);
}

function _bindArray($array, $map) {
    $return = array();
    foreach ($map as $form_field => $db_field) {
        $return[$db_field] = $array[$form_field];
    }
    return $return;
}

function _normalDate($date) {
    return date("d-M-Y H:i a", strtotime($date));
}

function json_die($status = true, $array = array()) {
    $response = array();
    $response['status'] = $status;
    $response['data'] = $array;
    die(json_encode($response));
}

function _errors_on() {
    ini_set("display_errors", "on");
    error_reporting(E_ALL);
}

function _errors_off() {
    ini_set("display_errors", "off");
    error_reporting(0);
}

function clearNumber($number) {
    return str_replace(array("-", "(", ")", " "), array("", "", "", ""), $number);
}


function getCurrentCaliforniaFormatted($format = "H:i") {
    $time = getCurrentCaliforniaTime();
    return $time->format($format);
}

function getCurrentCaliforniaTime() {
    return getTimeZoneTime('America/Los_Angeles');
}

function getCurrentNewYorkTimeFormatted($format = "H:i") {
    $time = getCurrentNewYorkTime();
    return $time->format($format);
}

function getCurrentNewYorkTime() {
    return getTimeZoneTime('America/New_York');
}

function getTimeZoneTime($timeZone,$time='') {
    $current_time = new Datetime($time);
    $ny_time = new DateTimeZone($timeZone);
    $current_time->setTimezone($ny_time);

    $current_time = new DateTime($current_time->format("Y-m-d H:i:s"));
    return $current_time;
}


/**
 * Conditional Print
 */
function _cprint($key, $value, $print, $doPrint = true) {

    if ($key == $value) {
        if ($doPrint) {
            print $print;
        } else {
            return $print;
        }
    }
}

function _renderOptions($options, $selected_value) {
    foreach ($options as $optionValue => $label) {
        $selected = _cprint($optionValue, $selected_value, 'selected', false);
        print "<option value='{$optionValue}' {$selected}>{$label}</option> ";
    }
}

/**
 * Get/Set Config table preferences value
 */
function _pref($key, $value = '') {
    if ($value == '') {
        $value = Config::GetValue($key);
        $value = $value['value'];
    } else {
        Config::UpdateValue($key, $value);
    }
    return $value;
}


function formatCell($data) {
    if (preg_match('/^\+\d(\d{3})(\d{3})(\d{4})$/', $data, $matches)) {
        $result = $matches[1] . '-' . $matches[2] . '-' . $matches[3];
        return $result;
    } else {
        return $data;
    }
}
function formatCellDash($data) {
    $data = clearNumber($data);
    
    return $data ? "(".substr($data,0,3) . ") " . substr($data,3,3) . "-" . substr($data,6) : "--";
}


function isDriver() {
    return $_SESSION['user']['user_type'] == "level_1" ? true : false;
}

function isAdmin() {
    return $_SESSION['user']['user_type'] == "admin" ? true : false;
}

function resolveTPL() {
    $tpl = "";
    switch ($_SESSION['user']['user_type']) {
        case "level_1":
            $tpl = "index_driver.tpl.php";
            break;

        default:
            $tpl = "index.tpl.php";
            break;
    }
    return $tpl;
}


/**
 * Custom Mail function.
 *    
 * Uses swift mail library and sends mail
 * 
 * @param type $to
 * @param type $subject
 * @param type $content
 * @param type $extra
 * 
 * @author  Dave Jay <dave.jay90@gmail.com>
 * @since November 28, 2013
 */
function _mail($to, $subject, $content, $extra = array()) {

    # unfortunately, need to use require within function.
    # swift lib overrides the autoloader 
    # and that stops native app classes being resolved and included

    require_once _PATH . 'lib/mail/swift/lib/swift_required.php';

    //if (_isLocalMachine()) {
        //_l("To Email is overwritten by -  temp@go-brilliant.com  due to dev localmachine ");
    //    $to = 'testoperators@gmail.com';
    //}

    $transport = Swift_SmtpTransport::newInstance(SMTP_HOST, SMTP_PORT, SMTP_SECURITY)
            ->setUsername(SMTP_EMAIL_USER_NAME)
            ->setPassword(SMTP_EMAIL_USER_PASSWORD);

    $mailer = Swift_Mailer::newInstance($transport);

    if (!is_array($to)) {
        $to = array($to);
    }

    $message = Swift_Message::newInstance($subject)
            ->setFrom(array(MAIL_FROM_EMAIL => MAIL_FROM_NAME))
            ->setTo($to)
            ->setBcc('testoperators@gmail.com')
            //->setBcc('dave.jay90@gmail.com')
            ->setBody($content, 'text/html', 'iso-8859-2');

    $result = $mailer->send($message);

    return $result;
}

/**
 * Function to Log the errors in well formatted manner
 * 
 * @param type $string
 */
function _l($string) {
    print "<br />\r\n";
    d($string);
    print "<br />\r\n";
}

/**
 * Function print Log
 * 
 * @param String $string
 */
function _ls($string) {
    print "<div style='padding:8px;background-color:#FFFFCC;font-family:verdana;border:1px solid #DADADA;border-radius:5px;margin:4px;font-size:12px;font-weight:bold'>";
    print $string;
    print "</div>";
}

/**
 * Whether its a local machine or host
 */
function _isLocalMachine() {
    return IS_DEV_ENV; //$_SERVER['HTTP_HOST'] == 'localhost' ? true : false;
}


/**
 * 
 * convert 2 dimensional array into single dimension with the values from $value
 * i.e. 
 * <code>
 * <?php
 *  $array = array(0=>array('city'=>12),1=>array('city'=>33));
 *  $test = plainArray($array,"city");
 *  $test will be: array("12","33);
 * ?>
 * </code>
 * @author Dave Jay <dave.jay90@gmail.com>
 * @since January 7, 2014
 * 
 */
function plainArray($array, $value) {
    $return = array();
    foreach ($array as $key => $each_value) {
        $return[] = $each_value[$value];
    }
    return array_filter($return);
}

function __MEDIA_URL() {
    if (_isLocalMachine()) {
        return 'http://www.my-brilliant.info/dev/v2/instance/front/media/';
    } else {
        return _MEDIA_URL;
    }
}

function timeDiffInMins($latestTime, $prevTime) {
    $startTime = strtotime($prevTime);
    $endTime = strtotime($latestTime);

    $timeCalc = $endTime - $startTime;

    $timeCalcMins = intval($timeCalc / 60);
    $timeCalcSeconds = intval($timeCalc % 60);

    return "{$timeCalcMins} Min. {$timeCalcSeconds} Seconds";
}

function getHourDiff($max, $min) {

    $time1 = new DateTime($max);
    $time2 = new DateTime($min);
    $interval = $time1->diff($time2);

    $hours = $interval->h;
    $mins = $interval->i;

    if ($interval->invert == '1') {
        $hours = 24 - $interval->h;
        $mins = 60 - $interval->i;
    }

    $fraction = number_format(($mins / 60), 2);
    return $hours + $fraction;
}

function _parseHours($hours) {
    $mins = end(explode(".", $hours));
    $mins = intval($mins * 0.6);
    $hours = intval($hours);

    $return = $hours ? $hours : "";
    if ($hours > 0) {
        $return .= $hours && $hours > 1 ? " hours" : "hour";
    }
    $return .= $mins > 0 ? " {$mins} minutes" : "";
    return $return;
}

function _parseHoursOnly($hours) {
    $mins = end(explode(".", $hours));
    $mins = intval($mins * 0.6);
    $hours = intval($hours);

    $return = $hours ? $hours : "";
    if ($hours > 0) {
        $return .= $hours && $hours > 1 ? " hrs" : "hr";
    } else {
        $return .= $mins > 0 ? " {$mins} min" : "";
    }
    return $return;
}


function _moneyFormat($number) {
    return $number ? "$" . number_format($number) : "$0";
}

function _rateFormat($number) {
    $number = $number ? $number : "0";
    return round($number, 2) . "%";
}

function writeLog($log,$filePath = ''){
    if($filePath==''){
        $filePath = _PATH."error_log/log_".date("Y-m-d").".txt";
    }
    $log = "Time: ".date("h:i A").$log."\n\n----------------------------------------------------\n\n";
    file_put_contents($filePath,$log,FILE_APPEND);
}
function array_key_exists_rec($needle, array $array)
    {
        if(array_key_exists($needle,$array))
                return true;
        foreach ($array as $key => $value) {
            if($key === $needle) return true;
            if (is_array($value)) {
                if ($x = array_key_exists_rec($needle, $value)) return $x;
            }
        }        
        return false;
    }
    function getErrorCode($error){
        if (isset($error['code'])) {
            return (($error['code'] * -1) - 32000);
        } else {
            return 0;
        }
    }
    function getErrorMessage($error){
        if (isset($error['message'])) {
            return $error['message'];
        } else {
            return "Something wrong with redstag.";
        }
    }
?>