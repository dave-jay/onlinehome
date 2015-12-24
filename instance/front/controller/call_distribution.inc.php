<?php

/**
 * Admin side Login file
 * 
 * 

 * @version 1.0
 * @package lysoft
 * 
 */
$urlArgs = _cg("url_vars");

if (isset($_REQUEST['update_call']) && $_REQUEST['update_call'] == 1) {
    $user_list_update = Call_distribution::AllLeadSorceNull(); //First Null the Call List
    if (isset($_REQUEST['fields']) && $_REQUEST['fields'] != '') {
        if (isset($_REQUEST['fields']['call']) && count($_REQUEST['fields']['call']) > 0) {
            $call_list = $_REQUEST['fields']['call'];
            foreach ($call_list as $source_id => $each_call):
                if (isset($each_call) && count($each_call) > 0) {
                    $json_user_list = '';
                    $user_list = array();
                    foreach ($each_call as $user_id => $each_user):
                        $user_list[] = $user_id;
                    endforeach;

                    /* Conver array to json format */
                    if (!empty($user_list) && count($user_list) > 0) {
                        $json_user_list = json_encode($user_list);
                    }

                    /* list update if data not null */
                    if ($json_user_list != '') {
                        unset($fields);
                        $check_source_id = 0;
                        $check_source_id = Call_distribution::CheckSourceID($source_id);
                        if ($check_source_id > 0) {
                            $fields["pd_user_id"] = $json_user_list;
                            $user_list_update = qu("call_list_by_source", $fields, " pd_source_id = '{$source_id}'");
                        } else {
                            $user_list_insert = 0;
                            $fields["pd_source_id"] = $source_id;
                            $fields["pd_user_id"] = $json_user_list;
                            $user_list_insert = qi("call_list_by_source", $fields);
                        }
                    }
                }
            endforeach;
        }
    }
    $_SESSION['greetings_msg'] = "Call Distribution Has Been Updated";
}

$source_list = Call_distribution::getSourceList();
$user_list = Call_distribution::getUserList();

_cg("page_title", "Call Distribution");
$jsInclude = "call_distribution.js.php";
?>