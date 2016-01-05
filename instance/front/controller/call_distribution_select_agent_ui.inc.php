<?php
$user_list = Call_distribution::getUserList();
$source_user_list = array();
$source_user_list_ids = array();
$source_user_list = Call_distribution::GetSourceUserIdList($deal_nm_arr["pd_source_id"]);
if (!empty($source_user_list)) {
    if (trim($source_user_list["pd_user_id"]) != '' && trim($source_user_list["pd_user_id"]) != '[]') {
        $source_user_list_ids = json_decode(trim($source_user_list["pd_user_id"]), true);
    }
}
?>
<div style="float:left; width: 220px;padding:10px;">
    <div style="width:100%;text-align:center;font-weight:bold;color:#444;">All Agents</div>
    <select id="sbOne" multiple="multiple" style="height:250px;width: 200px;">
        <?php if (!empty($user_list)) { ?>
            <?php foreach ($user_list as $each_user): ?>
                <?php if (!in_array($each_user['pd_id'], $source_user_list_ids)) { ?>
                    <option value="<?php print $each_user["pd_id"]; ?>"><?php print $each_user["name"]; ?></option>
                <?php } ?>    
            <?php endforeach; ?>
        <?php } ?>
    </select>
</div>
<div style="float:left;width:65px;padding:10px;margin-top:57px;">
    <button class="btn btn-success" id="left" style="width:45px;margin-bottom:10px;font-weight:bold;"> < </button>
    <button class="btn btn-success" id="right" style="width:45px;margin-bottom:10px;font-weight:bold;"> > </button>
    <button class="btn btn-success" id="leftall" style="width:45px;margin-bottom:10px;font-weight:bold;"> << </button>
    <button class="btn btn-success" id="rightall" style="width:45px;margin-bottom:10px;font-weight:bold;"> >> </button>
</div>
<div style="float:left; width: 220px;padding:10px;">
    <div style="width:100%;text-align:center;font-weight:bold;color:#444;">Selected Agents</div>
    <select id="sbTwo" multiple="multiple" style="height:250px;width: 200px;">
        <?php if (!empty($user_list)) { ?>
            <?php foreach ($user_list as $each_user): ?>
                <?php if (in_array($each_user['pd_id'], $source_user_list_ids)) { ?>
                    <option value="<?php print $each_user["pd_id"]; ?>"><?php print $each_user["name"]; ?></option>
                <?php } ?>    
            <?php endforeach; ?>
        <?php } ?>
    </select>
</div>
<div style="clear:both;"></div>