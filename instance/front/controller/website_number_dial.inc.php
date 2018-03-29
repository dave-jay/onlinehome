<?php
//Twilio Website Number: (516) 210-2005
$apiPD = new apiPipeDrive();
$agent_numbers = $apiPD->getAgentByDealSource(37,1);
$fields['from'] = $_REQUEST['From'];
$fields['CallSid'] = $_REQUEST['CallSid'];
$insertId = qi("website_number_dials",  _escapeArray($fields));
header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>

    <?php if (count($agent_numbers) == 0): ?>
        <Say>Thank you for calling leadpropel.com</Say>
        <Say>Sorry, All agents are busy at the moment.</Say>
        <Say>We will call back later.</Say>
        <Say>Thank you</Say>
    <?php else: ?>
        <Dial action="<?= _U."website_number_dial_status?params=".$insertId."--00--status"; ?>">
            <?php foreach ($agent_numbers as $each):
                ?>
                <Number url="<?= _U."website_number_dial_status?params=".$insertId."--".$each ?>"><?= $each; ?></Number>
            <?php endforeach; ?>
        </Dial>
    <?php endif; ?>
</Response>
<?php die; ?>