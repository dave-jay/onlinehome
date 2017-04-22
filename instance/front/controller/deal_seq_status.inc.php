<?php

$all_deal = $_REQUEST['need_to_load_deal'];
$deals = array();
$apiPD = new apiPipeDrive();
if (is_array($all_deal) && count($all_deal) > 0) {
    foreach ($all_deal as $each_deal) {
        $deal_data = qs("select seq_status from deal_seq_status where deal_id='{$each_deal}'");
        $deals[$each_deal] = '';
        if (!empty($deal_data)) {
            if ($deal_data['seq_status'] == "ON") {
                $deals[$each_deal] = "https://leadpropel.com/admin/instance/front/media/img/icon_on.png";
            } elseif ($deal_data['seq_status'] == "OFF_AUTO") {
                $deals[$each_deal] = "https://leadpropel.com/admin/instance/front/media/img/icon_off_white.jpg";
            } elseif ($deal_data['seq_status'] == "OFF_MANU") {
                $deals[$each_deal] = "https://leadpropel.com/admin/instance/front/media/img/icon_off_black.png";
            }
        } else {
            $deal_info = $apiPD->getDealInfo($each_deal);
            $deal_info = json_decode($deal_info, true);
            $seq_status = 'NONE';
            if (isset($deal_info['data']['e585bd988070d2bdfb2af36d968521c3f9aa949a'])) {
                if ($deal_info['data']['e585bd988070d2bdfb2af36d968521c3f9aa949a'] == '196') {
                    $seq_deal = qs("select * from sms_sequence where last_deal_id='{$each_deal}'");
                    if(!empty($seq_deal) && $seq_deal['day7_1_sent']=='1' && $seq_deal['day7_1_sent']=='0'){
                        $seq_status = 'OFF_AUTO';
                        $deals[$each_deal] = "https://leadpropel.com/admin/instance/front/media/img/icon_off_white.jpg";
                    }else{
                        $seq_status = 'OFF_MANU';
                        $deals[$each_deal] = "https://leadpropel.com/admin/instance/front/media/img/icon_off_black.png";                        
                    }
                } else if ($deal_info['data']['e585bd988070d2bdfb2af36d968521c3f9aa949a'] == '195') {
                    $seq_status = 'ON';
                    $deals[$each_deal] = "https://leadpropel.com/admin/instance/front/media/img/icon_on.png";
                }
            }
            qi("deal_seq_status", _escapeArray(array("deal_id" => $each_deal, "seq_status" => $seq_status)));
        }
    }
}
echo json_encode($deals);
die;
?>