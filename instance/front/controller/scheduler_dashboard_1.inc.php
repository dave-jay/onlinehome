<?php
$filter_array = array('438' => 'Prospects',
    '439' => 'Leads',
    '440' => 'Contact Made',
    '441' => 'App Out',
    '442' => 'App In',
    '443' => 'Submitted',
    '444' => 'Approved',
    '445' => 'Contracts Out',
    '446' => 'Contracts In',
    '447' => 'Funded');

$start_record_from = 0;
$no_of_records = 100;

$apiPD = new apiPipeDrive();
$source_data = $apiPD->getDealField('12463');
$stage_data = $apiPD->getAllStage();

$source_data = json_decode($source_data, "true");
$stage_data = json_decode($stage_data, "true");

$source = array();
$stage = array();

if (isset($source_data['data']['options'])) {
    foreach ($source_data['data']['options'] as $each_source) {
        $source[$each_source['id']] = $each_source; // 'label';
    }
}

if (isset($stage_data['data'])) {
    foreach ($stage_data['data'] as $each_stage) {
        $stage[$each_stage['id']] = $each_stage; //'order_nr','name'
    }
}
foreach ($filter_array as $filter_id => $filter_stage_name) {
    $deal_data = $apiPD->getFilterDeals($filter_id, $start_record_from, $no_of_records);
    $deal_data = json_decode($deal_data, "true");    
    while($deal_data['success']) {
        if ($deal_data['data'] && count($deal_data['data']) > 0) {
            foreach ($deal_data['data'] as $each_deal) {
                if ($each_deal['pipeline_id'] != '1')
                    continue;
                $fields = array();
                $fields['reference'] = strtotime(date('Y-m-d H:i:s'))."".$each_deal['id'].mt_rand(1,1000);
                $fields['member_name'] = 'Alan Pearce';
                $fields['member_id'] = 'cc1cb543271349f3b1bb2c64fbedd22e';
                $fields['deal_id'] = $each_deal['id'];
                $fields['agent_id'] = $each_deal['user_id']['id'];
                $fields['agent_name'] = $each_deal['user_id']['name'];
                $fields['agent_email'] = $each_deal['user_id']['email'];
                $fields['cust_id'] = $each_deal['person_id']['value'];
                $fields['cust_name'] = $each_deal['person_id']['name'];
                $fields['cust_email'] = $each_deal['person_id']['email'][0]['value'];
                $fields['stage_id'] = $each_deal['stage_id'];
                $fields['source'] = _e($source[$each_deal['c2a6fc3129578b646ae55717ed15f03ce3ee4df0']]['label'], "");
                $fields['status'] = $each_deal['status'];
                $fields['curr_stage'] = $stage[$each_deal['stage_id']]['name'];
                $fields['initial_move_stage'] = $filter_stage_name;
                $fields['stage_order_nr'] = $stage[$each_deal['stage_id']]['order_nr'];

                $duplicate = qs("select * from dashboard_stage_entering_deals where deal_id = '{$fields['deal_id']}' and initial_move_stage = '{$fields['initial_move_stage']}'");
                if (!empty($duplicate)) {
                    unset($fields['reference']);
                    qu("dashboard_stage_entering_deals", _escapeArray($fields), "deal_id= '{$fields['deal_id']}' and initial_move_stage = '{$fields['initial_move_stage']}'");
                    echo "<br> Record Update for deal: " . $fields['deal_id'];
                } else {                    
                    $fields['date'] = _mysqlDate();
                    qi("dashboard_stage_entering_deals", _escapeArray($fields));
                    echo "<br>Record Insert for deal: " . $fields['reference'];
                }
            }
            echo "new call<Br><Br><br>";
            $start_record_from += $no_of_records;
            $deal_data = array();
            $deal_data = $apiPD->getFilterDeals($filter_id, $start_record_from, $no_of_records);
            $deal_data = json_decode($deal_data, "true");
        } else {
            echo "no more records";
            break;
        }
    }
    if(!$deal_data['success']){
        echo "<br>Error - ".$filter_stage_name." - ".$deal_data['error'];
    }
    $start_record_from = 0;
    $no_of_records = 100;
}
die;
?>