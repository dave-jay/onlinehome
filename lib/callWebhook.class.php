<?php

class callWebhook {

    public function callNow($phone_value, $agent_numbers, $dealId,$is_redial = "0") {
        $account_sid = ACCOUNT_SID;
        $auth_token = AUTH_TOKEN;
        //$account_sid = 'AC4878ef9ccad9ce3b980fdd4d1d0f42ca';
        //$auth_token = 'ea532dd88a9ee7fb43259da56a40a38f';
        $call_status = qs("select *,value as call_status from config where `key` = 'CALL_STATUS'");
        if(strtolower($call_status['call_status'])!="on"){
            qi("test",array("t"=>"call distribution is off.","payload"=>"someone is trying to call without permission!!!"));
            die;
        }
        if($phone_value==''){
            qi("activity_log",  _escapeArray(array("log"=>"Call can not be generated. Phone value is blank","deal_id"=>$dealId)));
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
        $agent_numbers = implode(',', $agent_numbers);
        qi("agent_call_dialed",  _escapeArray(array("agent_numbers"=>$agent_numbers,"deal_id"=>$dealId,"is_redial"=>$is_redial,"customer_phone"=>$phone_value)));
        $client = new Services_Twilio($account_sid, $auth_token);
        try {

            foreach ($agent_numbers_arr as $key => $each_agent) {
                //echo $each_agent."<br>";
                $url_agent_calling = _U."DialingAgent?";
                $url_agent_received = _U."ReceivedAgent?";
                $params = ("agent_numbers=" . $agent_numbers . "&dealId=" . $dealId . "&phone_value=" . $phone_value . "&cur_agent=" . $each_agent);
                $url_agent_calling .= $params;
                $url_agent_received .= $params;

                $call = $client->account->calls->create(TWILIO_PHONE_NUMBER, $each_agent, $url_agent_received, array(
                    "Method" => "GET",
                    "StatusCallback" => $url_agent_calling,
                    "StatusCallbackMethod" => "POST",
                    "StatusCallbackEvent" => array("ringing"),
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
    
    public function messageNow($phone_value, $message) {       
        include _PATH . "/Services/Twilio.php";
        $client = new Services_Twilio(ACCOUNT_SID, AUTH_TOKEN);
        if(IS_DEV_ENV){
            $phone_value = CUSTOMER_NO;
        }
        $phone_value=  self::ValidateNumber($phone_value);
        try {
            $sms = $client->account->messages->sendMessage(TWILIO_PHONE_NUMBER, $phone_value,$message);
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

}

?>