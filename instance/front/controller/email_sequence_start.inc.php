<?php

$all_tenants = q("select * from admin_users where is_active='1' and id=1");
foreach ($all_tenants as $each_tenant):
    $GLOBALS['tenant_id'] = $each_tenant['id'];
    include _PATH.'instance/front/controller/define_settings.inc.php';
    if(strtolower($conf_data['EMAIL_SEQUENCE_STATUS'])!="on"){
        continue;        
    }
    

    $need_to_start_data = qs("select * from active_campaign_contact where tenant_id='{$GLOBALS['tenant_id']}' AND need_to_start_email='1' order by created_at desc");
    if (!empty($need_to_start_data)) {
        if (time() > (strtotime($need_to_start_data['need_to_start_time']))) {
            addLogs($_REQUEST['q'], $GLOBALS['tenant_id'], "Email:One new deal found");
            qu("active_campaign_contact", array("need_to_start_email" => "0"), "id='{$need_to_start_data['id']}'");
        } else {
            echo "please wait for " . ((strtotime($need_to_start_data['modified_at']) + 60) - time()) . " sec";
            continue;
        }
    } else {
        echo "no new deal is coming";
        continue;
    }

    $apiPD = new apiPipeDrive($conf_data['PIPEDRIVER_API_KEY']);
    $deal_info = $apiPD->getDealInfo($need_to_start_data['last_deal_id']);
    $deal_info = json_decode($deal_info, TRUE);


    $agent = $fname = $lname = $email = $pipedrive_id = $agent_id = $agent_linkedin_link = $agent_phone = '';
    $phone = $need_to_start_data['phone'];
    if (isset($deal_info['data']['id'])) {
        $name = explode(" ", $deal_info['data']['person_id']['name']);
        $fname = ucwords(strtolower($name[0]));
        if (count($name) > 2) {
            array_shift($name);
            $lname = implode(" ", $name);
        } else {
            $lname = $name[1];
        }
        foreach ($deal_info['data']['person_id']['email'] as $each) {
            if (isset($each['value']) && $each['value'] != '') {
                $email = $each['value'];
                break;
            }
        }
        $agent = $deal_info['data']['user_id']['name'];
        $agent_id = $deal_info['data']['user_id']['value'];
        $pipedrive_id = $deal_info['data']['id'];
    } else {
        addLogs($_REQUEST['q'], $GLOBALS['tenant_id'],"Add: Deal info not found for deal {$need_to_start_data['last_deal_id']}. " . json_decode($data));        
        continue;
    }

    if ($agent_id != '' && $agent_id != "990918") {
        $agent_data = qs("select * from pd_users where pd_id='{$agent_id}'");
    } else {
        $agent_data = qs("select * from pd_users where is_default='1'");
    }
    $agent_name = ucwords(strtolower($agent_data['name']));
    $agent = explode(" ", $agent_name);
    $agent_fname = $agent[0];
    $agent_email = $agent_data['email'];
    $agent_linked = $agent_data['linkedin_link'];
    $agent_phone = formatPhone($agent_data['phone']);
    $agent_role = $agent_data['role'];
    $agent_pass = $agent_data['password'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $sms_seq_data = qs("select * from email_sequence where tenant_id='{$GLOBALS['tenant_id']}' AND (email='" . $email . "' OR last_deal_id='" . $pipedrive_id . "')");
        if (!empty($sms_seq_data)) {
            qd("email_sequence", "id='{$sms_seq_data['id']}'");
        }
        $time_zone_arr = getTimeZoneByPhone($phone, "1");
        qi("email_sequence", array("tenant_id" => $GLOBALS['tenant_id'], "email" => $email, "state_code" => $time_zone_arr['state_code'], "state" => $time_zone_arr['state'], "area_code" => $time_zone_arr['area_code'], "timezone" => $time_zone_arr['timezone'], "last_deal_id" => $pipedrive_id, "day1_1_sent" => "1"));
        $next_seq = 'day1_1_sent';
        $deal_id = $pipedrive_id;
        ob_start();
        include _PATH . "instance/front/tpl/email_tpl/day1_1_email.php";
        $mail = ob_get_contents();
        ob_end_clean();
        $subject = "Welcome to Sprout";
        addLogs($_REQUEST['q'], $GLOBALS['tenant_id'],"Email: Trying to send email on " . $email);
        try {
            $apiCore = new apiCore();
            $apiCore->doCall("http://45.79.140.218/lysoft/hook_email", array("to" => $email, "subject" => $subject, "content" => $mail, "mail_from_email" => $agent_email, "password" => $agent_pass, "mail_from_name" => $agent_name, "bcc" => "sprout2+deal$pipedrive_id@pipedrivemail.com"), "POST");
            //customMail($email, $subject, $mail,array(),$agent_email,$agent_name);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    } else {
        addLogs($_REQUEST['q'], $GLOBALS['tenant_id'],"Email:{$email} Email addresss invalid");
    }
endforeach;
die;
?>