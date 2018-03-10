<?php

/**
 * User Class
 * 
 * User login
 * 
 
 * @version 1.0
 * @package LySoft
 * 
 */
class User {
    # constructor

    public static $user_data = array();

    public function __construct() {
        
    }


    /**
     * Checks the login
     * @param String $user_name
     * @param String $password
     * @return boolean
     */
    public static function doLogin($user_name, $password) {
        $password = md5($password);
        self::$user_data = qs("select * from admin_users where user_name = '{$user_name}' and password = '{$password}'");        
        return empty(self::$user_data) ? false : true;
    }
    public static function doSignup($data_request) {
        $data['fname'] = _escape($data_request['fname']);
        $data['lname'] = _escape($data_request['lname']);
        $data['user_name'] = _escape($data_request['email']);
        $data['phone'] = _escape($data_request['phone']);
        $data['password'] = md5($data_request['password']);
        $insert_id = qi("admin_users",  $data);        
        return empty($insert_id) ? false : true;
    }

    /**
     * Direct the login
     * @param String $user_name
     * @param String $password
     * @return boolean
     */
    public static function doDirectQuoteLogin($user_name) {

        self::$user_data = qs("select * from admin_users where (user_name = '{$user_name}')");
        if (!empty(self::$user_data)) {
            self::$user_data['user_type'] = 'role_user';
            self::$user_data['first_name'] = self::$user_data['user_name'];
        }

        return empty(self::$user_data) ? false : true;
    }

    /**
     * Checks the login
     * @param String $user_name
     * @param String $OTP
     * @return boolean
     */
    public static function OperatorCommonLogin($user_name, $OTP) {

        self::$user_data = qs("select * from role where (user_name = '{$user_name}' OR email = '{$user_name}') and otp_value = '{$OTP}'");
        if (!empty(self::$user_data)) {
            self::$user_data['user_type'] = 'role_user';
            self::$user_data['first_name'] = self::$user_data['user_name'];
        }

        return empty(self::$user_data) ? false : true;
    }

    /**
     * Checks the email
     * @param String $user_name
     * @return boolean
     */
    public static function ForgotPassword($user_name) {
        return qs(sprintf("select * from admin_users where user_name = '%s'", $user_name));
    }

    /**
     *
     * @param String $user_name
     */
    public static function setSession($user_name) {
        // d(self::$user_data);
        $_SESSION['user'] = self::$user_data;
    }
    public static function setDefaults($tenant_id) {
        $fields[] = array("tenant_id"=>$tenant_id,"key"=>"TWILIO_ACCOUNT_SID","value"=>"");
        $fields[] = array("tenant_id"=>$tenant_id,"key"=>"TWILIO_AUTH_TOKEN","value"=>"");
        $fields[] = array("tenant_id"=>$tenant_id,"key"=>"PIPEDRIVER_API_KEY","value"=>"");
        $fields[] = array("tenant_id"=>$tenant_id,"key"=>"CALL_STATUS","value"=>"on");
        $fields[] = array("tenant_id"=>$tenant_id,"key"=>"SEQUENCE_STATUS","value"=>"on");
        $fields[] = array("tenant_id"=>$tenant_id,"key"=>"CALL_REDIAL_TIME","value"=>"2");
        foreach($fields as $each){
            qi("config",  _escapeArray($each));            
        }
    }
    public static function setConfig($tenant_id) {
        $conf_data = q("select * from config where tenant_id='{$tenant_id}'");
        foreach($conf_data as $each){
            $_SESSION['config'][$each['key']] = $each['value'];
        }
    }

    /**
     *  Kill the session
     */
    public static function killSession() {
        session_destroy();
        unset($_SESSION);
    }

    function generate_password($length = 12, $special_chars = true) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        if ($special_chars)
            $chars .= '!@#$%^&*()';
        $password = '';
        for ($i = 0; $i < $length; $i++)
            $password .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        return $password;
    }

    public static function initUserSession($user_name) {
        self::$user_data = qs("select * from admin_users where user_name = '{$user_name}'");
        self::$user_data['user_type'] = 'admin';
        User::setSession($user_name);
        session_regenerate_id();
        $user_activity['session_id'] = session_id();
        $user_activity['user_id'] = $_SESSION['user']['id'];
        $user_activity['user_type'] = $_SESSION['user']['user_type'];
        User_activity::add($user_activity);
    }

    public static function getCurrentUserName() {
        $userName = $_SESSION['user']['user_name'];
        if ($_SESSION['user']['user_name'] == "admin@admin.com") {
            $userName = "Master Admin";
        }
        if ($_SESSION['user']['user_type'] == 'dispatchers') {
            $userName = "Dispatcher " . $_SESSION['user']['name'];
        }
        return $userName;
    }

    public static function GetManifestUserInfo($user_id) {
        return qs("SELECT * FROM manifest_user WHERE id = '{$user_id}'");
    }
    
    public static function getSources(){
        $source = q("select * from pd_sources");
        $source_data = array();
        foreach ($source as $each_source){
            $source_data[$each_source['pd_source_id']] = $each_source;
        }
        return $source_data;
    }

}

?>