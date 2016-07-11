<?php

$params = explode("--", $_REQUEST['params']);
if (isset($params[2]) && $params[2] == "status") {
    $fields['CallStatus'] = $_REQUEST['CallStatus'];
    qu("website_number_dials", _escapeArray($fields), "id='" . $params[0] . "'");
} else {
    $fields['dial_agent'] = $params[1];
    qu("website_number_dials", _escapeArray($fields), "id='" . $params[0] . "'");
}
header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response><Say>Good Bye</Say>
</Response>
    <?php
die;
?>