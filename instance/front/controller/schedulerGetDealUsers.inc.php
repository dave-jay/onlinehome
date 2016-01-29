<?php

$api = new apiPipeDrive();
$data = $api->getAllUsers();
$data = json_decode($data, true);
$user_list_data = array();
$user_list_data = $data["data"];
if (!empty($user_list_data)) {
    unset($fields);
    $fields["is_deleted"] = 1;
    qu("pd_users", $fields, " 1=1 ");

    foreach ($user_list_data as $each_user):
        d($each_user);
        $user_id = '';
        $user_id = trim($each_user["id"]);
        if ($user_id != '') {
            $check_user_id = array();
            $check_user_id = Call_distribution::CheckMainUserId($user_id);
            echo $check_user_id . "****" . $each_user["name"];
            echo "<br/>";
            unset($fields);
            $fields["name"] = $each_user["name"];
            $fields["email"] = $each_user["email"];
            $fields["phone"] = $each_user["phone"];
            $fields["is_deleted"] = '0';
            if ($check_user_id != '') {
                $fields = _escapeArray($fields);
				unset($fields['phone']);
                qu("pd_users", $fields, " id = '{$check_user_id}' ");
            } else {
                $fields["pd_id"] = $user_id;
                $fields = _escapeArray($fields);
                qi("pd_users", $fields);
            }
        }
    endforeach;
}
die;
?>