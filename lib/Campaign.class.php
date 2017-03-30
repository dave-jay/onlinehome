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
    public static $SEQUENCE_STATUS = 'OLD';
    public static $PIPEDRIVE_ID = '';
    public static $PIPEDRIVE_STAGE = '';
    public static $AGENT_NAME = '';
    public static $DEAL_AMOUNT = '';
    public static $ALTERNATE_PHONE = '';
    public static $PIPEDRIVE_DEAL_LINK = '';
    public static $AGENT_PHONE = '';
    public static $AGENT_ROLE = '';
    public static $AGENT_LINKEDIN_LINK = '';
    public static $FOLLOWUP_SEQUENCE = 'ON';
    

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
            "tags" => Campaign::$tag,
          "field[%PIPEDRIVE_ID%,0]" => Campaign::$PIPEDRIVE_ID,
          "field[%PIPEDRIVE_STAGE%,0]" => Campaign::$PIPEDRIVE_STAGE,
          "field[%AGENT_NAME%,0]" => Campaign::$AGENT_NAME,
          "field[%PD_DEAL_AMOUNT%,0]" => Campaign::$DEAL_AMOUNT,
          "field[%ALTERNATE_PHONE%,0]" => Campaign::$ALTERNATE_PHONE,
          "field[%PIPEDRIVE_DEAL_LINK%,0]" => Campaign::$PIPEDRIVE_DEAL_LINK,
          "field[%AGENT_PHONE%,0]" => Campaign::$AGENT_PHONE,
          "field[%AGENT_ROLE%,0]" => Campaign::$AGENT_ROLE,
          "field[%AGENT_LINKEDIN_LINK%,0]" => Campaign::$AGENT_LINKEDIN_LINK,
          "field[%FOLLOWUP_SEQUENCE%,0]" => Campaign::$FOLLOWUP_SEQUENCE,
          "field[%SEQUENCE_STATUS%,0]" => Campaign::$SEQUENCE_STATUS,
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
   

}
