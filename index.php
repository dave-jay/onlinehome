<?php

/**
 * Main Index File...
 * 
 * App is single point entry
 * 
 * Assigns constant vars
 * 
 * 

 * @version 1.0
 * @package LySoft
 * 
 */
session_start();
error_reporting(0);

# DB informaitons
define('DB_HOST', 'localhost');
define('DB_PASSWORD', '');
define('DB_UNAME', 'root');
define('DB_NAME', 'lysoft');

define('IS_DEV_ENV', TRUE);
define('FOLDER_RUN',''); // when you are want to test in dev folder changed to 'dev/' and in live server changed to 'admin/'

$stage_mapping_arr[28] = array("pd_stage_id"=>28,"ac_list_id"=>1);
$stage_mapping_arr[1] = array("pd_stage_id"=>1,"ac_list_id"=>2);
$stage_mapping_arr[2] = array("pd_stage_id"=>2,"ac_list_id"=>3);
$stage_mapping_arr[3] = array("pd_stage_id"=>3,"ac_list_id"=>4);
$stage_mapping_arr[9] = array("pd_stage_id"=>9,"ac_list_id"=>5);
$stage_mapping_arr[4] = array("pd_stage_id"=>4,"ac_list_id"=>6);
$stage_mapping_arr[6] = array("pd_stage_id"=>6,"ac_list_id"=>7);
$stage_mapping_arr[7] = array("pd_stage_id"=>7,"ac_list_id"=>8);
$stage_mapping_arr[8] = array("pd_stage_id"=>8,"ac_list_id"=>9);
$stage_mapping_arr[5] = array("pd_stage_id"=>5,"ac_list_id"=>10);
define('STAGE_MAPPING', json_encode($stage_mapping_arr));
include "config.php";
include "loader.php";
?>
