<?php
$sequence = array("day1_1_sent" => array("subject"=>"Welcome to Sprout"),
    "day2_1_sent" => array("subject"=>"I Have Your Application Here"),
    "day3_1_sent" => array("subject"=>"I Still Haven’t Heard Back"),
    "day4_1_sent" => array("subject"=>"Your Application is Expiring"),
    "day5_1_sent" => array("subject"=>"Your Application is Expiring"));
$sequence_app_out = array("day1_1_sent" => array("subject"=>"Your Application for {company_name}","template_name"=>"day1_1_app_out_email.php"),
            "day2_1_sent" => array("subject"=>"Did you receive the application?","template_name"=>"day2_1_app_out_email.php"),
            "day3_1_sent" => array("subject"=>"{merchant_name} this is kind of urgent","template_name"=>"day3_1_app_out_email.php"));   
if(isset($_REQUEST['deal_id'])){
    $deal_id = $_REQUEST['deal_id'];
    $next_seq = $_REQUEST['next_seq'];
    $email_type = $_REQUEST['email_type'];
    
    if($email_type=='app_out'){
        $deal_data = qs("SELECT ss.agent_name,ss.deal_name,ss.org_name,ss.customer_name FROM sms_sequence ss where ss.last_deal_id='{$deal_id}'");
        $company_name = isset($deal_data['org_name'])?$deal_data['org_name']:"Your Company";
        $merchant_name = isset($deal_data['customer_name'])?$deal_data['customer_name']:"";
        $name = explode(" ", $merchant_name);
        $merchant_name = ucwords(strtolower($name[0]));
        $subject = str_ireplace(array("{company_name}","{merchant_name}"), array($company_name,$merchant_name), $sequence_app_out[$next_seq]['subject']);        
        $email_table = "email_sequence_app_out";
    }else{
        $subject = $sequence[$next_seq]['subject'];
        $email_table = "email_sequence";
    }
    $next_seq1 = explode("_", $next_seq);
    $day = substr($next_seq1[0],"3");
    $apiPD = new apiPipeDrive();   
    $note_data = array();
    $note_data['deal_id'] = $deal_id;
    $note_data['content'] = "Customer <b>opened</b> an Email sent by agent with subject to '".$subject."' on day $day";
    $data = $apiPD->createNote($note_data);
    q("update {$email_table} set recently_opened='{$next_seq}' where last_deal_id='{$deal_id}'");        
    qi("activity_log",array("payload"=>"NEXT: ".$next_seq." Deal:".$deal_id));
    die;
}
if(isset($_REQUEST['pd_notifications'])){
    $recently_open = qs("select * from email_sequence where recently_opened!=''");
    $data = array();
    if(!empty($recently_open)){
        q("update email_sequence set recently_opened='' where id='{$recently_open['id']}'");
        $next_seq  = $recently_open['recently_opened'];
        
        $deal_data = qs("SELECT ss.agent_name,ss.deal_name,ss.org_name,ss.customer_name,ss.deal_amount FROM sms_sequence ss where ss.last_deal_id='{$recently_open['last_deal_id']}'");
        $company_name = isset($deal_data['org_name'])?$deal_data['org_name']:"";
        $merchant_name = isset($deal_data['customer_name'])?$deal_data['customer_name']:"";
            
        $data['found'] = '1';
        $data['deal_id'] = $recently_open['last_deal_id'];
        $data['message_link'] = "https://sprout2.pipedrive.com/deal/".$recently_open['last_deal_id'];
        $data['message'] = "Customer opened an Email sent by agent with subject to '".$sequence[$next_seq]['subject']."'.\nCustomer Name: {$deal_data['customer_name']}\nDeal Name: {$deal_data['deal_name']}\nAmount: $".$deal_data['deal_amount'];
        echo json_encode($data); die;
    }else{
        $recently_open = qs("select * from email_sequence_app_out where recently_opened!=''");
        if(!empty($recently_open)){
            q("update email_sequence_app_out set recently_opened='' where id='{$recently_open['id']}'");
            $next_seq  = $recently_open['recently_opened'];
            
            $deal_data = qs("SELECT ss.agent_name,ss.deal_name,ss.org_name,ss.customer_name,ss.deal_amount FROM sms_sequence ss where ss.last_deal_id='{$recently_open['last_deal_id']}'");
            $company_name = isset($deal_data['org_name'])?$deal_data['org_name']:"Your Company";
            $merchant_name = isset($deal_data['customer_name'])?$deal_data['customer_name']:"";
            $name = explode(" ", $merchant_name);
            $merchant_name = ucwords(strtolower($name[0]));
            $subject = str_ireplace(array("{company_name}","{merchant_name}"), array($company_name,$merchant_name), $sequence_app_out[$next_seq]['subject']);        
            
            $data['found'] = '1';
            $data['deal_id'] = $recently_open['last_deal_id'];
            $data['message_link'] = "https://sprout2.pipedrive.com/deal/".$recently_open['last_deal_id'];
            $data['message'] = "Customer opened an Email sent by agent with subject to '".$subject."'.\nCustomer Name: {$deal_data['customer_name']}\nDeal Name: {$deal_data['deal_name']}\nAmount: $".$deal_data['deal_amount'];
            echo json_encode($data); die;
        } else{
            $data['found'] = '0';
            echo json_encode($data); die;
        }
    }
    die;
}
die;
?>