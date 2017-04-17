<?php
$sequence = array("day1_1_sent" => array("subject"=>"Welcome to Sprout"),
    "day2_1_sent" => array("subject"=>"I Have Your Application Here"),
    "day3_1_sent" => array("subject"=>"I Still Haven’t Heard Back"),
    "day4_1_sent" => array("subject"=>"Your Application is Expiring"),
    "day5_1_sent" => array("subject"=>"Your Application is Expiring"));    
if(isset($_REQUEST['deal_id'])){
    $deal_id = $_REQUEST['deal_id'];
    $next_seq = $_REQUEST['next_seq'];
    $next_seq1 = explode("_", $next_seq);
    $day = substr($next_seq1[0],"3");
    $apiPD = new apiPipeDrive();   
    $note_data = array();
    $note_data['deal_id'] = $deal_id;
    $note_data['content'] = "Customer <b>opened</b> an Email sent by agent with subject to '".$sequence[$next_seq]['subject']."' on day $day";
    $data = $apiPD->createNote($note_data);
    q("update email_sequence set recently_opened='{$next_seq}' where last_deal_id='{$deal_id}'");
    qi("activity_log",array("payload"=>"NEXT: ".$next_seq." Deal:".$deal_id));
    die;
}
if(isset($_REQUEST['pd_notification'])){
    $recently_open = qs("select * from email_sequence where recently_opened!=''");
    $data = array();
    if(!empty($recently_open)){
        q("update email_sequence set recently_opened='' where id='{$recently_open['id']}'");
        $next_seq  = $recently_open['recently_opened'];
        $data['found'] = '1';
        $data['deal_id'] = $recently_open['last_deal_id'];
        $data['message_link'] = "https://sprout2.pipedrive.com/deal/".$recently_open['last_deal_id'];
        $data['message'] = "Customer opened an Email sent by agent with subject to '".$sequence[$next_seq]['subject']."'.";
    }else{
        $data['found'] = '0';
    }
    echo json_encode($data);
    die;
}
die;
?>