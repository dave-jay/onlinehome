<?php

class callWebhook {

    public function callNow($phone_value, $agent_numbers, $dealId,$is_redial = "0",$group = "A") {
        $account_sid = $GLOBALS['ACCOUNT_SID'];
        $auth_token = $GLOBALS['AUTH_TOKEN'];
        
        if(!isset($GLOBALS['tenant_id'])) $GLOBALS['tenant_id']=1; //Temparary tenant_id set
        $call_status = qs("select *,value as call_status from config where `key` = 'CALL_STATUS' and tenant_id='1'");
        if(strtolower($call_status['call_status'])!="on"){
            addLogs($_REQUEST['q'], $GLOBALS['tenant_id'], "call distribution is off");
            die;
        }
        if($phone_value==''){
            addLogs($_REQUEST['q'], $GLOBALS['tenant_id'], "Call can not be generated. Phone value is blank for deal: ".$dealId);
            die;
        }
        if(IS_DEV_ENV && $is_redial=="0"){
            $agent_numbers = array(TOLL_FREE_NO);
            $phone_value = AGENT_NO;
        }
        if(count($agent_numbers)==0){
            return;
        }
        include _PATH . "/Services/Twilio.php";
        $agent_numbers_arr = $agent_numbers;
        $agent_numbers = implode(",", $agent_numbers_arr);
        $agent_numbers_search = implode("','", $agent_numbers_arr);
        $filter_agent_number = self::filterAgentsByGroup($agent_numbers_search, $group);
		//d($agent_numbers);
		//d($filter_agent_number);
        if(empty($filter_agent_number['agent'])){
            addLogs($_REQUEST['q'], $GLOBALS['tenant_id'], "We have no agents for group '$group' or any lower level for deal: ".$dealId);
            qu("agent_call_dialed",  array("is_aborted"=>"1"),"deal_id='".$dealId."' AND tenant_id='".$GLOBALS['tenant_id']."'");
            qu("voice_call",  array("in_progress"=>"0"),"tenant_id='".$GLOBALS['tenant_id']."' AND deal_id='".$dealId."'");
            die;
        }
		
		
        qi("agent_call_dialed",  _escapeArray(array("tenant_id"=>$GLOBALS['tenant_id'], "agent_numbers"=>$agent_numbers,"deal_id"=>$dealId,"is_redial"=>$is_redial,"customer_phone"=>$phone_value,"category"=>$filter_agent_number['group'])));
        $client = new Services_Twilio($account_sid, $auth_token);
        $deal_sid_data = q("select * from deal_sid where tenant_id='".$GLOBALS['tenant_id']."' AND status!='R' AND status!='C' AND deal_id='{$dealId}'");
        qu("deal_sid", array("status" => "C"), "tenant_id='".$GLOBALS['tenant_id']."' AND status!='R' AND status!='C' AND deal_id='{$dealId}'");

        foreach ($deal_sid_data as $each_sid) {
            $call = $client->account->calls->get($each_sid['sid']);
            $call->update(array(
                "Status" => "completed"
            ));
        }
        try {

            foreach ($filter_agent_number['agent'] as $key => $each_agent) {
                //foreach ($agent_numbers_arr as $key => $each_agent) {
                //echo $each_agent."<br>";
                $url_agent_calling = _U."DialingAgent?";
                $url_agent_received = _U."ReceivedAgent?";
                $params = ("tenant_id=" . $GLOBALS['tenant_id'] . "&agent_numbers=" . $agent_numbers . "&dealId=" . $dealId . "&phone_value=" . $phone_value . "&cur_agent=" . $each_agent);
                $url_agent_calling .= $params;
                $url_agent_received .= $params;

                $call = $client->account->calls->create($GLOBALS['TWILIO_PHONE_NUMBER'], $each_agent, $url_agent_received, array(
                    "Method" => "GET",
                    "StatusCallback" => $url_agent_calling,
                    "StatusCallbackMethod" => "POST",
                    "StatusCallbackEvent" => array("ringing","completed"),
                    //"IfMachine" => "Hangup",
                    "Timeout" => "25"
                ));
                echo $call->sid . "<br>";
                //sleep(2);
            }


            echo "<br>We are calling on " . $phone_value;
            die;
        } catch (Exception $e) {
            // Failed calls will throw
            echo $e;
            die;
        }
    }
    
