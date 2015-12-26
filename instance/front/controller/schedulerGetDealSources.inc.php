<?php

$api = new apiPipeDrive();
$data = $api->getDealField('12463');
$data = json_decode($data, true);
$source_list_arr = array();
$source_list_arr = $data["data"]["options"];
d($source_list_arr);
//Set Flag is_deleted=1 in all the records
unset($fields);
$fields["is_deleted"] = 1;
qu("pd_sources", $fields, " 1=1 ");

if (count($source_list_arr) > 0) {
    foreach ($source_list_arr as $each_source):
        $source_id = '';
        $source_id = trim($each_source["id"]);
        if ($source_id != '') {
            $check_source_id = array();
            $check_source_id = Call_distribution::CheckMainSourceId($source_id);
            echo $check_source_id . "****" . $each_source["label"];
            echo "<br/>";
            $data_insert = 1;
            if (!empty($check_source_id)) {
                if ($check_source_id["id"] != '') {
                    unset($fields);
                    $fields["source_name"] = trim($each_source["label"]);
                    $fields["is_deleted"] = 0;
                    $fields = _escapeArray($fields);
                    qu("pd_sources", $fields, " id = '{$check_source_id}' ");
                    $data_insert = 0;
                }
            }

            if ($data_insert == 1) {
                $fields["pd_source_id"] = trim($each_source["id"]);
                $fields["source_name"] = trim($each_source["label"]);
                $fields["is_deleted"] = 0;
                $fields = _escapeArray($fields);
                qi("pd_sources", $fields);
            }
        }
    endforeach;
}

echo "<br/><br/>===================Script Is Done================";

die;

