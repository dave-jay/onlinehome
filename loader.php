<?php

/**
 * Loader file.
 * Includes libraries
 * Inititaes controller + view
 * 
 * 

 * @version 1.0
 * @package LySoft
 * 
 */
define("_PATH", str_replace("loader.php", "", __FILE__));

function __autoload($class_name) {
    include_once(_PATH . 'lib/' . $class_name . '.class.php');
}
date_default_timezone_set("America/New_York");

include "lib/utils.php"; # includes general function
//include "lib/utils_checklist.php";
_getInstance($_REQUEST['q']);
$instance = _cg("instance");

$host = $_SERVER['HTTP_HOST'];
$http_protocol = $_SERVER['HTTPS'] == "on" ? "https://" : "http://";

define('_UPlain', $http_protocol . $host . substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/') + 1));
if (_cg("url_instance") != '') {
    define('_U', $http_protocol . $host . substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/') + 1) . _cg("url_instance") . "/");
} else {
    define('_U', $http_protocol . $host . substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/') + 1));
}
define("_MEDIA_URL", _UPlain . "instance/{$instance}/media/");

$db = Db::__d();

include _PATH . "instance/{$instance}/config.inc.php";

$url = _cg("url"); // set from _getInstance function
define(_URL, $url);

define("ACCOUNT_SID","AC0ed3b59448346c77c722e15188fecf31");
define("AUTH_TOKEN","aedd61ecc2b3c9c858aac794197727b7");
define("TWILIO_PHONE_NUMBER","+15162102005");
define("TWILIO_PHONE_NUMBER2","+15162102048");

$modulePage = $url . ".php";
@include _PATH . "instance/{$instance}/controller/{$url}.inc.php";

include _PATH . "instance/{$instance}/tpl/index.tpl.php";
?>