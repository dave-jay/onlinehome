<?php
    $agent_numbers = $_REQUEST['agent_numbers'];
    $dealId = $_REQUEST['dealId'];
    $_SESSION['agent_numbers'] = $agent_numbers;
    $_SESSION['dealId'] = $dealId;
    
    
    $name = 'Guest';
    // now greet the caller
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    //<Play>http://demo.twilio.com/hellomonkey/monkey.mp3</Play>
?>
<Response>
    <Say>Hello <?php echo $name ?>.</Say>
    
    <Gather numDigits="1" action='<?php print "http://s606346885.onlinehome.us/ConnectingAgent"; ?>' method="POST">
        <Say>To speak to a real person, press 1.  Press any other key to start over.</Say>
    </Gather>
</Response>
<?php die; ?>