<?php

	// just add an entry - for deal id and call sid
	// to later hang the call
	// when the other agent picks up the code
    if($_REQUEST['CallStatus']=='no-answer' || $_REQUEST['CallStatus']=='busy'){
        header("content-type: text/xml");
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";        
        qu("voice_call", array("in_progress" => "0"), "deal_id='" . $_REQUEST['dealId'] . "'"); //Set in_progress=0 because call process is completed
        echo "<Response><say>Call Status - {$_REQUEST['CallStatus']}</say></Response>";
        die;
    }else if($_REQUEST['CallStatus']=='ringing'){
    
    $agent_numbers = explode(',', $_REQUEST['agent_numbers']);
	$rand = mt_rand(1,1000) . "_" . mt_rand(1,1000); // for testing - the deal id should be random
    $dealId = _e($_REQUEST['dealId'],"T{$rand}");
    $phone_value = urlencode($_REQUEST['phone_value']);
    $cur_agent = $_REQUEST['cur_agent'];
    qi("deal_sid",array("deal_id"=>$dealId,"sid"=>$_REQUEST['CallSid']));    

    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    echo "<Response><say>Connecting to customer!</say></Response>";

    }else{
        header("content-type: text/xml");
        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        echo "<Response><say>Good Bye</say></Response>";
    }
die; ?>