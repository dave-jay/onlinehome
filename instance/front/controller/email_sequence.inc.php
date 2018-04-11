<?php
die;
if (date("l") == "Sunday") {
    die;
}

$all_tenants = q("select * from admin_users where is_active='1' and id=1");
foreach ($all_tenants as $each_tenant):
    $GLOBALS['tenant_id'] = $each_tenant['id'];
    include _PATH.'instance/front/controller/define_settings.inc.php';
    if(strtolower($conf_data['EMAIL_SEQUENCE_STATUS'])!="on"){
        continue;        
    }
    
    $apiPD = new apiPipeDrive($conf_data['PIPEDRIVER_API_KEY']);
    $email_sequence_data = q("select * from email_sequence where tenant_id='{$GLOBALS['tenant_id']}' AND need_to_send_email='1'");
    foreach ($email_sequence_data as $each_email) {
        $deal_info = $seq_data = array();
        $req_email_detail = getEmailTemplateName($each_email);
        if ($req_email_detail['success'] == 1) {
            if (IsTimeToSendEmail($GLOBALS['tenant_id'],strtotime($each_email['modified_at']), $req_email_detail['next_seq'], $each_email['timezone'], $each_email['hold_till_date'])) {
                $next_seq = $req_email_detail['next_seq'];
                $deal_id = $each_email['last_deal_id'];
                $template_name = $req_email_detail['template_name'];
                $subject = $req_email_detail['subject'];
                $deal_info = $apiPD->getDealInfo($each_email['last_deal_id']);
                $deal_info = json_decode($deal_info, true);
                if ($deal_info['data']['e585bd988070d2bdfb2af36d968521c3f9aa949a'] != '196') {
                    if (isset($deal_info['data']['stage_id']) && ($deal_info['data']['stage_id'] == '28' || $deal_info['data']['stage_id'] == '1') && $deal_info['data']['status'] == 'open') {
                        $agent_id = $deal_info['data']['user_id']['value'];
                        if ($agent_id != '' && $agent_id != "990918") {
                            $agent_data = qs("select * from pd_users where tenant_id='{$GLOBALS['tenant_id']}' AND pd_id='{$agent_id}'");
                        } else {
                            $agent_data = qs("select * from pd_users where tenant_id='{$GLOBALS['tenant_id']}' AND is_default='1'");
                        }
                        $name = explode(" ", $deal_info['data']['person_id']['name']);
                        $fname = ucwords(strtolower($name[0]));
                        $email = $each_email['email'];

                        # email token replacement
                        $subject = str_replace(array('{merchant_name}'), array($fname), $subject);

                        $agent_name = ucwords(strtolower($agent_data['name']));
                        $agent = explode(" ", $agent_name);
                        $agent_fname = $agent[0];
                        $agent_email = $agent_data['email'];
                        $agent_linked = $agent_data['linkedin_link'];
                        $agent_phone = formatPhone($agent_data['phone']);
                        $agent_role = $agent_data['role'];
                        $agent_pass = $agent_data['password'];

                        echo "<br><br><div style='font-size:30px;color:green;font-weight:bold;'>Email Sent</div>";
                        qu("email_sequence", array($req_email_detail['next_seq'] => '1'), "id='{$each_email['id']}'");
                        ob_start();
                        include _PATH . "instance/front/tpl/email_tpl/" . $template_name;
                        $mail = ob_get_contents();
                        ob_end_clean();
                        qi('active_campaign_log', _escapeArray(array("log" => "Email: {$subject} on " . $email)));
                        try {
                            $apiCore = new apiCore();
                            $apiCore->doCall("http://45.79.140.218/lysoft/hook_email", array("to" => $email, "subject" => $subject, "content" => $mail, "mail_from_email" => $agent_email, "password" => $agent_pass, "mail_from_name" => $agent_name, "bcc" => "sprout2+deal{$each_email['last_deal_id']}@pipedrivemail.com"), "POST");
                            //customMail($email, $subject, $mail, array(), $agent_email, $agent_name);
                        } catch (Exception $e) {
                            echo $e->getMessage();
                        }
                        echo "Following email sent: " . $mail;
//                $note_data = array();
//                $note_data['deal_id'] = $each_email['last_deal_id'];
//                $note_data['content'] = "Text was sent on ".formatPhone($each_email['phone'],4).".<br><br>Text: {$message}";
//                $data = $apiPD->createNote($note_data);               
                        die;
                    }
                    echo "Contact Is Made or Deal is closed";
                } else {
                    echo "Sequence is recently stopped";
                }
            } else {
                echo "Please wait some time.";
                continue;
            }
        } else {
            echo "No need to send email";
        }

        if (isset($deal_info['data']['stage_id']) && $deal_info['data']['stage_id'] == "2") {
            $seq_data['is_contact_made'] = '1';
        }
        $seq_data['need_to_send_email'] = '0';
        qu("email_sequence", _escapeArray($seq_data), "id='{$each_email['id']}'");
    }
endforeach;
die;
?>