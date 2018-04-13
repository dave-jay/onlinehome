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

if (isset($_REQUEST['edit_agent']) && trim($_REQUEST['edit_agent']) == '1') {

    $deal_nm_arr = array();
    $deal_nm = '';
    $deal_nm_arr = qs("SELECT * FROM pd_sources WHERE id = '" . $_REQUEST["deal_id"] . "'");
    $deal_nm = $deal_nm_arr["source_name"];
    $res_arr = array();
    $res_arr['deal_nm'] = $deal_nm;
    ob_start();
    include 'call_distribution_select_agent_ui.inc.php';
    $selection_content = ob_get_contents();
    ob_end_clean();
    $res_arr['selection_content'] = $selection_content;
    json_die(true, $res_arr);
    die;
}

if (isset($_REQUEST['update_call']) && $_REQUEST['update_call'] == 1) {
    //$user_list_update = Call_distribution::AllLeadSorceNull(); //First Null the Call List

    $json_user_list = '';
    $user_list = array();
    if (isset($_REQUEST["user_list"]) && $_REQUEST["user_list"] != '') {
        $user_list = $_REQUEST["user_list"];
    }

    // Conver array to json format //
    if (!empty($user_list) && count($user_list) > 0) {
        $json_user_list = json_encode($user_list);
    }
    $source_pk_id = '';
    $source_pk_id = trim($_REQUEST["source_pk_id"]);
    $source_id_arr = array();
    $source_id_arr = qs("SELECT * FROM pd_sources WHERE id = '{$source_pk_id}'");
    $source_id = '';
    $source_id = $source_id_arr["pd_source_id"];

    if (1 == 1) {
        unset($fields);
        $check_source_id = 0;
        $check_source_id = Call_distribution::CheckSourceID($source_id);
        if ($check_source_id > 0) {
            $fields["pd_user_id"] = $json_user_list;
            $user_list_update = qu("call_list_by_source", $fields, " pd_source_id = '{$source_id}' AND  tenant_id='{$_SESSION['user']['tenant_id']}'");

            $user_list_update = 1;
        } else {
            $user_list_insert = 0;
            $fields["tenant_id"] = $_SESSION['user']['tenant_id'];
            $fields["pd_source_id"] = $source_id;
            $fields["pd_user_id"] = $json_user_list;
            $user_list_insert = qi("call_list_by_source", $fields);
        }
    }
    //$_SESSION['greetings_msg'] = "Call Distribution Has Been Updated";
    echo "1";
    die;
}
if ($_REQUEST['syncSources']) {
    $GLOBALS['tenant_id'] = $_SESSION['user']['tenant_id'];
    include _PATH.'instance/front/controller/define_settings.inc.php';
    $apiPD = new apiPipeDrive($conf_data['PIPEDRIVER_API_KEY']);
    $data = $apiPD->getAllDealFields();
    $data = json_decode($data,true);
    foreach($data['data'] as $each){
        if($each['key']==$conf_data['PIPEDRIVE_SOURCE']){
            foreach($each['options'] as $each_option){
                $existing = qs("select * from pd_sources where tenant_id='{$GLOBALS['tenant_id']}' AND pd_source_id='{$each_option['id']}'");
                $pd_source_new['tenant_id'] = $GLOBALS['tenant_id'];
                $pd_source_new['pd_source_id'] = $each_option['id'];
                $pd_source_new['source_name'] = $each_option['label'];
                $pd_source_new['is_deleted'] = '0';
                if(empty($existing)){
                    qi("pd_sources",  _escapeArray($pd_source_new));
                }else{
                    qu("pd_sources",  _escapeArray($pd_source_new),"id='{$existing['id']}'");
                }
            }
        }
    }
    $source_list = Call_distribution::getSourceList();
    $user_list = Call_distribution::getUserList();
    include _PATH . 'instance/front/tpl/call_distribution_data.php';
    die;
}
if ($_REQUEST['AddtoActive']) {
    qu("pd_sources", array("is_active" => "1"), "id='{$_REQUEST['source_id']}'");
    $source_list = Call_distribution::getSourceList();
    $user_list = Call_distribution::getUserList();
    include _PATH . 'instance/front/tpl/call_distribution_data.php';
    die;
}
if ($_REQUEST['RemoveFromActive']) {
    qu("pd_sources", array("is_active" => "0"), "id='{$_REQUEST['source_id']}'");
    $source_list = Call_distribution::getSourceList();
    $user_list = Call_distribution::getUserList();
    include _PATH . 'instance/front/tpl/call_distribution_data.php';
    die;
}

$source_list = Call_distribution::getSourceList();
$user_list = Call_distribution::getUserList();

_cg("page_title", "Call Distribution");
$jsInclude = "call_distribution.js.php";
?>