<?php
if(isset($_REQUEST['click_to_call']) && $_REQUEST['click_to_call']==1){
    $fields['deal_id'] = $_REQUEST['dealId'];
    $fields['agent_phone'] = removeCellFormat($_REQUEST['agent_phone']);
    $fields['agent_name'] = $_REQUEST['agent_name'];
    $fields['customer_phone'] = removeCellFormat($_REQUEST['customer_phone']);
    $click_to_call_id = qi("click_to_call",$fields);
    
    $callWebhook = new callWebhook();
    $sid = $callWebhook->click_to_call($click_to_call_id);
    
    $data = array("id"=>$click_to_call_id,"sid"=>$sid);
    json_die(true,$data);
}
$dealId = $_REQUEST['dealId'];
$phone_count = $_REQUEST['phone_count'];
$contact_list = array();
$is_cust_number = 0;
for ($index = 1; $index <= $phone_count; $index++) {
    $is_cust_number = 1;
    $contact_list[] = removeCellFormat($_REQUEST['phone_' . $index]);
}


$conversation_list = q("select * from text_conversation where deal_id='{$dealId}' order by messageTime asc");
$agent_name = $_REQUEST['agent_name'];
$agent = qs("select * from pd_users where name='{$agent_name}'");
if(empty($agent) || ($agent['phone']=='' && $agent['cell']=='')){
    $is_agent_number = 0;
}else{
    $is_agent_number = 1;
    $agent_no = ($agent['phone']==''?$agent['cell']:$agent['phone']);
    $agent_no = formatCellDash($agent_no);
}
$no_visible_elements = TRUE;
_cg("page_title", "Conversation");
$jsInclude = "click_to_call.js.php";
?>