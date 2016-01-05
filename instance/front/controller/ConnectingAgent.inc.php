<?php

    $agent_numbers = explode(',', $_REQUEST['agent_numbers']);
    $dealId = _e($_REQUEST['dealId'],0);;
    $phone_value = $_REQUEST['phone_value'];
    $cur_agent = $_REQUEST['cur_agent'];
    $data = qs("select * from deal_sid where deal_id='{$dealId}'");
    if(count($data)>0){
        die("call handled");
    }else{
        qi("deal_sid",array("deal_id"=>$dealId,"sid"=>$_REQUEST['CallSid']));
    }
    
    //$agent_numbers = explode(',', $_SESSION['agent_numbers']);
    //$dealId = $_SESSION['dealId'];
    
    // if the caller pressed anything but 1 send them back
    //if($_REQUEST['Digits'] != '1') {
    //    header("Location: http://s606346885.onlinehome.us/test_dial4");
        //header("Location: http://localhost/twilio-call-text/test_dial4");
    //    die;
    //}
    
    // the user pressed 1, connect the call to 310-555-1212 
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    // <Dial>+18774942065</Dial>
?>
<Response>
    <Dial>
        <Number url="http://s606346885.onlinehome.us/AgentCallLog/<?php print $cur_agent; ?>/<?php print $dealId; ?>/<?php print $phone_value; ?>/<?php print $cur_agent; ?>"><?php print $phone_value; ?></Number>
    </Dial>
    <Say>The call failed or the remote party hung up. Goodbye.</Say>
</Response><?php die; ?>