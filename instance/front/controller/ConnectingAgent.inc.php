<?php
    //$agent_numbers = explode(',', $_REQUEST['agent_numbers']);
    //$dealId = $_REQUEST['dealId'];
    $agent_numbers = explode(',', $_SESSION['agent_numbers']);
    $dealId = $_SESSION['dealId'];
    
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
        <?php foreach($agent_numbers as $key => $value): ?>
        <Number url="http://s606346885.onlinehome.us/AgentCallLog/<?php print $value; ?>/<?php print $dealId; ?>">+<?php print $value; ?></Number>
        <?php endforeach; ?>
    </Dial>
    <Say>The call failed or the remote party hung up. Goodbye.</Say>
</Response>
<?php die; ?>