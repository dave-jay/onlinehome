<?php

/**
 * Call Distribution Class
 * 
 * @version 1.0
 * @package LySoft
 * 
 */
class Call_distribution {
    # constructor

    public function __construct() {
        
    }

    public static function getSourceList() {
        return q("SELECT * FROM pd_sources WHERE is_deleted = 0 ORDER BY pd_source_id ASC");
    }

    public static function getUserList() {
        return q("SELECT * FROM pd_users WHERE is_deleted = 0 and is_active='1' ORDER BY name ASC");
    }

    public static function AllLeadSorceNull() {
        unset($fields);
        $fields["pd_user_id"] = '';
        return qu("call_list_by_source", $fields, " 1 = 1 ");
    }

    public static function CheckSourceID($source_id) {
        $res = qs("SELECT count(id) as total_record FROM call_list_by_source WHERE pd_source_id = '{$source_id}'");
        return $res['total_record'];
    }

    public static function GetSourceUserIdList($source_id) {
        return qs("SELECT * FROM call_list_by_source WHERE pd_source_id = '{$source_id}'");
    }

    public static function CheckMainSourceId($source_id) {
        $res = qs("SELECT id,pd_source_id FROM pd_sources WHERE pd_source_id = '{$source_id}'");
        if (!empty($res)) {
            return $res["id"];
        } else {
            return "";
        }
    }

    public static function CheckMainUserId($user_id) {
        $res = qs("SELECT id,pd_id FROM pd_users WHERE pd_id = '{$user_id}'");
        if (!empty($res)) {
            return $res["id"];
        } else {
            return "";
        }
    }

}

?>