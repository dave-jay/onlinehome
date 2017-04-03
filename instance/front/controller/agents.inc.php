<?php

if ($_REQUEST['syncUser']) {
    include _PATH . 'instance/front/controller/schedulerGetDealUsers.inc.php';
    die;
}
if ($_REQUEST['MarkAsDefault']) {
    qu("pd_users", array("is_default" => 0), "1=1");
    qu("pd_users", array("is_default" => 1), "id='{$_REQUEST['user_id']}'");
    $agents = q("select * From pd_users where is_active='1' order by name asc ");
    include _PATH . 'instance/front/tpl/agents_data.php';
    die;
}
if ($_REQUEST['RemoceFromDefault']) {
    qu("pd_users", array("is_default" => 0), "id='{$_REQUEST['user_id']}'");
    $agents = q("select * From pd_users where is_active='1' order by name asc ");
    include _PATH . 'instance/front/tpl/agents_data.php';
    die;
}
if ($_REQUEST['updateUser']) {
    $agents = q("select * From pd_users where is_active='1' order by name asc ");
    include _PATH . 'instance/front/tpl/agents_data.php';
    die;
}
if ($_REQUEST['doUpdateContact']) {
    $agent_id = _escape($_REQUEST['doUpdateContact']);
   
    $phone = _escape(trim($_REQUEST['phone']));
    $cell = _escape(trim($_REQUEST['cell']));
    $role = _escape(trim($_REQUEST['role']));
    $linkdin = _escape(trim($_REQUEST['linkdin']));
    $group = _escape(trim($_REQUEST['group']));
//     d($linkdin);
//    die;
    $affected_row = -1;
    /* if ($phone || $cell) {
      $affected_row = qu('pd_users', array("phone" => $phone,"cell" => $cell,"group" => $group), " id = '{$agent_id}'  ");
      }else{
      $affected_row=0;
      } */
    $affected_row = qu('pd_users', array("phone" => $phone, "cell" => $cell,"password" => $_REQUEST['pass'], "group" => $group, "role" => $role, "linkedin_link" => $linkdin), " id = '{$agent_id}'  ");
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
