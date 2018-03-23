<?php

$GLOBALS['tenant_id'] = $_SESSION['REQUEST']['tenant_id'];
include _PATH.'instance/front/controller/define_settings.inc.php';

$agent_numbers = $_SESSION['REQUEST']['agent_numbers'];
$dealId = _e($_SESSION['REQUEST']['dealId'], '0');
$phone_value = urlencode($_SESSION['REQUEST']['phone_value']);
$cur_agent = $_SESSION['REQUEST']['cur_agent'];
if (!isset($_REQUEST['Digits']) || $_REQUEST['Digits'] == ""):    
    qu("voice_call", array("in_progress" => "0"), "tenant_id='".$GLOBALS['tenant_id']."' AND deal_id='" . $dealId . "'"); //Set in_progress=0 because call process is completed
    $old_agent_numbers = explode(",", $agent_numbers);
    $new_agent_numbers = array();
    foreach ($old_agent_numbers as $each_agents) {
        if ($cur_agent != $each_agents) {
            $new_agent_numbers[] = $each_agents;
        }
    }
    $voice_call_count = q("select * from voice_call where tenant_id='".$GLOBALS['tenant_id']."' AND deal_id='{$dealId}' and curr_agent='{$cur_agent}'");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    if(count($voice_call_count)>2){
        ?>
        <Response><Say>sorry, You had not press any key. Good Bye!</Say></Response>
            <?php
            qi("voice_call",array("tenant_id"=>$GLOBALS['tenant_id'],"deal_id"=>$dealId,"is_handled"=>"0","curr_agent"=>$cur_agent,"all_agents"=>$agent_numbers,"customer_phone"=>$phone_value));
        $agent_name = 'agent';
        $agent_detail = qs("select * from pd_users where tenant_id='".$GLOBALS['tenant_id']."' AND phone like '%" . $cur_agent . "%'");
        if (isset($agent_detail)) {
            $agent_name = $agent_detail['name'];
        }
        $message = '<b>Note: </b><br>Call went into voicemail of <b>' . $agent_name . "</b>. System will call again in <b>10 minutes</b>.";
        sendNote($dealId,$message,$conf_data['PIPEDRIVER_API_KEY']);        
        die;
    }
    else if (count($new_agent_numbers) > 0) {
        ?>
        <Response><Say>sorry, You had not press any key. Good Bye!</Say></Response>
        <?php
        //qd("deal_sid", "deal_id='{$dealId}'");
        qi("voice_call",array("tenant_id"=>$GLOBALS['tenant_id'],"deal_id"=>$dealId,"is_handled"=>"0","curr_agent"=>$cur_agent,"all_agents"=>$agent_numbers,"customer_phone"=>$phone_value));
        $agent_name = 'agent';
        $agent_detail = qs("select * from pd_users where tenant_id='".$GLOBALS['tenant_id']."' AND phone like '%" . $cur_agent . "%'");
        if (isset($agent_detail)) {
            $agent_name = $agent_detail['name'];
        }
        $message = '<b>Note: </b><br>Call went into voicemail of <b>' . $agent_name . "</b>. System will call again in <b>10 minutes</b>.";
        sendNote($dealId,$message,$conf_data['PIPEDRIVER_API_KEY']);
        die;
    } else {
        qi("voice_call",array("tenant_id"=>$GLOBALS['tenant_id'],"deal_id"=>$dealId,"is_handled"=>"0","curr_agent"=>$cur_agent,"all_agents"=>$agent_numbers,"customer_phone"=>$phone_value));
        header("content-type: text/xml");
    ?>

    <Response><Say>You had not press any key. We have no other agents to call!</Say></Response>
<?php
        $agent_name = 'agent';
        $agent_detail = qs("select * from pd_users where tenant_id='".$GLOBALS['tenant_id']."' AND phone like '%" . $cur_agent . "%'");
        if (isset($agent_detail)) {
            $agent_name = $agent_detail['name'];
        }
        $message = '<b>Note: </b><br>Call went into voicemail of <b>' . $agent_name . "</b>. System will call again in <b>10 minutes</b>.";
        sendNote($dealId,$message,$conf_data['PIPEDRIVER_API_KEY']);
        die;
    } 
