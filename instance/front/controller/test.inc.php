<?php

date_default_timezone_set('UTC');

$dt = new DateTime("2016-03-31 18:31:14");
$tz = new DateTimeZone('Asia/Kolkata'); // or whatever zone you're after
$dt->setTimezone($tz);

$date = $dt->format('Y-m-d H:i:s');
echo $date;
die;
$filter_id = 488;
$start_record_from = 0;
$no_of_records = 10;
$apiPD = new apiPipeDrive();

$deal_data = $apiPD->getFilterDeals($filter_id, $start_record_from, $no_of_records);
$deal_data = json_decode($deal_data, TRUE);
d($deal_data);
die;
?>