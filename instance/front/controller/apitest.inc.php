<?php
$apiPD = new apiPipeDrive();
//$deal_data = $apiPD->getDealInfo($dealId); //$deal_data = $apiPD->getDealInfo('5232');
$deal_data = $apiPD->getDealInfo('5232');
$deal_data = json_decode($deal_data);
d($deal_data);
die;
$cur_agent = "18006676389";

$old_agent_numbers = "919737128292,18006676389,919737128291";
$old_agent_numbers = explode(",", $old_agent_numbers);
d($old_agent_numbers);
foreach ($old_agent_numbers as $each_agents){
    if($cur_agent != $each_agents){
        $agent_numbers[] = $each_agents;
    }
}
echo "<br>--1<br>";
d($agent_numbers);
echo "<br>--2<br>";
$agent_numbers = implode(",", $agent_numbers);
echo $agent_numbers."<br>";
echo "<br>--3<br>";
$t = array("a","b","c");
d($t);
die;
$apiPD = new apiPipeDrive();
//$deal_data = $apiPD->getDealInfo($dealId); //$deal_data = $apiPD->getDealInfo('5232');
$deal_data = $apiPD->getDealInfo('5232');
$deal_data = json_decode($deal_data);
$deal_amount = ($deal_data->data->value);
$deal_currency = ($deal_data->data->currency);
$organization = ($deal_data->data->org_name);
$Person = ($deal_data->data->person_name);
echo ($Person);
die;
_errors_on();

$apiPD = new apiPipeDrive();
$deal_data = $apiPD->getDealInfo('5232');
$deal_data = json_decode($deal_data);
d($deal_data);

die;
$apiPD->getAgentByDealSource('37');
die;
$person_id_test = '4421';
$apiPD = new apiPipeDrive();
$person_info = $apiPD->getPersonInfo($person_id_test);
$person_info = json_decode($person_info, true);
d($person_info);
die;

$wayne_user_id = '701588';
$dave_user_id = '990918';
$dave_test_deal_id = '4409';

$apiPD = new apiPipeDrive();

//$apiPD->assignDeal($dave_test_deal_id, $dave_user_id); 
$apiPD->assignDeal($dave_test_deal_id, $wayne_user_id); 
$deal_data = $apiPD->getDealInfo('4409');

d(json_decode($deal_data),true);

die;

$data = qs("select * from pd_push_notification_log");
$payload = json_decode($data['payload'], true);
d($payload);

die;


die;
_mail('dave.jay90@gmail.com', 'test', 'Thank you');
?>

