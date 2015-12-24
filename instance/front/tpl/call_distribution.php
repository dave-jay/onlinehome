<div style="padding: 7px; color: #86b414; font-size: 18px; border-bottom: 1px solid #86b414;">
    Call Distribution
</div>

<div class="page_body">
    <div class="panel-body">   
        <form action="" method="post" id="userForm" novalidate="novalidate">
            <table class="table" border='0' style="width:100%;">
                <tr>
                    <td style="width:25%;font-weight:bold;">Lead Source</td>
                    <td style="width:75%;font-weight:bold;">Agent List</td>
                </tr>
                <?php if (!empty($source_list)): ?>
                    <?php foreach ($source_list as $each_source): ?>
                        <tr>
                            <td style="width:25%;font-weight:bold;"><?php echo $each_source["source_name"] ?></td>
                            <td style="width:75%;">
                                <?php
                                $source_user_list = array();
                                $source_user_list_ids = array();
                                $source_user_list = Call_distribution::GetSourceUserIdList($each_source["pd_source_id"]);
                                if (!empty($source_user_list)) {
                                    if (trim($source_user_list["pd_user_id"]) != '' && trim($source_user_list["pd_user_id"]) != '[]') {
                                        $source_user_list_ids = json_decode(trim($source_user_list["pd_user_id"]), true);
                                    }
                                }
                                ?>
                                <?php if (!empty($user_list)): ?>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <?php foreach ($user_list as $each_user): ?>
                                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="padding:2px 10px;">
                                                <?php
                                                $checcked_user = '';
                                                if (in_array($each_user["pd_id"], $source_user_list_ids)) {
                                                    $checcked_user = "checked='checked'";
                                                }
                                                ?>
                                                <label style="font-weight:normal;"><input type="checkbox" name="fields[call][<?php print $each_source["pd_source_id"]; ?>][<?php print $each_user["pd_id"]; ?>]" id="user_<?php print $each_user["pd_id"] ?>_<?php print $each_source["pd_source_id"] ?>" <?php print $checcked_user; ?> />&nbsp;&nbsp;<?php echo $each_user["name"]; ?></label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    Agent Not Available
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2">Record Not Available</td>
                    </tr>
                <?php endif; ?>

            </table>

            <div class="clear-space hidden-lg hidden-md">&nbsp;</div>

            <div class="clear-space">&nbsp;</div>

            <div class="footer-btn-panel">
                <input type="hidden" value="1" name="update_call" id="update_call">
                <button id="btn_submit" class="btn green-btn" type="submit">Update</button>
                <input id="btn_cancel" type="button" class="btn white-btn" value="Cancel" onclick="javascript:location.reload();">
            </div>
        </form>
    </div>
    <script>
        $("#userForm").validate({
            rules: {
                txt_account_sid: "required"
            },
            messages: {
                txt_account_sid: "Please enter api key"

            }
        });

        $("#btn_cancel").click(function () {
            $("#txt_account_sid").val($("#hid_sid").val());
            $("#txt_auth_token").val($("#hid_token").val());
        });
    </script>
    <style>
        .form-lbl{
            padding-top: 4px;
        }
    </style>


</div>

