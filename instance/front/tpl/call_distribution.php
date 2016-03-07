<div class="MyPageHeader">
    Call Distribution Settings
</div>

<div class="page_body">
    <div class="panel-body" style="padding-left:0px;padding-right:0px;">   
        <form action="" method="post" id="userForm" novalidate="novalidate">
            <table class="table" border='0' style="width:100%;">
                <tr>
                    <td style="font-weight:bold;background-color:#1294d5;color:white">Deal Source</td>
                    <td style="font-weight:bold;background-color:#1294d5;color:white">Total Agent</td>
                    <td style="font-weight:bold;background-color:#1294d5;color:white">Edit</td>
                </tr>
                <?php if (!empty($source_list)): ?>
                    <?php foreach ($source_list as $each_source): ?>
                        <tr>
                            <td style="font-weight:bold;"><?php echo $each_source["source_name"] ?></td>
                            <td style="">
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
                                <?php /* if (!empty($user_list)) { ?>
                                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="height:100px;overflow:auto">
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
                                  <?php } else { ?>
                                  Agent Not Available
                                  <?php } */ ?>
                                <?php echo count($source_user_list_ids); ?>
                            </td>
                            <td><label class="label label-success" style="cursor:pointer;font-size:12px;" onclick="return OpenEditPopup('<?php print $each_source['id']; ?>')">Edit</label></td>
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

            <div class="footer-btn-panel" style="height:60px;">
                <!--
                <input type="hidden" value="1" name="update_call" id="update_call">
                <button id="btn_submit" class="btn green-btn" type="submit">Update</button>
                <input id="btn_cancel" type="button" class="btn white-btn" value="Cancel" onclick="javascript:location.reload();">
                -->
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

<div class="modal fade" id="selectAgentPopup" >
    <div class="modal-dialog" style="width:800px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Select Agent For <span id="deal_nm"></span></h4>

            </div>
            <div class="modal-body" style="height:350px;overflow: auto;" >
                <div id="user_selection_area" style="width:505px;margin:0px auto;">

                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="source_pk_id" id="source_pk_id" value="" />
                <button type="button" class="btn btn-success process_cls_submit" onclick="SubmitAgent()" >Update</button>
                <button type="button" class="btn btn-success submit_wait_process_btn" style="display:none;cursor:none;">Please Wait..</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<style>
    .modal-header, .modal-footer{
        background-color: #e4f3e5;
    }
    .modal-header{
        border-top-left-radius: 6px;
        border-top-right-radius: 6px;
    }
    .modal-footer{
        border-bottom-left-radius: 6px;
        border-bottom-right-radius: 6px;
    }
    .btn-success{
        background-color: #5cb85c;
    }
</style>