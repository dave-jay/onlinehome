<?php

/**
 * Admin side Login file
 * 
 * 

 * @version 1.0
 * @package lysoft
 * 
 */
//$jsInclude = "home.js.php";
//_R(lr('dashboard'));
$urlArgs = _cg("url_vars");
_errors_on();

    $account_sid = 'ACaa30ea6de17c65f4407de5a34cbe1efa';
    $auth_token = '02866ddbbb04c3bea0551ded9f017db9';
    //$account_sid = 'AC4878ef9ccad9ce3b980fdd4d1d0f42ca';
    //$auth_token = 'ea532dd88a9ee7fb43259da56a40a38f';
    include _PATH . "/Services/Twilio.php";
    $client = new Services_Twilio($account_sid, $auth_token);
    try {
        //Call
        //+12092059117
        //+91 9998193671
//$call = $client->account->calls->create('+15005550006', '+91 9737128291', $applicationSid);
//3234733078
        //$call = $client->account->calls->create("+19165121922", "+91".$_REQUEST['txt_api_key'], "http://demo.twilio.com/docs/voice.xml", array());
        $call = $client->account->calls->create("+19165121922", "+13234733078", "http://s606346885.onlinehome.us/test_dial2");

        echo $call->sid;
        echo "<br>We are calling on +13234733078";
        die;
    } catch (Exception $e) {
        // Failed calls will throw
        echo $e;
        die;
    }
    //$_SESSION['greetings_msg']='!';

//$pipedriver_api_key = qs("SELECT * FROM  `config` WHERE  `key` LIKE  'PIPEDRIVER_API_KEY'");

_cg("page_title", "Test Dial");
?>