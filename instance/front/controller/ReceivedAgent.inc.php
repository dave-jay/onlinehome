<?php

$agent_numbers = $_REQUEST['agent_numbers'];
$dealId = _e($_REQUEST['dealId'], '0');
$phone_value = urlencode($_REQUEST['phone_value']);
$cur_agent = $_REQUEST['cur_agent'];

$status = qs("select * from deal_sid where status = 'A' and deal_id = '{$dealId}'  ");
if(count($status) > 0 ){
	echo "call is already accepted \r\n";
	echo 'do nothing';
	die;
}

qu("deal_sid", array("status" => 'A'), "sid='" . $_REQUEST['CallSid'] . "'");

$account_sid = ACCOUNT_SID;
$auth_token = AUTH_TOKEN;
include _PATH . "/Services/Twilio.php";
$client = new Services_Twilio($account_sid, $auth_token);

// call first
$url = _U."DialingCustomer?";
try {
    $params = ("agent_numbers=" . $agent_numbers . "&dealId=" . $dealId . "&phone_value=" . $phone_value . "&cur_agent=" . $cur_agent);
    $url = $url . $params;
    $call = $client->account->calls->get($_REQUEST['CallSid']);
    $call->update(array(
        "Url" => $url,
        "Method" => "POST"
    ));
	 echo $call->to;

} catch (Exception $e) {
    // Failed calls will throw
    echo $e;
    die;
}
$data = q("select * from deal_sid where deal_id='{$dealId}' AND sid!='{$_REQUEST['CallSid']}'");
qu("deal_sid", array("status" => 'R'), "deal_id='{$dealId}' AND sid !='{$_REQUEST['CallSid']}'");

if (count($data) > 0) {
	foreach ($data as $each_data) {
		echo "hanging up {$each_data['sid']} <br />\r\n";
		sleep(1);
		$status = qs("select * from deal_sid where sid = '{$each_data['sid']}' ");
		d($status);
		
		if($status != 'A'){
			$call = $client->account->calls->get($each_data['sid']);
			$call->update(array(
				"Status" => "completed"
			));
			echo $each_data['sid'] . "<br>";
		}
	}
}else{
	echo 'nothing to hangup';
}
    
   
die;
?>