elseif ($_REQUEST['Digits'] == 1):
    qu("voice_call", array("in_progress" => "0"), "tenant_id='".$GLOBALS['tenant_id']."' AND deal_id='" . $dealId . "'"); //Set in_progress=0 because call process is completed
    $agent_call_dialed_data = qs("select id from agent_call_dialed where tenant_id='".$GLOBALS['tenant_id']."' AND deal_id='{$dealId}' order by id desc");
    qu("agent_call_dialed",  _escapeArray(array("received_agent"=>$cur_agent,"is_received"=>"1")),"id='".$agent_call_dialed_data['id']."'");
    $account_sid = $GLOBALS['ACCOUNT_SID'];
    $auth_token = $GLOBALS['AUTH_TOKEN'];
    include _PATH . "/Services/Twilio.php";
    $client = new Services_Twilio($account_sid, $auth_token);

    $url = _U . "DialingCustomer?";
    try {
        $params = ("tenant_id=" . $GLOBALS['tenant_id'] . "&agent_numbers=" . $agent_numbers . "&dealId=" . $dealId . "&phone_value=" . $phone_value . "&cur_agent=" . $cur_agent);
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
    $apiPD = new apiPipeDrive($conf_data['PIPEDRIVER_API_KEY']);
    $deal_data = $apiPD->getDealInfo($dealId); //$deal_data = $apiPD->getDealInfo('5232'); //Test Mode
    //$deal_data = $apiPD->getDealInfo('5232');
    $deal_data = json_decode($deal_data);
    //$agent_name = ($deal_data->data->user_id->name);
    $deal_amount = str_replace('&', ' and ', ($deal_data->data->value));
    $deal_currency = str_replace('&', ' and ', ($deal_data->data->currency));
    $organization = str_replace('&', ' and ', ($deal_data->data->org_name));
    $Person = ($deal_data->data->person_name);
    
    $agent_name = '';
    $agent_detail = qs("select * from pd_users where tenant_id='".$GLOBALS['tenant_id']."' AND phone like '%".$cur_agent."%'");
    if(isset($agent_detail)){
        $agent_name = $agent_detail['name'];
    }

    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    ?>

    <Response>        
        <Gather timeout="10" action="<?= _U; ?>ConnectingCustomer" method="GET" numDigits="1">
            <Say>Hey  <?= $agent_name; ?>, You  have received  Incoming  Lead. 
                The Name  of  person  is  <?= $Person; ?> from  Organization  <?= $organization ?>. 
                Requires Loan  Of  <?= $deal_amount; ?> <?= $deal_currency; ?>. </Say>
            <Say>Press 1 to continue.  Press 2 to Repeat.  Press any other key to hangup</Say>
        </Gather>
        <Gather timeout="5" action="<?= _U; ?>ConnectingCustomer" method="GET" numDigits="1">        
        <Say>You had not press any key.</Say>
        <Say>Please Press 1 to continue.  Press 2 to Repeat.  Press any other key to hangup</Say>	
    </Gather>
        <Redirect method="POST"><?= _U . "ConnectingCustomer"; ?></Redirect>
    </Response>
    <?php
else:
    qu("voice_call", array("in_progress" => "0"), "tenant_id='".$GLOBALS['tenant_id']."' AND deal_id='" . $dealId . "'"); //Set in_progress=0 because call process is completed
    qi("voice_call",array("tenant_id"=>$GLOBALS['tenant_id'],"deal_id"=>$dealId,"is_handled"=>"0","curr_agent"=>$cur_agent,"all_agents"=>$agent_numbers,"customer_phone"=>$phone_value));
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    ?>

    <Response><Say>Good Buy!</Say></Response>    
<?php
    $agent_name = 'agent';
    $agent_detail = qs("select * from pd_users where tenant_id='".$GLOBALS['tenant_id']."' AND phone like '%" . $cur_agent . "%'");
    if (isset($agent_detail)) {
        $agent_name = $agent_detail['name'];
    }
    $message = '<b>Note: </b><br>Call went into voicemail of <b>' . $agent_name . "</b>. System will call again in <b>10 minutes</b>.";
    sendNote($dealId,$message,$conf_data['PIPEDRIVER_API_KEY']);
endif;
die;

function sendNote($deal_id, $message,$pipedrive_api_key) {
    $apiPD = new apiPipeDrive($pipedrive_api_key);
    $data['deal_id'] = $deal_id;
    $data['content'] = $message;
    $data = $apiPD->createNote($data);
}
?>