<?php
$agent_numbers = $_SESSION['REQUEST']['agent_numbers'];
$dealId = _e($_SESSION['REQUEST']['dealId'], '0');
$phone_value = urlencode($_SESSION['REQUEST']['phone_value']);
$cur_agent = $_SESSION['REQUEST']['cur_agent'];
if (!isset($_REQUEST['Digits']) || $_REQUEST['Digits'] == ""):
    qd("deal_sid", "deal_id='{$dealId}'");
    $old_agent_numbers = explode(",", $agent_numbers);
    $new_agent_numbers = array();
    foreach ($old_agent_numbers as $each_agents) {
        if ($cur_agent != $each_agents) {
            $new_agent_numbers[] = $each_agents;
        }
    }
    if (count($new_agent_numbers) > 0) {
        $apiCall = new apiCall();
        $apiCall->doBroadcast($phone_value, $new_agent_numbers, $dealId);
        die;
    } else {
        header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    ?>

    <Response><Say>You had not press any key. We have no other agents to call!</Say></Response>
<?php
        die;
    } 
elseif ($_REQUEST['Digits'] == 1):
    $account_sid = ACCOUNT_SID;
    $auth_token = AUTH_TOKEN;
    include _PATH . "/Services/Twilio.php";
    $client = new Services_Twilio($account_sid, $auth_token);

    $url = _U . "DialingCustomer?";
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
elseif ($_REQUEST['Digits'] == 2):
    $apiPD = new apiPipeDrive();
    //$deal_data = $apiPD->getDealInfo($dealId); //$deal_data = $apiPD->getDealInfo('5232'); //Test Mode
    $deal_data = $apiPD->getDealInfo('5232');
    $deal_data = json_decode($deal_data);
    $agent_name = ($deal_data->data->user_id->name);
    $deal_amount = ($deal_data->data->value);
    $deal_currency = ($deal_data->data->currency);
    $organization = ($deal_data->data->org_name);
    $Person = ($deal_data->data->person_name);
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    ?>

    <Response>        
        <Gather timeout="5" action="<?= _U; ?>ConnectingCustomer" method="GET" numDigits="1">
            <Say>Hey  <?= $agent_name; ?>, You  have received  Incoming  Lead. 
                The Name  of  person  is  <?= $Person; ?> from  Organization  <?= $organization ?>. 
                Requires Loan  Of  <?= $deal_amount; ?> <?= $deal_currency; ?>. </Say>
            <Say>Press 1 to continue.  Press 2 to Repeat.  Press any other key to hangup</Say>
        </Gather>
        <Redirect method="POST"><?= _U . "ConnectingCustomer"; ?></Redirect>
    </Response>
    <?php
else:
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    ?>

    <Response><Say>Good Buy!</Say></Response>
<?php
endif;
die;
?>