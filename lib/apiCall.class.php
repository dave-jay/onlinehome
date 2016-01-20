<?php

class apiCall {

    public function doBroadcast($phone_value, $agent_numbers, $dealId) {
        $account_sid = 'ACaa30ea6de17c65f4407de5a34cbe1efa';
        $auth_token = '02866ddbbb04c3bea0551ded9f017db9';
        //$account_sid = 'AC4878ef9ccad9ce3b980fdd4d1d0f42ca';
        //$auth_token = 'ea532dd88a9ee7fb43259da56a40a38f';

        include _PATH . "/Services/Twilio.php";
        $agent_numbers_arr = $agent_numbers;
        $agent_numbers = implode(',', $agent_numbers);
        $client = new Services_Twilio($account_sid, $auth_token);
        try {

            foreach ($agent_numbers_arr as $key => $each_agent) {
                //echo $each_agent."<br>";
                $url_agent_calling = _U."DialingAgent?";
                $url_agent_received = _U."ReceivedAgent?";
                $params = ("agent_numbers=" . $agent_numbers . "&dealId=" . $dealId . "&phone_value=" . $phone_value . "&cur_agent=" . $each_agent);
                $url_agent_calling .= $params;
                $url_agent_received .= $params;

                $call = $client->account->calls->create("+19165121922", $each_agent, $url_agent_received, array(
                    "Method" => "GET",
                    "StatusCallback" => $url_agent_calling,
                    "StatusCallbackMethod" => "POST",
                    "StatusCallbackEvent" => array("ringing"),
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

}

?>