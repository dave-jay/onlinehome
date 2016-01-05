<?php
_errors_on();

die;
$apiPD = new apiPipeDrive();
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

