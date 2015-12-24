<?php
 
     
    // the user pressed 1, connect the call to 310-555-1212 
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    // <Dial>+18774942065</Dial>
?>
<Response>
    <Say>Goodbye, Have Nice Day!</Say>
</Response>
<?php die; ?>