<?php
if($_REQUEST['syncUser']){
    include _PATH.'instance/front/controller/schedulerGetDealUsers.inc.php';
    die;
}
if($_REQUEST['updateUser']){
    $agents = q("select * From pd_users order by name asc ");
    include _PATH.'instance/front/tpl/agents_data.php';
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

$agents = q("select * From pd_users order by name asc ");

_cg("page_title", "Pipedrive Agents List");
$jsInclude = "agents.js.php";
