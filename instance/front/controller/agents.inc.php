<?php
if($_REQUEST['syncUser']){
    include _PATH.'instance/front/controller/schedulerGetDealUsers.inc.php';
    die;
}
if($_REQUEST['updateUser']){
    $agents = q("select * From pd_users where is_active='1' order by name asc ");
    include _PATH.'instance/front/tpl/agents_data.php';
    die;
}
if ($_REQUEST['doUpdateContact']) {
    $agent_id = _escape($_REQUEST['doUpdateContact']);
    $phone = _escape(trim($_REQUEST['phone']));
    $cell = _escape(trim($_REQUEST['cell']));
    $affected_row = -1;
    if ($phone || $cell) {
        $affected_row = qu('pd_users', array("phone" => $phone,"cell" => $cell), " id = '{$agent_id}'  ");
    }else{
        $affected_row=0;
    }
    echo $affected_row;
    die;
}
if ($_REQUEST['doUpdateAgent']) {
    $agent_id = _escape($_REQUEST['doUpdateAgent']);
    $value = _escape($_REQUEST['value']);

    if ($value) {
        qu('pd_users', array("phone" => $value), " id = '{$agent_id}'  ");
    }
    die;
}
if ($_REQUEST['doUpdateAgentCell']) {
    $agent_id = _escape($_REQUEST['doUpdateAgentCell']);
    $value = _escape($_REQUEST['value']);

    if ($value) {
        qu('pd_users', array("cell" => $value), " id = '{$agent_id}'  ");
    }
    die;
}

$agents = q("select * From pd_users where is_active='1' order by name asc ");

_cg("page_title", "Pipedrive Agents List");
$jsInclude = "agents.js.php";
