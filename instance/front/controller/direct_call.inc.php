<?php
header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
$apiPD = new apiPipeDrive();
$deal_source = qs("select pd_source_id from pd_sources where source_name like 'Hot Lead 2'");
$agent_numbers = $apiPD->getAgentByDealSource($deal_source['pd_source_id'],1);
if (count($agent_numbers) == 0):
    ?>
    <Response>        
        <Say>Thank you for calling Lysoft dot Com. We are sorry for can't handle your call. Please Try Later.</Say>
    </Response>
<?php else: ?>
    <Response>        
        <Say>Thank you for calling Lysoft dot Com.</Say>
        <Say>We are connecting to our agents. Please wait a moment.</Say>
        <Dial>
            <?php foreach ($agent_numbers as $each_agent): ?>    
                <Number><?= $each_agent ?></Number>
            <?php endforeach; ?>
        </Dial>
    </Response>
<?php
endif;
$payload = file_get_contents('php://input');
qi("test", array("payload" => _escape($payload)));
die;
?>