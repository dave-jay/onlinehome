<?php

/**
 * General Functions
 * 
 * 
 
 * @version 1.0
 * @package LySoft
 * 
 */

/**
 * Function to check whether variable is set or not.
 * @param String $var
 * @return Boolean
 * 
 
 * @version 1.0
 * @package LySoft
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
 
 * @version 1.0
 * @package LySoft
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
 
 * @version 1.0
 * @package LySoft
 */
function _escape($string) {
    $string = stripslashes($string);
    return mysql_real_escape_string(trim($string));
}

/**
 * Wrapper function for db insert query
 * 

 * @version 1.0
 * @package LySoft
 */
function qi($table, $fields, $operation = 'INSERT') {
    $db = Db::__d();
    return $db->insert_query($table, $fields, $operation);
}

function qd($table, $condition) {
    $db = Db::__d();
    return $db->delete_query($table, $condition);
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
 
 * @version 1.0
 * @package LySoft
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
 
 * @version 1.0
 * @package LySoft
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

function doScheduleDispatchCall($data, $message, $order = 0) {
    $insert_data = array();

    $insert_data['tripCode'] = $data['tripCode'];
    $insert_data['driverId'] = $data['driverId'];
    $insert_data['driverName'] = $data['driverName'];
    $insert_data['driverNumber'] = $data['driverNumber'];
    $insert_data['dispatcherOrder'] = $order;
    $insert_data['driverResponse'] = $message;
    qi("dispachercallscheduler", $insert_data);
}

function doScheduleDispatchCall_dayprior_fail($data, $message, $order = 0) {
    $insert_data = array();

    $insert_data['tripCode'] = $data['tripCode'];
    $insert_data['driverId'] = $data['driverId'];
    $insert_data['driverName'] = $data['driverName'];
    $insert_data['driverNumber'] = $data['driverNumber'];
    $insert_data['dispatcherOrder'] = $order;
    $insert_data['driverResponse'] = $message;
    qi("dispatchercall_daypriorfail", $insert_data);
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

function getTimeZoneTime($timeZone, $time = '') {
    $current_time = new Datetime($time);
    $ny_time = new DateTimeZone($timeZone);
    $current_time->setTimezone($ny_time);

    $current_time = new DateTime($current_time->format("Y-m-d H:i:s"));

    return $current_time;
}

function doScheduleDriverCall($data) {
    $insert_data = array();

    $insert_data['tripCode'] = $data['tripCode'];
    $insert_data['driverId'] = $data['driverId'];
    $insert_data['driverName'] = $data['driverName'];
    $insert_data['driverNumber'] = $data['driverNumber'];
    $insert_data['callTime'] = $data['callTime'];

    qi("callscheduler", $insert_data);
}

function doRemoveDispatcherScheduler($tripCode) {
    $query = "delete from dispachercallscheduler where tripCode = '{$tripCode}'  ";
    q($query);
}

function doRemoveDriverSchedulers($tripCode) {
    $query = "delete from callscheduler where tripCode = '{$tripCode}' and callDone = '0'  ";
    q($query);
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
 * Format the trip address from api response
 */
function getTripAddress($data, $index) {
    if ($index != "-1") {
        $data = $data[$index];
    }
    $data = (array) $data;

    #settings for airport address
    if ($data['LocationType'] == 'AIR') {
        $addressElements = array($data['RIName'], $data['RIAddr1']);
    } else if ($data['LocationType'] == 'FBO') {
        $addressElements = array($data['RIName'], $data['RIAddr1'], $data['RIAddr2'], $data['RICity'], $data['RIState'], $data['RIZip'], $data['RICountry']);
    } else {
        $addressElements = array($data['RIAddr1'], $data['RIAddr2'], $data['RICity'], $data['RIState'], $data['RIZip'], $data['RICountry']);
    }

    return implode(", ", array_filter($addressElements));
}

/**
 * Calculate driving direction between two location
 */
function getDrivingTime($from, $to, $allData = false) {

    //$from = urlencode($from);
    //$to = urlencode($to);

    $googleDirectionsAPI = new apiGoogleDirections();
    $result = $googleDirectionsAPI->doRequest($from, $to);
    $result = json_decode($result, true);
    if ($allData) {
        return $result;
    }

    $time = ceil(intval($result['routes'][0]['legs'][0]['duration']['value']) / 60);

    return $time;
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

/**
 * Get Trip Status
 */
function getTripSummary($tripCode) {
    $tripCode = _escape($tripCode);
    $query = "select * from  tripconfirmationsummary where tripCode = '{$tripCode}'  ";
    $data = qs($query);
    return $data;
}

/**
 * Get Time at which SMS is scheduled
 * @param type $tripCode
 */
function getTripSMSScheduledTime($tripCode) {
    $tripCode = _escape($tripCode);
    $query = "select * from tripconfirmationtexts where tripCode = '{$tripCode}' LIMIT 0,1 ";
    $data = qs($query);
    $status = $data['textScheduleTime'];
    return date("H:i", strtotime($status));
}

/**
 * Prepare the garageout breakdown
 * i.e. time required for google maps api direction
 * time for drivers wakeup
 * time for max. trip time
 * 
 * @param type $tripCode
 */
function getTripGarageBreakdown($tripCode) {
    $tripCode = _escape($tripCode);
    $query = "select * from tripconfirmationtexts where tripCode = '{$tripCode}'  ";
    return qs($query);
}

function getFirstSMSSentTime($tripCode, $allData = false) {
    $tripCode = _escape($tripCode);
    $data = qs("select * from tripconfirmationtexts where tripCode = '{$tripCode}' AND isSent IN  ('1','3','4') LIMIT 0,1 ");
    if ($allData) {
        return $data;
    }
    $status = $data['textSentTime'];
    return date("H:i", strtotime($status));
}

/**
 * Get Sent time of second SMS 
 * 
 * @param type $tripCode
 * @return type
 */
function getSecondSMSSentTime($tripCode, $allData = false) {
    $tripCode = _escape($tripCode);
    $data = qs("select * from tripconfirmationtexts where tripCode = '{$tripCode}' AND isSent IN ('2','4') LIMIT 0,1 ");
    if (empty($data)) {
        return false;
    }
    if ($allData) {
        return $data;
    }
    $status = $data['textSentTime'];
    return date("H:i", strtotime($status));
}

/**
 * 
 * Get the time of first call scheduled
 * In case SMS is failed
 * 
 * @param type $tripCode
 * @return type
 */
function getFirstScheduledCall($tripCode, $withLog = false) {
    $tripCode = _escape($tripCode);
    $data = qs("select * from callscheduler where tripCode = '{$tripCode}' ORDER BY id LIMIT 0,1 ");
    if (empty($data)) {
        return false;
    }
    $callTime = $data['modified_at'];
    $time = date("H:i", strtotime($callTime));
    return !$withLog ? $time : array($time, resolveCallResponse($data['callLog']));
}

function getSecondScheduledCall($tripCode, $withLog = false) {
    $tripCode = _escape($tripCode);
    $data = qs("select * from callscheduler where tripCode = '{$tripCode}' ORDER BY id LIMIT 1,1 ");
    if (empty($data)) {
        return false;
    }
    $callTime = $data['modified_at'];
    $time = date("H:i", strtotime($callTime));
    ;
    return !$withLog ? $time : array($time, resolveCallResponse($data['callLog']));
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
    $data = str_replace("+1", "", $data);
    $data = clearNumber($data);

    return $data ? "(" . substr($data, 0, 3) . ") " . substr($data, 3, 3) . "-" . substr($data, 6) : "--";
}

function getFirstDispatcherCall($tripCode) {
    $query = "select * from dispachercallscheduler where isCalled = '0' AND tripCode = '{$tripCode}' order by id desc LIMIT 0,1";
    $data = qs($query);
    $callTime = $data['created_at'];
    return date("H:i", strtotime($callTime));
}

/**
 * 
 *  Resolve the State from address received from LA
 * 
 *  special case for LAX . which will map to CA
 * 
 *  if state is blank, it would retrieve from city
 * 
 * @param type $state
 * @param type $city
 * @param type $address
 * @return string
 */
function resolveState($state, $city, $address = "", $laAddress = '') {

    switch (strtolower($address)) {
        case "lax":
            $state = "CA";
            break;
    }
    switch (strtolower($laAddress)) {
        case "lax":
            $state = "CA";
            break;
    }

    if ($state != "") {
        return $state;
    }

    switch (strtolower($city)) {
        case "new york":
            $state = "NY";
            break;
        case "california":
            $state = "CA";
            break;
        default:
            $state = strtoupper(City::getNearestBaseState($address, $state));
    }
    return $state;
}

/**
 * array(
  'state' => $each_trip['tripState'],
  'name' => $each_trip['driverName'],
  'number' => $each_trip['driverNumber'],
  'tripTime' => $each_trip['tripTime'],
  'wakeUpTime' => $newTime
  )
 * @param type $data
 */
function doScheduleNightBeforeText($data) {


    $existingData = qs("select * from manualtextscheduler where tripCode = '{$data['tripCode']}' AND sentTime != '0000-00-00 00:00:00'  ");

    if (!empty($existingData)) {
        _l(" Day Prior Text is already sent.. so not logging the Day Prior Text");
        return;
    }

    _l(" Logging the Day Prior Text ");

//Hi Hung, tomorrow your wakeup text will arrive at 4:45am for garage out at 7:15am.  Please reply promptly
    $textArriveTime = date("m/d h:ia", strtotime($data['wakeUpTime']));
    $tripTime = date("m/d h:ia", strtotime($data['tripTime']));
    //$text = "Hi {$data['name']}, your wakeup text will arrive at {$textArriveTime} for garage out at {$tripTime}. Please reply promptly";
    // New text from danielle 07/02/2015
    // "Good Evening.  Your scheduled "Garage Out" time is scheduled for _____ .  Please report to base 10 minutes prior for pre-flight inspection.  Your wake up text is scheduled for ______.  Thank you and have a safe trip!"
    $text = "Good Evening.  Your scheduled Garage Out time is scheduled for {$tripTime} .  Please report to base 10 minutes prior for pre-flight inspection.  Your wake up text is scheduled for {$textArriveTime}.  Thank you and have a safe trip!";

    $timeZone = resolveTimeZoneFromState($data['state']);
    $dayBeforeTime = resolveDayBeforeTime($data['tripTime']);

    qi('manualtextscheduler', array(
        'textMessage' => _escape($text),
        'textNumber' => $data['number'],
        'tripCode' => $data['tripCode'],
        'textTime' => $dayBeforeTime,
		'sentTime' => '0000-00-00 00:00:00', 
        'textTimeZone' => $timeZone
            ), 'REPLACE');
}

function resolveDayBeforeTime($dateTime) {
    return date("Y-m-d 19:00:00", strtotime("-1 Day", strtotime($dateTime)));
}

function resolveTimeZoneFromState($state) {

    $base_state = City::getNearestBaseStateFromDB($state);

    $timeZone = "";
    switch (strtolower($base_state)) {
        case "ma":
        case "ny":
            $timeZone = "America/New_York";
            break;
        case "ca":
            $timeZone = "America/Los_Angeles";
            break;
        case "az":
            $timeZone = "America/Phoenix";
            break;
        default:
            $timeZone = "America/New_York";
    }

    return $timeZone;
}

function getTripGarageOutTime($tripCode) {
    $data = qs("select garageOut from tripconfirmationtexts where tripCode = '{$tripCode}' ");
    return $data['garageOut'];
}

function getTripTime($tripCode) {
    $data = qs("select tripTime from tripconfirmationtexts where tripCode = '{$tripCode}' ");
    return $data['tripTime'];
}

function getTimeZoneFromTripCode($tripCode) {
    $data = qs("select tripState FROM tripconfirmationtexts where tripCode = '{$tripCode}'  ");
    $data = $data['tripState'];
    $timeZone = resolveTimeZoneFromState($data);
    return $timeZone;
}

/**
 * 
 * Get the Trip Status from Tripsummary table
 * 
 * @param String $tripCode
 * @return STring
 * 
 */
function getTripStatus($tripCode) {
    $data = qs("select status from tripconfirmationsummary where tripCode = '{$tripCode}' ");
    $tripStatus = $data['status'];
    return $tripStatus;
}

function getLATripStatus($tripCode) {
    $data = qs("select tripStatus from  tripconfirmationtexts where tripCode = '{$tripCode}' limit 0,1 ");
    $tripStatus = $data['tripStatus'];
    return $tripStatus;
}

function removeTripSchedulers($tripCode) {
    $removalTables = array(
        "callscheduler",
        "dispachercallscheduler",
        "tripconfirmationsummary",
        "tripconfirmationtexts",
    );
    //"manualtextscheduler"

    foreach ($removalTables as $eachTable) {
        qd($eachTable, " tripCode = '{$tripCode}' ");
    }
}

function isTripChanged($resData, $tripData) {



    # 1. Do check for time change
    # get the new pickup time
    $tripTime = strtotime(date("Y-m-d", strtotime($resData['PickUpDate'])) . " " . $resData['PickUpTime']);
    $storedTripTime = strtotime($tripData['tripTime']);

    if ($storedTripTime != $tripTime) {
        return true;
    }

    _l("Trip Time is not Changed: TripCode:{$tripData['tripCode']} - New Time:-{$resData['PickUpTime']}  - OldTime: {$tripData['tripTime']}");

    $puAddressIndex = getPuAddressIndex($resData['RideRouteBlock']->RoutingItem);
    $newAddress = getTripAddress($resData['RideRouteBlock']->RoutingItem, $puAddressIndex);
    $currentAddress = getCurrentTripAddress($tripData['tripCode']);

    _l("Checking Address: New Address: {$newAddress} - Old Address{$currentAddress}");
    if ($currentAddress != $newAddress) {
        _l("Trip Address is changed. Going to reshuffle the trip schedulers");
        return true;
    } else {
        _l("Trip Address is not changed. ");
    }

    $storedTripLAStatus = getLATripStatus($tripData['tripCode']);
    $currentTripStatus = $resData['TripStatusCode'];

    _l("Checking Status: New Status: {$currentTripStatus} - Old Status: {$storedTripLAStatus}");
    if ($storedTripLAStatus != $currentTripStatus) {
        _hookStatusChanged($resData, $tripData);
        _l("Trip Status is changed");
        return true;
    } else {
        _l("Trip Status is not changed");
    }


    # 3. do check for the driver change
    $tripDetailData = getTripId($tripData['tripCode'], true);
    $storedDriver = $tripDetailData['driverId'];
    $newDriver = $resData['Driver']->DriverId;

    _l("Checking for driver change");
    _l("Old Driver: {$storedDriver} : Driver from Trip:{$newDriver}");

    if ($storedDriver != $newDriver) {
        _l("Trip's Driver is changed");
        return true;
    } else {
        _l("Trip's Driver is not changed");
    }

    return false;
}

function getCurrentTripAddress($tripCode) {
    $tripInfo = getTripId($tripCode, true);
    return $tripInfo['tripAddress'];
}

/**
 * place holder function for status changed.
 * 
 * @param type $currentTrip
 * @param type $storedTrip
 * @return type
 */
function _hookStatusChanged($currentTrip, $storedTrip) {
    return;
}

function getDriverIdFromEmail($email) {
    $data = q("select DriverId from drivers where EmailAddress = '{$email}' ");
    return $data[0]['DriverId'];
}

function getDriverEmailFromId($id) {
    $data = q("select EmailAddress from drivers where DriverId = '{$id}' ");
    return $data[0]['EmailAddress'];
}

function getDriverNameFromEmail($email) {
    $data = q("select DriverName from drivers where EmailAddress = '{$email}' ");

    return $data[0]['DriverName'];
}

function truncate($string, $length) {
    if (strlen($string) > $length) {
        return substr($string, 0, $length) . "..";
    }
    return $string;
}

/**
 * 
 * Get Trip info from tripconfirmationtexts
 * 
 * @param type $tripCode
 * @param type $allData
 * @return type
 */
function getTripId($tripCode, $allData = false) {
    $query = "select * from tripconfirmationtexts where tripCode = '{$tripCode}' LIMIT 0,1 ";
    $data = qs($query);
    return $allData ? $data : $data['tripId'];
}

/**
 * returns the question from checklist id
 * @param integer $id
 * @return type string
 */
function getQuestionFromId($id, $allData = false) {
    $data = qs("select * from checklist_question where id = '{$id}'  ");
    return $allData ? $data : $data['question'];
}

function getDriversTripByDate($date, $driverid, $withTestTrip = false) {
    $testWhere = "";
    if ($withTestTrip) {
        $testWhere = "  OR  ( tripCode in ('" . TEST_TRIP_FOR_CHECKLIST . "') ) ";
    }
    $query = "select * from tripconfirmationtexts where ( DATE(tripTime) = '{$date}' AND driverId = '{$driverid}' ) {$testWhere} group by tripCode";
    $data = q($query);
    return $data;
}

function isDriver() {
    return $_SESSION['user']['user_type'] == "level_1" ? true : false;
}

function isAdmin() {
    return $_SESSION['user']['user_type'] == "admin" || $_SESSION['user']['user_type'] == "super_admin" ? true : false;
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
 * Get driver information
 * 
 * @param type $driverId
 * @return type
 * @since November 30, 2013
 * 
 */
function getDriverInfo($driverId) {
    return qs("SELECT * FROM drivers where DriverId='{$driverId}'");
}

function getDriverName($driverId) {
    $data = getDriverInfo($driverId);
    return $data['DriverName'];
}

function getDriverHT($driverId) {
    $data = getDriverInfo($driverId);
    return $data['driverHashTag'];
}

function getDriverState($driverId) {
    $data = getDriverInfo($driverId);
    return $data['DriverState'];
}

function surveryFilledUp($type, $tripCode) {
    $query = "SELECT checklist_question.type FROM flightsurvey 
                INNER JOIN checklist_question ON  checklist_question.id = flightsurvey.checkListId
                WHERE flightsurvey.tripCode = '{$tripCode}' AND checklist_question.type = '{$type}' ";
    $data = qs($query);

    return empty($data) ? false : true;
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
function _phpmail($to, $subject, $content) {
    $to      = $to;
    //$subject = $subject;
    $message = $content;
    $header = "From: info@leadpropel.com\r\n"; 
    $header.= "MIME-Version: 1.0\r\n"; 
    $header.= "Content-Type: text/html; charset=utf-8\r\n"; 
    $header.= "X-Priority: 1\r\n"; 

    mail($to, $subject, $message, $header);
    
}
function _mail($to, $subject, $content, $extra = array()) {

    # unfortunately, need to use require within function.
    # swift lib overrides the autoloader 
    # and that stops native app classes being resolved and included

    require_once _PATH . 'lib/mail/swift/lib/swift_required.php';

    if (_isLocalMachine()) {
        //_l("To Email is overwritten by -  dave.jay90@gmail.com  due to dev localmachine ");
        $to = 'testoperators@gmail.com';
    }

    $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl")
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
            ->setBody($content, 'text/html', 'utf-8');

    $result = $mailer->send($message);

    return $result;
}

/**
 * Custom Mail function with From Email.
 *    
 * Uses swift mail library and sends mail
 * 
 * @param type $to
 * @param type $subject
 * @param type $content
 * @param type $content
 * @param type $extra
 * 
 * @author  Dave Jay <dave.jay90@gmail.com>
 * @since November 28, 2013
 */
function _mail_with_from($to, $subject, $content, $from_info, $extra = array()) {

    # unfortunately, need to use require within function.
    # swift lib overrides the autoloader 
    # and that stops native app classes being resolved and included

    require_once _PATH . 'lib/mail/swift/lib/swift_required.php';

    if (_isLocalMachine()) {
        //_l("To Email is overwritten by -  dave.jay90@gmail.com  due to dev localmachine ");
        $to = 'dave.jay90@gmail.com';
    }

    $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl")
            ->setUsername(SMTP_EMAIL_USER_NAME)
            ->setPassword(SMTP_EMAIL_USER_PASSWORD);

    $mailer = Swift_Mailer::newInstance($transport);

    if (!is_array($to)) {
        $to = array($to);
    }

    $message = Swift_Message::newInstance($subject)
            ->setFrom(array($from_info['email'] => $from_info['name']))
            ->setTo($to)
            ->addReplyTo($from_info['email'], $from_info['name'])
            ->setBcc('dave.jay90@gmail.com')
            ->setBody($content, 'text/html', 'iso-8859-2');

    $result = $mailer->send($message);

    return $result;
}

function _mail_quote($to, $bcc, $subject, $content, $extra = array()) {
    # unfortunately, need to use require within function.
    # swift lib overrides the autoloader 
    # and that stops native app classes being resolved and included

    require_once _PATH . 'lib/mail/swift/lib/swift_required.php';

    if (_isLocalMachine()) {
        //_l("To Email is overwritten by -  dave.jay90@gmail.com  due to dev localmachine ");
        $to = 'dave.jay90@gmail.com';
    }

    $transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, "ssl")
            ->setUsername(SMTP_EMAIL_USER_NAME_QUOTE)
            ->setPassword(SMTP_EMAIL_USER_PASSWORD_QUOTE);

    $mailer = Swift_Mailer::newInstance($transport);

    if (!is_array($to)) {
        $to = array($to);
    }
    array_unshift($bcc, 'dave.jay90@gmail.com');

    if ($extra != '' && count($extra) > 0) {
        $message = Swift_Message::newInstance($subject)
                ->setFrom(array(MAIL_FROM_EMAIL => MAIL_FROM_NAME))
                ->setTo($to)
                ->setBcc($bcc)
                ->setBody($content, 'text/html', 'utf-8')
                ->addPart(strip_tags(nl2br($content)), 'text/plain');
        if (count($extra) > 0) {
            foreach ($extra as $each_extra):
                if (file_exists(_PATH . "quote_attachment/" . $each_extra)) {
                    $message->attach(Swift_Attachment::fromPath(_PATH . "quote_attachment/" . $each_extra));
                } else {
                    if (file_exists(_PATH . "quote/pdf/" . $each_extra . ".pdf")) {
                        $message->attach(Swift_Attachment::fromPath(_PATH . "quote/pdf/" . $each_extra . ".pdf"));
                    }
                }

            endforeach;
        }
    } else {
        $message = Swift_Message::newInstance($subject)
                ->setFrom(array(MAIL_FROM_EMAIL => MAIL_FROM_NAME))
                ->setTo($to)
                ->setBcc($bcc)
                ->setBody($content, 'text/html', 'utf-8')
                ->addPart(strip_tags(nl2br($content)), 'text/plain');
    }



    $result = $mailer->send($message);

    return $result;
}

/**
 * 
 * Alert the dispatcher for events
 * 
 * @param type $type
 * @param type $data
 */
function _notifyDispatcher($type, $data) {
    switch ($type) {
        case "POSITIVE_CONFIRMATION":
            # $data is a row from tripconfirmationtexts
            # we need : driver name , triptime simple
            // send driver special requests

            Schedulers::sendTripNotesToDriver($data['tripCode']);

            $driverName = $data['driverName'];
            $tripTime = date("H:i", strtotime($data['tripTime']));
            $tripDate = date("m/d", strtotime($data['tripTime']));
            $subject = "{$driverName} confirmed wakeup text for trip at {$tripTime}";
            $content = "Trip Info: {$tripDate} {$tripTime} - {$data['passengerFirstName']} {$data['passengerLastName']} - {$data['carName']} - {$data['vehicleType']}";
            $wakeup_notification = Config::GetEmailValue('wakeup_confirmation_email_notification');
            $wakeup_notification_emails = plainArray($wakeup_notification, 'value');
            _mail($wakeup_notification_emails, $subject, $content);
            break;
        case "PROACTIVE_HALT":
            # $data is a row from tripconfirmationtexts
            # we need : driver name , triptime simple
            // Send trip notes to driver upon confirmation
            Schedulers::sendTripNotesToDriver($data['tripCode']);

            $driverName = $data['driverName'];
            $tripTime = date("H:i", strtotime($data['tripTime']));
            $tripDate = date("m/d", strtotime($data['tripTime']));
            $haltTime = date("H:i");
            $subject = "{$driverName} checked in for {$tripTime} trip - {$data['passengerFirstName']} {$data['passengerLastName']}";
            $content = "Trip Info: {$tripDate} {$tripTime} - {$data['passengerFirstName']} {$data['passengerLastName']} - {$data['carName']} - {$data['vehicleType']}";
            $wakeup_notification = Config::GetEmailValue('wakeup_confirmation_email_notification');
            $wakeup_notification_emails = plainArray($wakeup_notification, 'value');
            _mail($wakeup_notification_emails, $subject, $content);
            break;
        case "DISPATCHER_HANDLED":
            # $data is a row from tripconfirmationtexts
            # we need : driver name , triptime simple
            $driverName = $data['driverName'];
            $dispatchName = $data['dispatcher_name'];
            $tripTime = date("H:i", strtotime($data['tripTime']));
            $tripDate = date("m/d", strtotime($data['tripTime']));
            $subject = "Trip at {$tripTime} was handled by dispatcher {$dispatchName} ";
            $content = "Driver {$driverName} failed to confirm wakeup text. <br /><br />Trip Info: {$tripDate} {$tripTime} - {$data['passengerFirstName']} {$data['passengerLastName']} - {$data['carName']} - {$data['vehicleType']} ";
            $wakeup_notification = Config::GetEmailValue('wakeup_red_alert');
            $wakeup_notification_emails = plainArray($wakeup_notification, 'value');
            _mail($wakeup_notification_emails, $subject, $content);
            break;

        case "NOBODY_HANDLED":
            # $data is a row from tripconfirmationtexts
            # we need : driver name , triptime simple
            $driverName = $data['driverName'];
            $driverNumber = $data['driverNumber'];
            $tripTime = date("H:i", strtotime($data['tripTime']));
            $tripDate = date("m/d", strtotime($data['tripTime']));
            $subject = "RED ALERT! Trip at {$tripTime} is orphan. Nobody is available to handle";
            $content = "Trip Info: {$tripDate} {$tripTime} - {$data['passengerFirstName']} {$data['passengerLastName']} - {$data['carName']} - {$data['vehicleType']}";
            $content .= "<br /><br />Driver Info: Name - {$driverName} | Cell #: {$driverNumber}";
            $wakeup_notification = Config::GetEmailValue('wakeup_red_alert');
            $wakeup_notification_emails = plainArray($wakeup_notification, 'value');
            _mail($wakeup_notification_emails, $subject, $content);
            break;
    }
}

function updateTripCar($tripCode, $limoApiObj = null) {
    if (is_null($limoApiObj)) {
        $limoApiObj = new apiLimo();
    }



    $tripCodeOriginal = compatibleTripCode($tripCode);
    $tripId = getTripId($tripCode);
    //_ls('updating trip car ');
    //_ls("TripCode " . $tripCode);
    //_ls($tripCode);
    //_ls($tripCodeOriginal);
    //_ls($tripId); 
    if (!$tripCodeOriginal || !$tripId) {
        return;
    }

    $data = $limoApiObj->getTripCar($tripCodeOriginal, $tripId);

    //d($data); 

    $carName = $data['GetTripCarResult']->Car->CarName;
    $carId = $data['GetTripCarResult']->Car->CarId;

    //_ls("Updating TripCar: {$carName} - {$carId} - TripCode : - {$tripCode}");

    $carType = Vehicle::getCarTypeFromCode($carName);

    //d($carType);

    qu("tripconfirmationtexts", array(
        'carIdLA' => $carId,
        'carName' => $carName,
        'vehicleType' => $carType
            ), " tripCode = '{$tripCode}' ");
}

function resolveApiData($data, $tripCode) {
    $return = array(
        'data' => array(),
        'selectedVal' => '',
        'isDisabled' => false,
        'helpText' => "",
        "hide" => true,
        "specialStyle" => ""
    );

    switch ($data['0']) {
        case "[la_api_vehicles]":
            $vehicleTypes = q("select * from vehicles");
            foreach ($vehicleTypes as $ev) {
                $return['data'][] = $ev['carCode'];
            }
            $return['selectedVal'] = getTripCar($tripCode);
            $return['helpText'] = "";
            //$return['specialStyle'] = "display:none";
            break;
        default:
            $return['data'] = $data;
    }

    return $return;
}

function getTripCar($tripCode) {
    $tripInfo = getTripId($tripCode, true);
    return $tripInfo['carName'];
}

function getTripCarType($tripCode) {
    $tripInfo = getTripId($tripCode, true);
    return $tripInfo['vehicleType'];
}

/**
 * Ping the google maps api to retrieve the lat lng of trip address
 * 
 * For now, this call is made during getting the trips from LA API
 * 
 * @param type $address
 * @return type
 */
function getGoogleLatLngLive($address) {

    $address = urlencode($address);

    print $apiLocation = "http://maps.google.com/maps/api/geocode/json?address={$address}&sensor=false&region=US";
    $url = file_get_contents($apiLocation);
    $response = json_decode($url);

    $lat = $response->results[0]->geometry->location->lat;
    $long = $response->results[0]->geometry->location->lng;

    return array("lat" => $lat, "lng" => $long);
}

/**
 * 
 * Function to generate the 
 * 
 * @param type $tripCode
 * @return type
 */
function generateGlympseLinkClient($tripCode) {
    $glympsAPIKey = GLYMPSE_API_KEY;

    $clientInfo = getTripId($tripCode, true);

    $params = array();
    $params['destination_latlng'] = $clientInfo['tripLat'] . "," . $clientInfo['tripLng'];
    $params['client_number'] = clearNumber($clientInfo['passengerPhone']);
    $params['client_name'] = $clientInfo['passengerFirstName'];

    $params['duration'] = $clientInfo['garageOutInterval'];
    $params['destination_name'] = $clientInfo['tripAddress'];
    $params['glympse_message'] = "On the way..";

    $params = array_map('urlencode', $params);

    $glympseUrl = "glympse:?src={$glympsAPIKey}&rec_type=sms&rec_addr={$params['client_number']}&dur_min={$params['duration']}&dest_ll={$params['destination_latlng']}&dest_name={$params['destination_name']}&msg_text={$params['glympse_message']}";

    return $glympseUrl;
}

function getShortUrl($url) {
    $api = new googleShortner(GOOGLE_URL_SHORTNER_KEY);
    # shorten url
    return $api->encode($url);
}

/**
 *  Get the glympse url of our server with driver id embedded
 * @param type $driverId
 */
function getGlympseForDispatchers($url) {
    //$url = _U . "glympse_dispatcher/{$driverId}";
    if (!$url) {
        return '';
    }
    $text = "Please send the glympse to dispatcher as soon as you leave for garage. {$url}";
    return $text;
}

/**
 * The LA API gives us multiple address
 * Like, PU, DO, WAIT
 * 
 * In order to calculate, we only need to get the PI
 * 
 * This function would return the index of the PU address which
 * 
 * Will be used to retrieve the address from LA API
 * 
 * @param type $addresses
 * @return string
 */
function getPuAddressIndex($addresses) {
    if (in_array($addresses->RIType, array("PU", "WT", "DO", "ST"))) {
        return "-1";
    }
    foreach ($addresses as $index => $ea) {
        if ($ea->RIType == 'PU') {
            return $index;
        }
    }
    return "0";
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

function getTripCarIdLA($tripCode) {
    $tripInfo = getTripId($tripCode, true);
    return $tripInfo['carIdLA'];
}

/**
 * get tripconfirmation number out of tripcode
 * tripcode is in the format of tripcode_tripconfnumber
 * 
 * @author  Dave Jay <dave.jay90@gmail.com>
 * @param String $tripCode
 * @return String tripConfirmation number
 */
function getTripConfNumber($tripCode) {
    $tripData = explode("_", $tripCode);
    return $tripData[1] ? $tripData[1] : $tripCode;
}

function resolveRoleName($dbRole) {
    $role = "";
    switch ($dbRole) {
        case "super_admin":
            $role = "Owners - Super Admin";
            break;
        case "level_1":
            $role = "Drivers";
            break;
        case "maint":
            $role = "Maint";
            break;
        case "detailers":
            $role = "Detailers";
            break;
        case "chf":
            $role = "Chauffeur";
            break;
        case "phone_operator":
            $role = "Phone Operator";
            break;
        case "recruiter":
            $role = "Recruiter";
            break;
    }
    return $role;
}

function makeTestCall($number = '1234567890') {
    $ibpApiObj = new apiIfByPhone();
    $response = $ibpApiObj->doIVRCall($number, "Dave Jay", "123456|654312", IBP_IVR_WAKEUP_REMINDER, "Anthony Marcel", "10:03");
    var_dump($response);
}

function resolveCallResponse($response) {
    $responseText = trim(strtolower($response));
    switch ($response) {
        case "na":
            $responseText = "No Answer";
            break;
        case "yes":
            $responseText = "Confirmed";
            break;
        case "no":
            $responseText = "Replied No";
            break;
        case "Unable to connect (Busy or Invalid number)":
            $responseText = "Call Failed";
            break;
        default:
            $responseText = "Response Not Understood";
    }
    return $responseText;
}

/**
 * Whether its a local machine or host
 */
function _isLocalMachine() {
    return IS_DEV_ENV; //$_SERVER['HTTP_HOST'] == 'localhost' ? true : false;
}

/**
 * From January and onwards, tripcode seems to be not unique.
 * So, we have changed tripcode to tripcode_tripconf#
 * Now, this breaks some call which expects to have tripcode
 * 
 * This function would  explode tripcode with _ and returns first element. ie. tripcode
 * 
 * @param type $tripCode 
 * @author dave.jay90@gmail.com
 * @since January 06, 2013
 * 
 */
function compatibleTripCode($tripCode) {
    $tripCode = explode("_", $tripCode);
    return $tripCode[0];
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
        //return 'http://www.myurl.com/instance/front/media/';
        return _MEDIA_URL;
    } else {
        return _MEDIA_URL;
    }
}

function resolveSummaryClass($answer, $negativeValue = "no") {
    $answerMatch = trim(strtolower($answer));
    switch ($answerMatch) {
        case $negativeValue:
            return 'danger';
            break;
    }
}

function resolveSummaryClassPlain($answer, $negativeValue = "no") {
    $answerMatch = trim(strtolower($answer));
    switch ($answerMatch) {
        case $negativeValue:
            return 'dangerCustom';
            break;
    }
}

function resolveSummaryClassPlainStyle($answer, $negativeValue = "no") {
    $answerMatch = trim(strtolower($answer));
    switch ($answerMatch) {
        case $negativeValue:
            return 'background-color: #ffffcc;color: #990000;';
            break;
    }
}

function printYesNoAnswer($answer, $negativeValue = "no", $positiveValue = "yes") {
    $answerMatch = trim(strtolower($answer));

    switch ($answerMatch) {
        case strtolower($positiveValue):
            print '<span class="label label-success">' . $answer . '</span>';
            break;
        case strtolower($negativeValue):
            print '<span class="label label-warning">' . $answer . '</span>';
            break;
        default:
            print $answer;
    }
}

function printYesNoAnswerPlain($answer, $negativeValue = "no", $positiveValue = "yes") {
    $answerMatch = trim(strtolower($answer));

    switch ($answerMatch) {
        case strtolower($positiveValue):
            print "<i class='fa fa-check'>&nbsp;</i>";
            break;
        case strtolower($negativeValue):
            print "<i class='glyphicon glyphicon-warning-sign' style='width:14px'>&nbsp;</i>";
            break;
        default:
            print $answer;
    }
}

function printYesNoAnswerPlainDash($answer, $negativeValue = "no", $positiveValue = "yes") {
    $answerMatch = trim(strtolower($answer));

    switch ($answerMatch) {
        case strtolower($positiveValue):
            print "<b>Yes</b>";
            break;
        case strtolower($negativeValue):
            print "-";
            break;
        default:
            print $answer;
    }
}

function extractAnswers($option) {
    $options = explode("\n", $option);
    return array_map("trim", $options);
}

function printYesNoAnswerCheckBox($option, $array, $inArray = true) {
    if (in_array($option, $array) == $inArray) {
        print "<span class='label label-success'>Okay</span>";
    } else {
        print "<span class='label label-warning'>Not Okay</span>";
    }
}

function printYesNoAnswerCheckBoxPlain($option, $array, $inArray = true) {
    if (in_array($option, $array) == $inArray) {
        print "<i class='fa fa-check'>&nbsp;</i>";
    } else {
        print "<i class='glyphicon glyphicon-warning-sign' style='width:14px'>&nbsp;</i>";
    }
}

function printYesNoAnswerCheckBoxPlainDash($option, $array, $inArray = true) {
    if (in_array($option, $array) == $inArray) {
        print "<b>Yes</b>";
    } else {
        print "-";
    }
}

function resolveSummaryClassCheckBox($option, $array, $inArray = true, $class = 'danger') {
    if (in_array($option, $array) != $inArray) {
        return $class;
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

function _tripRates($rates) {
    $rates = end(explode("@", $rates));
    $rates = trim($rates);
    $rates = $rates . " per hour ";
    return $rates;
}

function _moneyFormat($number) {
    return $number ? "$" . number_format($number) : "$0";
}

function _rateFormat($number) {
    $number = $number ? $number : "0";
    return round($number, 2) . "%";
}

function getTripLatestStatus($tripCode) {
    $return = array("tripstatus" => "UNW", 'statustime' => date("Y-m-d"));
    $data = qs(" select * from tripstatuslogs where tripcode = '{$tripCode}' order  by id desc limit 0,1 ");
    return !empty($data) ? $data : $return;
}

function CheckAitportAddress($address) {
    $add_str = strtolower($address);
    $find_array = array('airport',
        'j f k',
        'jfk',
        'kennedy international airport',
        'jfk terminal',
        'newark liberty international',
        'lga',
        'lax');

    $find_keyword = 0;

    for ($i = 0; $i < count($find_array); $i++) {
        if ($find_keyword == 0) {
            if (strpos($add_str, $find_array[$i]) !== false) {
                $find_keyword = 1;
            }
        }
    }
    return $find_keyword;
}

function GetCityStateFromAddress($string) {
    $string = str_replace(" ", "+", urlencode($string));
    $details_url = "http://maps.googleapis.com/maps/api/geocode/json?address=" . $string . "&sensor=false";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $details_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = json_decode(curl_exec($ch), true);

    // If Status Code is ZERO_RESULTS, OVER_QUERY_LIMIT, REQUEST_DENIED or INVALID_REQUEST
    if ($response['status'] != 'OK') {
        return null;
    }
    $address_format_arr = array();
    if (isset($response['results'][0]['address_components']) && !empty($response['results'][0]['address_components'])) {
        $address_component = $response['results'][0]['address_components'];
        foreach ($address_component as $each_component):
            //d($each_component);
            if (!empty($each_component['types']) != '') {
                $allow_component = array("administrative_area_level_1", "country", "locality", "postal_code", "sublocality_level_1");

                if (in_array($each_component['types'][0], $allow_component)) {
                    if ($each_component['types'][0] == 'locality') {
                        $address_format_arr['city'] = $each_component['long_name'];
                    } elseif ($each_component['types'][0] == 'administrative_area_level_1') {
                        $address_format_arr['state'] = $each_component['short_name'];
                    } elseif ($each_component['types'][0] == 'country') {
                        $address_format_arr['country'] = $each_component['short_name'];
                    } elseif ($each_component['types'][0] == 'postal_code') {
                        $address_format_arr['zipcode'] = $each_component['short_name'];
                    } elseif ($each_component['types'][0] == 'sublocality_level_1') {
                        $address_format_arr['city_sub'] = $each_component['long_name'];
                    }
                }
            }
        endforeach;
    }
    return $address_format_arr;
}
function last10Char($str){
    $str_new =  str_replace(array("+","(",")"," ","-"),"",$str);
    return substr($str_new,-10);
    
}
function removeCellFormat($str){
    $str_new =  str_replace(array("+","(",")"," ","-"),"",$str);
    return $str_new;
    
}
function ac_tag_generate($tag){
    return "pd_".str_replace(" ", "_", strtolower($tag));
}

?>