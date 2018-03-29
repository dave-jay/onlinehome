<?php
die;
if (date("l") == "Sunday") {
    die;
}
$call_status = qs("select *,value as seq_status from config where `key` = 'SEQUENCE_STATUS'");
if (strtolower($call_status['seq_status']) != "on") {
    die;
}
$apiPD = new apiPipeDrive();
$email_sequence_data = q("select * from email_sequence_app_out where need_to_send_email='1'");
foreach ($email_sequence_data as $each_email) {
    $deal_info = $seq_data = array();
    $req_email_detail = getEmailTemplateNameAppOut($each_email);
    if ($req_email_detail['success'] == 1) {
        if (IsTimeToSendEmail(strtotime($each_email['modified_at']), $req_email_detail['next_seq'], $each_email['timezone'],$each_email['hold_till_date'],"_app_out")) {
            $next_seq = $req_email_detail['next_seq'];
            $deal_id = $each_email['last_deal_id'];
            $template_name = $req_email_detail['template_name'];
            $subject = $req_email_detail['subject'];
            $deal_info = $apiPD->getDealInfo($each_email['last_deal_id']);
            $deal_info = json_decode($deal_info, true);
            if (isset($deal_info['data']['stage_id']) && $deal_info['data']['stage_id'] == '3' && $deal_info['data']['status'] == 'open' && $deal_info['data']['e585bd988070d2bdfb2af36d968521c3f9aa949a'] != '196') {
                $org_id = $deal_info['data']['org_id']['value'];
                $org_data = $apiPD->getOrganizationInfo($org_id);
                $org_data = json_decode($org_data, "true");
                $no_of_month = 6;
                qi("test",  _escapeArray(array("payload"=> json_encode($org_data))));
                if (isset($org_data['data']['f8fa58d49c6d5490ef5fba35f5b96cb039b49ddd']) &&
                        $org_data['data']['f8fa58d49c6d5490ef5fba35f5b96cb039b49ddd']=='198') {
                    $no_of_month = 12;
                }
                $agent_id = $deal_info['data']['user_id']['value'];
				$org_name = $deal_info['data']['org_id']['name'];
                if ($agent_id != '' && $agent_id != "990918") {                    
                    $agent_data = qs("select * from pd_users where pd_id='{$agent_id}'");
                } else {
                    qi("active_campaign_log", array("log"=>"Default: "));
                    $agent_data = qs("select * from pd_users where is_default='1'");
                }
                $name = explode(" ", $deal_info['data']['person_id']['name']);
                $fname = ucwords(strtolower($name[0]));
                $email = $each_email['email'];

                # email token replacement
                $subject= str_replace(array('{merchant_name}','{company_name}'),array($fname,$org_name),$subject);

                $agent_name = ucwords(strtolower($agent_data['name']));
                $agent = explode(" ", $agent_name);
                $agent_fname = $agent[0];
                $agent_email = $agent_data['email'];
                $agent_linked = $agent_data['linkedin_link'];
                $agent_phone = formatPhone($agent_data['phone']);
                $agent_role = $agent_data['role'];
                $agent_pass = $agent_data['password'];
                qi("active_campaign_log", _escapeArray(array("log"=>"Mail is sending to {$email}")));

                echo "<br><br><div style='font-size:30px;color:green;font-weight:bold;'>Email Sent</div>";
                qu("email_sequence_app_out", array($req_email_detail['next_seq'] => '1'), "id='{$each_email['id']}'");
                ob_start();
                include _PATH . "instance/front/tpl/email_tpl/" . $template_name;
                $mail = ob_get_contents();
                ob_end_clean();
                try {
                    $apiCore = new apiCore();                        
                    $apiCore->doCall("http://45.79.140.218/lysoft/hook_email",array("to"=>$email,"subject"=>$subject,"content"=>$mail,"mail_from_email"=>$agent_email,"password"=>$agent_pass,"mail_from_name"=>$agent_name,"bcc"=>"sprout2+deal{$each_email['last_deal_id']}@pipedrivemail.com"),"POST");
                    //customMail($email, $subject, $mail, array(), $agent_email, $agent_name);
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
                die;
            } else {
                echo "App Is In or Deal is closed";
                qi("test",array("payload"=>"AppOut: App is in"));
            }
        } else {
            //qi("test",array("payload"=>"AppOut: Please wait"));
            echo "Please wait some time.";
            continue;
        }
    } else {
        qi("test",array("payload"=>"AppOut: No need to send"));
        echo "No need to send email";
    }

    if (isset($deal_info['data']['stage_id']) && $deal_info['data']['stage_id'] == "9") {
        $seq_data['is_app_in'] = '1';
    }
    $seq_data['need_to_send_email'] = '0';
    qi("test",array("payload"=>"AppOut: seq set to off"));
    qu("email_sequence_app_out", _escapeArray($seq_data), "id='{$each_email['id']}'");
}
die;
?>