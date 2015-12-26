<?php
 
    // make an associative array of callers we know, indexed by phone number
    $people = array(
        "+14158675309"=>"Curious George",
        "+14158675310"=>"Boots",
        "+14158675311"=>"Virgil",
        "+13234733078"=>"Dave Jay",
        "+14158675312"=>"Marcel"
    );
     
    // if the caller is known, then greet them by name
    // otherwise, consider them just another monkey
    if(!$name = $people[$_REQUEST['From']])
        $name = "Test User";
         
    // now greet the caller
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    //<Play>http://demo.twilio.com/hellomonkey/monkey.mp3</Play>
?>
<Response>
    <Say>Hello <?php echo $name ?>.</Say>
    
    <Gather numDigits="1" action="test_dial3" method="POST">
        <Say>To speak to a real person, press 1.  Press any other key to start over.</Say>
    </Gather>
</Response>
<?php die; ?>