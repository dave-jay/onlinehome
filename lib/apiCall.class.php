<?php

class apiCall {

    public function doBroadcast($phone_value, $agent_numbers, $dealId) {
        $account_sid = 'ACaa30ea6de17c65f4407de5a34cbe1efa';
        $auth_token = '02866ddbbb04c3bea0551ded9f017db9';
        //$account_sid = 'AC4878ef9ccad9ce3b980fdd4d1d0f42ca';
        //$auth_token = 'ea532dd88a9ee7fb43259da56a40a38f';

        include _PATH . "/Services/Twilio.php";
        $agent_numbers = implode(',', $agent_numbers);
        $client = new Services_Twilio($account_sid, $auth_token);
        try {
        //Call
        //+19165121922
        //+91 9998193671
        //13234733078
        //$call = $client->account->calls->create("+15005550006", $phone_value , "http://s606346885.onlinehome.us/CustAgentIntermediate?agent_numbers=".$agent_numbers.'&dealId='.$deal_id);
        $call = $client->account->calls->create("+19165121922", $phone_value , "http://s606346885.onlinehome.us/CustAgentIntermediate?agent_numbers=".$agent_numbers."&dealId=".$dealId);

        echo $call->sid;
        echo "<br>We are calling on ".$phone_value;
        die;
    } catch (Exception $e) {
        // Failed calls will throw
        echo $e;
        die;
    }
    }

}

?>