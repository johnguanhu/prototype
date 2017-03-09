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
class Users extends apiCore{

    /**
     * Mechanism to access variable globally
     * @var Array $_vars
     */
    public static $_vars = array();

    # constructor

    public function __construct() {
        
    }

    
    /**
     *  Kill the session
     */
    public static function killSession() {
        session_destroy();
        unset($_SESSION);
    }
    
    
    /**
     * 
     * Return All Users Detail
     * 
     */
    public function GetAllUsers($fname='',$lname='',$uname='') {
        $filter = '';
        if($fname!=''){
            $filter .= "firstName=".$fname."&";
        }
        if($lname!=''){
            $filter .= "lastName=".$lname."&";
        }
        if($uname!=''){
            $filter .= "username=".$uname."&";
        }
        $filter = trim($filter,"&");
        $url = BROKER_BOOKED_API_URL. "users/?".$filter;
        $header = array("Cookie: sessionid=".$_SESSION['user_auth']['sessionid']);
        return json_decode($this->doCall($url,$header));
    }
    public function GetAllBrokerUsers() {        
        $url = BROKER_API_URL. "users/?";
        $header = array("Cookie: sessionid=".$_SESSION['user_auth_broker']['sessionid']);
        return json_decode($this->doCall($url,$header),true);
    }
    
    public function DeleteUser($id){
        $url = BROKER_BOOKED_API_URL . "users/".$id;
        $header = array("Cookie: sessionid=".$_SESSION['user_admin_auth']['sessionid'],"Content-Type: application/json", 'X-Org-Symbol:' . $_SESSION['org_file_name']);
        $output =  $this->doCall($url,$header,"DELETE");        
        $data = json_decode($output,true);
        if(!empty($data) && isset($data['detail'])){
            return $data;
        }else{
            $error .= "\nAPI : DeleteUser";
            $error .= "\nResponse: ".$output;
            writeLog($error);
            return $data;
        }
    }

    /**
     * 
     * Converts All Users Data to Array and  Can Access by UserId
     * @param type $user
     * 
     */
    public static function ConvertUsersDatatoArray($user) {
        if (isset($user->users)) {
            $user_data = $user->users;
        } elseif (isset($user)) {
            $user_data = $user;
        } else {
            return null;
        }
        $user_data = json_decode(json_encode($user_data),true);
        $USER = null;
        foreach ($user_data as $each_user) {
            $USER[$each_user['id']] = $each_user;
            foreach($each_user['customAttributes'] as $each_attr){
                $USER[$each_user['id']][$each_attr['label']] = $each_attr['value'];
            }
            unset($USER[$each_user['id']]['customAttributes']);
            unset($USER[$each_user['id']]['links']);
        }
        return $USER;
    }

    public function GetUserById($userId) {
        $url = BROKER_BOOKED_API_URL . "users/" . $userId;
        $header = array("Cookie: sessionid=".$_SESSION['user_auth']['sessionid']);
        return json_decode($this->doCall($url,$header));
    }
    public function GetBrokerUserById($userId) {
        $url = BROKER_API_URL . "users/" . $userId;
        $header = array("Cookie: sessionid=".$_SESSION['user_auth_broker']['sessionid']);
        return json_decode($this->doCall($url,$header));
    }

    public function CreateUser($updValueArray) {
        $url = BROKER_BOOKED_API_URL . "users/";
        $postfields = json_encode($updValueArray);

        if(!isset($_SESSION['user_auto']))
            self::doAutoLogin();
        
        $header = array("Cookie: sessionid=".$_SESSION['user_auto']['sessionid'],"Content-Type: application/json", 'X-Org-Symbol:' . $_SESSION['org_file_name']);
        $output = $this->doCall($url,$header,"POST",$postfields);
        $result = json_decode($output, true);
        if(!isset($result['id']) || $result['id']==''){
            $first_key = key($result);
            $error .= "\nError: ".$result[$first_key];
            $error .= "\nUserId: ".$userId;
            $error .= "\nRequest: ".$postfields;
            $error .= "\nResponse: ".$output;
            writeLog($error);
        }
        return $result;
    }
    
