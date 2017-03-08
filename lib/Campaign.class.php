<?php

/**
 * Active Campaign Integration
 * 
 * URL: https://lifezaver.activehosted.com/admin/
 * company: hubmost
 * Email: rf@lifezaver.com
 * Password: $printer
 * 
 */
# include core lib
//error_reporting(E_ALL);
include _PATH . "lib/ActiveCampaign/ActiveCampaign.class.php";

class Campaign {
    # API Related Information
    # Hold AC Object

    public $acObj;
    public static $ac_api_url = "https://sprout.api-us1.com";
    public static $ac_api_key = "a1b6a0ddc8ef0b1b67106402a51762278aff4a434084c9aab0eabbcb0f2cf2e82e61552a";
    # List related information
    /*  public static $ac_list_book_id = '3';
      public static $ac_list_quote_id = '2';
      public static $ac_list_discount_id = '6';
      public static $ac_list_exit_intent_id = '1'; */
    public static $ac_list_id = '13';
    # Contact Field Related Information
    public static $contact_email = '';
    public static $contact_fname = '';
    public static $contact_lname = '';
    public static $contact_phone = '';
    public static $contact_org = '';
    public static $tag = '';
#Cutome Fields
    public static $jan_5th_code = '';

    #Cutome Fields
    public static $contact_TF;
    public static $contact_MQ;
    public static $contact_YQ;
    public static $contact_LWQ;
    public static $contact_TOTAL_QUOTES;
    public static $contact_LAST_LOGIN;

    public function __construct() {
        $this->acObj = new ActiveCampaign(Campaign::$ac_api_url, Campaign::$ac_api_key);
    }


    public function pushContact($list_id=0) {
        # create contact
        $contact = array(
            "email" => Campaign::$contact_email,
            "first_name" => Campaign::$contact_fname,
            "last_name" => Campaign::$contact_lname,
            "phone" => Campaign::$contact_phone,
            "orgname" => Campaign::$contact_org,
            /*"tags" => Campaign::$tag,
            "field[%JAN5THCODE%,0]" => Campaign::$jan_5th_code,
              #Custom Fields
              "field[%PICKUP%,0]" => Campaign::$contact_PU,
              "field[%DROPOFF%,0]" => Campaign::$contact_DO,
              "field[%CHANNEL%,0]" => Campaign::$contact_CHANNEL,
              "field[%TRIP_TYPE%,0]" => Campaign::$contact_TRIP_TYPE,
              "field[%PICKUP_DATE%,0]" => Campaign::$contact_PU_DATE, */
            "p[{$list_id}]" => $list_id,
            "status[{$list_id}]" => 1, // "Active" status
        );
# Sync contact
        return $this->acObj->api("contact/sync", $contact);
    }

    public function mailData($email, $name, $phone, $TF, $MQ, $YQ, $LWQ, $TQ, $LL) {
        if (_isLocalMachine()) {
            return;
        }

        Campaign::$contact_email = $email;
        $nameContact = explode("_", $name);
        Campaign::$contact_fname = $nameContact[0];
        Campaign::$contact_lname = $nameContact[1];
        Campaign::$contact_phone = $phone;
        /*  #Custom Fields */
        Campaign::$contact_TF = $TF;
        Campaign::$contact_MQ = $MQ;
        Campaign::$contact_YQ = $YQ;
        Campaign::$contact_LWQ = $LWQ;
        Campaign::$contact_TOTAL_QUOTES = $TQ;
        if ($LL == "0000-00-00 00:00:00") {
            Campaign::$contact_LAST_LOGIN = "";
        } else {
            Campaign::$contact_LAST_LOGIN = date("m/d/Y", strtotime($LL));
        }
        $contact_sync = $this->Contact();

        if (!(int) $contact_sync->success) {
            return "Not Done";
//            _ls("Syncing contact failed. Error returned: " . $contact_sync->error);
        } else {
            return "Done";
        }
    }

    public function Contact() {
        # create contact
        $contact = array(
            "email" => Campaign::$contact_email,
            "first_name" => Campaign::$contact_fname,
            "last_name" => Campaign::$contact_lname,
            "phone" => Campaign::$contact_phone,
            /*  #Custom Fields */
            "field[%TOTALFLEET%,0]" => Campaign::$contact_TF,
            "field[%MONTHLY_QUOTE%,0]" => Campaign::$contact_MQ,
            "field[%YESTERDAY_QUOTE%,0]" => Campaign::$contact_YQ,
            "field[%LAST_WEEK_QUOTE%,0]" => Campaign::$contact_LWQ,
            "field[%TOTAL_QUOTES%,0]" => Campaign::$contact_TOTAL_QUOTES,
            "field[%LAST_LOGIN%,0]" => Campaign::$contact_LAST_LOGIN
        );
# Sync contact
        return $this->acObj->api("contact/sync", $contact);
    }

}