    public function click_to_call($click_to_call_id = 0) {
        $account_sid = $GLOBALS['ACCOUNT_SID'];
        $auth_token = $GLOBALS['AUTH_TOKEN'];
        $click_to_call = qs("select * from click_to_call where id='{$click_to_call_id}'");
        if(empty($click_to_call)){
            return '';
        }

        $url_agent_calling = _U . "click_to_call_complete?";
        $url_agent_received = _U . "click_to_call_first?";
        $params = ("agent_number=" . $click_to_call['agent_phone']."&click_to_call_id=". $click_to_call_id. "&dealId=" . $click_to_call['deal_id'] . "&phone_value=" . $click_to_call['customer_phone']);
        $url_agent_calling .= $params;
        $url_agent_received .= $params;
        include _PATH . "/Services/Twilio.php";
        $client = new Services_Twilio($account_sid, $auth_token);
        $call = $client->account->calls->create($GLOBALS['TWILIO_PHONE_NUMBER'], $click_to_call['agent_phone'], $url_agent_received, array(
            "Method" => "GET",
            "StatusCallback" => $url_agent_calling,
            "StatusCallbackMethod" => "POST",
            "Timeout" => "25"
        ));
        return $call->sid;
    }
    
    public function messageNow($phone_value, $message, $use_number='') {       
        include _PATH . "/Services/Twilio.php";
        $client = new Services_Twilio($GLOBALS['ACCOUNT_SID'], $GLOBALS['AUTH_TOKEN']);
        if(IS_DEV_ENV){
            $phone_value = CUSTOMER_NO;
        }
        $phone_value=  self::ValidateNumber($phone_value);
        if($use_number=='2'){
            $company_phone = $GLOBALS['TWILIO_PHONE_NUMBER2'];
        }else{
            $company_phone = $GLOBALS['TWILIO_PHONE_NUMBER'];            
        }
        try {
            $sms = $client->account->messages->sendMessage($company_phone, $phone_value,$message);
            echo $sms->sid . "<br>";
            echo "<br>We are sending message on " . $phone_value;
            die;
        } catch (Exception $e) {
            // Failed calls will throw
            echo $e;
            die;
        }
    }
    public static function ValidateNumber($phone_value){
        $phone_value_new =  str_replace(array("+","(",")"," ","-"),"",$phone_value);
        return (strlen($phone_value_new)>10?("+".$phone_value_new):$phone_value_new);
    }
    
    public static function filterAgentsByGroup($agent_numbers,$group){
        $filter_agent = array();
		print $query = "select * from pd_users where tenant_id='".$GLOBALS['tenant_id']."' AND is_active='1' and `group`='{$group}' and phone in ('$agent_numbers')";
        $agent_data = q($query);
		d($agent_data);
		
        if(empty($agent_data)){
            if($group=='A'){
                $group ='B';
            }else{
                $group = 'C';
            }
            $agent_data = q("select * from pd_users where is_active='1' and `group`='{$group}' and phone in ('$agent_numbers')");
            if(empty($agent_data)){
                $group = 'C';                
                $agent_data = q("select * from pd_users where is_active='1' and `group`='{$group}' and phone in ('$agent_numbers')");
            }
        }
        foreach($agent_data as $each_agents){
            $filter_agent[] = $each_agents['phone'];
        }
        $data['agent'] = $filter_agent;
        $data['group'] = $group;
        return $data;
        
    }

}

?>