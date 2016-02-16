<?php
//_errors_on();
$dealId="5232";
$apiPD = new apiPipeDrive();
$deal_data = $apiPD->getDealInfo($dealId);
$deal_data = json_decode($deal_data);
$deal_amount = number_format($deal_data->data->value,2);
$deal_amount = $deal_amount.' '.$deal_data->data->currency;
$organization = $deal_data->data->org_name;
$customer_name = $deal_data->data->person_name;
ob_start();
$mail_heading = "Missed Customer Call";

$customer_phone="919737128291";


include _PATH."instance/front/tpl/missed_call_mail_template.php";
$content = ob_get_contents();

ob_end_clean();
echo $content;
//_phpmail("testoperators@gmail.com", "Test Mail", "Hi<br><br><br><br>How Are You?");
//_mail("testoperators@gmail.com", "Test Mail", "Hi<br>How Are You?");
echo "Mail Sent";
die;
?>