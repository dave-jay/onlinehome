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

include "lib/utils.php"; # includes general function
//include "lib/utils_checklist.php";
_getInstance($_REQUEST['q']);
$instance = _cg("instance");

$host = $_SERVER['HTTP_HOST'];

define('_UPlain', "http://" . $host . substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/') + 1));
if (_cg("url_instance") != '') {
    define('_U', "http://" . $host . substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/') + 1) . _cg("url_instance") . "/");
} else {
    define('_U', "http://" . $host . substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], '/') + 1));
}
define("_MEDIA_URL", _UPlain . "instance/{$instance}/media/");

$db = Db::__d();

include _PATH . "instance/{$instance}/config.inc.php";

$url = _cg("url"); // set from _getInstance function
define(_URL, $url);

define("ACCOUNT_SID","ACaa30ea6de17c65f4407de5a34cbe1efa");
define("AUTH_TOKEN","02866ddbbb04c3bea0551ded9f017db9");        

$modulePage = $url . ".php";
@include _PATH . "instance/{$instance}/controller/{$url}.inc.php";

include _PATH . "instance/{$instance}/tpl/index.tpl.php";
?>