    public function UpdateUser($userId, $updValueArray) {
        $url = BROKER_BOOKED_API_URL . "users/" . $userId;
        $postfields = json_encode($updValueArray);

        if(!isset($_SESSION['user_admin_auth']))
            self::doAdminLogin();
        
        $header = array("Cookie: sessionid=".$_SESSION['user_admin_auth']['sessionid'],"Content-Type: application/json");
        $output = $this->doCall($url,$header,"PUT",$postfields);
        $result = json_decode($output, true);
        if(!isset($result['userId']) || $result['userId']==''){
            $first_key = key($result);
            $error .= "\nError: ".$result[$first_key];
            $error .= "\nUserId: ".$userId;
            $error .= "\nRequest: ".$postfields;
            $error .= "\nResponse: ".$output;
            writeLog($error);
        }
        return $result;
    }
    
    public static function doAutoLogin() {
        $ch = curl_init();
        $url = BROKER_BOOKED_API_URL . "authenticate/";
        $body = json_encode(array());
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'X-Client: CS', 'X-Org-Symbol:' . $_SESSION['org_file_name']));
        $output = curl_exec($ch);
        $headerLen = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $curlBody = substr($output, $headerLen);
        $json_output = (json_decode($curlBody, true));
        $result = array();
        if (empty($json_output)) {
            $result = array("isAuthenticated" => false);
        }

        preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $output, $matches);
        $cookies = array();
        foreach ($matches[1] as $item) {
            parse_str($item, $cookie);
            $cookies = array_merge($cookies, $cookie);
        }
        if (!isset($cookies['sessionid']) || !isset($json_output['userId']) || !isset($json_output['isAuthenticated']) || !$json_output['isAuthenticated']) {
            return $output;
        } else {
            $json_output['sessionid'] = $cookies['sessionid'];
            $_SESSION['user_auto'] = $json_output;
            return $json_output;
        }
    }
    public static function doBrokerLogin($username,$password) {        
        $ch = curl_init();
        $url = BROKER_API_URL."login/";
        $body = json_encode(array("username" => $username, "password" => $password));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Client: CS','Content-Type: application/json','X-Org-Symbol:'.$_SESSION['org_file_name']));
        $output = curl_exec($ch);        
        $headerLen = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlBody = substr($output, $headerLen);
        $json_output = (json_decode($curlBody, true));
        if($status_code!=200){
            writeLog("\nBroker API End Point:".$url. "\n\nAuth Output: ".$output);
        }
        $result = array();
        if (empty($json_output)) {
            $_SESSION['user_auth_broker'] = array("is_authenticated"=>false,"code"=>$status_code,"id"=>"-1");
            return $_SESSION['user_auth_broker'];
        }

        preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $output, $matches);
        $cookies = array();
        foreach ($matches[1] as $item) {
            parse_str($item, $cookie);
            $cookies = array_merge($cookies, $cookie);
        }
        $json_output['sessionid'] = $cookies['sessionid'];
        $json_output['code'] = $status_code;
        $_SESSION['user_auth_broker'] = $json_output;
        return $json_output;
    }
    
    public static function doLogin($username,$password) {
        self::doBrokerLogin($username, $password);
        if(!isset($_SESSION['user_auth_broker']['is_authenticated']) || !$_SESSION['user_auth_broker']['is_authenticated']){  
            return $_SESSION['user_auth_broker'];
        }
        $ch = curl_init();
        $url = BROKER_BOOKED_API_URL."authenticate/";
        //$body = json_encode(array("username" => $username, "password" => $password));
        $body = json_encode(array());
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-Client:CS','Content-Type: application/json','X-Org-Symbol:'.$_SESSION['org_file_name']));
        $output = curl_exec($ch);        
        $headerLen = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlBody = substr($output, $headerLen);
        $json_output = (json_decode($curlBody, true));
        if($status_code!=200){
            writeLog("\nBroker API End Point:".$url. "\n\nAuth Output: ".$output);
        }
        # Uncomment to debug
//        print "<pre>";
//        print "<hr>";
//        print "Broker API End Point "  . $url;
//        print "<br /> Headers:";
//        print_r(array('X-Client:awi','Content-Type: application/json','X-Org-Symbol:'.$_SESSION['org_file_name']));
//        print "<br /> Broker Response ";
//        print "$curlBody";
//        print_r($json_output);
//        print "<hr>";
//        print "<pre>";
        
        
        
        
        $result = array();
        if (empty($json_output)) {
            return array("isAuthenticated"=>false,"code"=>$status_code,"userId"=>"-1");
        }

        preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $output, $matches);
        $cookies = array();
        foreach ($matches[1] as $item) {
            parse_str($item, $cookie);
            $cookies = array_merge($cookies, $cookie);
        }
        $json_output['sessionid'] = $cookies['sessionid'];
        $json_output['code'] = $status_code;
        $result = $json_output;
        return $result;
    }

    public static function doAdminLogin() {
        $ch = curl_init();
        $url = BROKER_BOOKED_API_URL."authenticate/";
        $body = json_encode(array("username" => ADMIN_USER_NAME, "password" => ADMIN_USER_PASSWORD));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','X-Client: AWI','X-Org-Symbol:'.$_SESSION['org_file_name']));
        $output = curl_exec($ch);
        $headerLen = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $curlBody = substr($output, $headerLen);
        $json_output = (json_decode($curlBody, true));
        
        $result = array();
        if (empty($json_output)) {
            $result = array("isAuthenticated"=>false);
        }

        preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $output, $matches);
        $cookies = array();
        foreach ($matches[1] as $item) {
            parse_str($item, $cookie);
            $cookies = array_merge($cookies, $cookie);
        }
        if(!isset($cookies['sessionid']) || !isset($json_output['userId']) || !isset($json_output['isAuthenticated']) || !$json_output['isAuthenticated']){
            
        }else{
            $json_output['sessionid'] = $cookies['sessionid'];
            $_SESSION['user_admin_auth'] = $json_output;
            
            // If Current Logged In User is Admin then Replace Old Token with New Token
            if($_SESSION['user_auth']['userId']==$_SESSION['user_admin_auth']['userId']) 
                $_SESSION['user_auth']=$_SESSION['user_admin_auth'];
        }
    }
    public function IsAWIAdmin($user_groups,$broker_user_groups)  {
//        $is_admin = '0';
//        if(is_array($user_groups) && count($user_groups)>0){
//            foreach($user_groups as $each_group){
//                if($each_group->name==AWI_ADMIN_GROUP_NAME){
//                    $is_admin = '1';
//                    break;
//                }
//            }
//        }
//        if($is_admin=='1'){
        $is_admin = '0';
        foreach ($broker_user_groups as $each_group) {
            if (strtolower($each_group->name) == 'admin') {
                $is_admin = '1';
                break;
            }
        }
//        }
        return $is_admin;
    }

    public function IsAWIDev($user_groups){
        $is_admin = '0';
        if(is_array($user_groups) && count($user_groups)>0){
            foreach($user_groups as $each_group){
                if($each_group->name==AWI_DEVELOPER_GROUP_NAME){
                    $is_admin = '1';
                    break;
                }
            }
        }
        return $is_admin;
    }
    public function GetUserCustomAttributes() {
        $url = BROKER_BOOKED_API_URL . "attributes/?category=USER";
        $header = array("Cookie: sessionid=".$_SESSION['user_auth']['sessionid']);
        $cust_attribs = json_decode($this->doCall($url,$header));        
        $cust_attributes = array();
        foreach ($cust_attribs->attributes as $each_attrib) {
            $cust_attributes[$each_attrib->label] = $each_attrib->id;
        }
        return $cust_attributes;
    }

    public function CreateUserAWI($updValueArray) {
        $url = BROKER_BOOKED_API_URL . "users/";
        $postfields = json_encode($updValueArray);

        if(!isset($_SESSION['user_admin_auth']))
            self::doAdminLogin();
        
        $header = array("Cookie: sessionid=".$_SESSION['user_admin_auth']['sessionid'],"Content-Type: application/json", 'X-Org-Symbol:' . $_SESSION['org_file_name']);
        $output = $this->doCall($url,$header,"POST",$postfields);
        $result = json_decode($output, true);
        if(!isset($result['id']) || $result['id']==''){
            $first_key = key($result);
            $error .= "\nError: ".$result[$first_key];
            $error .= "\nUserId: ".$userId;
            $error .= "\nRequest: ".$postfields;
            $error .= "\nResponse: ".$output;
            writeLog($error);
        }
        return $result;
    }
    public function createUserBroker($updValueArray) {
        $url = BROKER_API_URL . "users/";
        $postfields = json_encode($updValueArray);
        $header = array("Cookie: sessionid=" . $_SESSION['user_auth_broker']['sessionid'], "Content-Type: application/json", 'X-Client: AWI', 'X-Org-Symbol:' . $_SESSION['org_file_name']);
        $output = $this->doCall($url, $header, "POST", $postfields);
        $result = json_decode($output, true);
        if (!isset($result['id']) || $result['id'] == '') {
            $first_key = key($result);
            $error .= "\nError: " . $result[$first_key];
            $error .= "\nRequest: " . $postfields;
            $error .= "\nResponse: " . $output;
            writeLog($error);
        }
        return $result;
    }
    public function updateUserBroker($userId,$updValueArray) {
        $url = BROKER_API_URL . "users/".$userId;
        $postfields = json_encode($updValueArray);
        $header = array("Cookie: sessionid=" . $_SESSION['user_auth_broker']['sessionid'], "Content-Type: application/json", 'X-Client: AWI', 'X-Org-Symbol:' . $_SESSION['org_file_name']);
        $output = $this->doCall($url, $header, "PUT", $postfields);
        $result = json_decode($output, true);        
        if (!isset($result['id']) || $result['id'] == '') {
            $first_key = key($result);
            $error .= "\nError: " . $result[$first_key];
            $error .= "\nUserId: " . $userId;
            $error .= "\nRequest: " . $postfields;
            $error .= "\nResponse: " . $output;
            writeLog($error);
        }
        return $result;
    }
    public function DeleteUserBroker($userId) {
        $url = BROKER_API_URL . "users/".$userId;
        $header = array("Cookie: sessionid=" . $_SESSION['user_auth_broker']['sessionid'], "Content-Type: application/json", 'X-Client: AWI', 'X-Org-Symbol:' . $_SESSION['org_file_name']);
        $output = $this->doCall($url, $header, "DELETE");
        $result = json_decode($output, true);        
        return $result;
    }
    public static function getUsersFlag() {
        $target_dir = _PATH . str_ireplace("[org]", $_SESSION['org_file_name'], DATA_DIR) . "/";
        $target_file = $target_dir . $_SESSION['org_file_name'] . "_customers.tsv";
        $file = fopen($target_file, "r");
        $title_field_requires = array("marker", "firstname", "lastname", "flag");
        $is_title_set = 0;
        $usersflag = array();
        while (!feof($file)) {
            $line = fgets($file, 2048);

            $delimiter = "\t";
            $row_data = str_getcsv($line, $delimiter);
            $row = array_filter($row_data);
            if (empty($row))
                continue;
            if ($is_title_set == 0) {
                foreach ($row as $key => $value) {
                    if (in_array(strtolower($value), $title_field_requires)) {
                        $title[strtolower($value)] = array("Key" => $key, "Value" => $value);
                    }
                }
                $is_title_set = 1;
            } else {
                if (isset($row[$title['marker']['Key']]) && isset($row[$title['firstname']['Key']]) && isset($row[$title['lastname']['Key']]) && isset($row[$title['flag']['Key']])) {
                    $usersflag[] = array("marker"=>$row[$title['marker']['Key']],"firstname"=>$row[$title['firstname']['Key']],"lastname"=>$row[$title['lastname']['Key']],"flag"=>$row[$title['flag']['Key']]);
                }
            }
        }
        return $usersflag;
    }
    public static function findUserFlag($all_user_data,$fname,$lname,$last4,$unknown = '') {
        foreach($all_user_data as $each_user){
            if($each_user['marker']==$last4 && strtolower($each_user['firstname'])==strtolower($fname) && strtolower($each_user['lastname'])==strtolower($lname)){
                return $each_user['flag'];
            }
        }
        return $unknown;
    }
}

?>