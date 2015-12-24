<?php
 
    // if the caller pressed anything but 1 send them back
    if($_REQUEST['Digits'] != '1') {
        header("Location: http://s606346885.onlinehome.us/test_dial4");
        die;
    }
     
    // the user pressed 1, connect the call to 310-555-1212 
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    // <Dial>+18774942065</Dial>
?>
<Response>
    <Dial>
        <Number>+18774942065</Number>
        <Number>+18664632339</Number>
        <Number>+18009614454</Number>
    </Dial>
    <Say>The call failed or the remote party hung up. Goodbye.</Say>
</Response>
<?php die; ?>