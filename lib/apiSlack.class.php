<?php

/*
 * Class file for asana api integration
 * http://developers.asana.com — here is all the info you need to review.
 *
 * api key: lbToJaK.0h1vux8YRG3p9DaKZcsmqLHB : Brilliant
 * 
 * Keys for Raj: ( Test Account )
 * public $key = "2Ba7cu7K.GHUSdSlRGgZFjOtAsXIS76a";
 * public $workspace = "9170437901315";
 * 
 */

class apiSlack {

    public function __construct() {
        
    }

    public static function doCurl($slack_channel_url, $data) {
        $ch = curl_init($slack_channel_url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $result = curl_exec($ch);
        $errors = curl_error($ch);
        curl_close($ch);
        return $result;
    }

    public static function pingSlack($message) {
        $slack_channel_url = "https://hooks.slack.com/services/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";
        //xoxp-32150775429-32151328807-169334564116-37150a0d974895d43dc2328b6f4c2fd6
        $data = "payload=" . json_encode(array(
                    "text" => $message
        ));
        return apiSlack::doCurl($slack_channel_url, $data);
    }

}

?>
