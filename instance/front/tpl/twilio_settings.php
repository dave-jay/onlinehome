<div style="padding: 7px; color: #86b414; font-size: 18px; border-bottom: 1px solid #86b414;">
    Twilio Settings 
</div>

<div class="page_body">
    <div class="panel-body">   
        <form action="" method="post" id="userForm" novalidate="novalidate">
            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                <label class="form-lbl">Twilio Account SID : </label>
            </div>
            <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                <input value="<?php echo $TWILIO_ACCOUNT_SID['value']; ?>" name="txt_account_sid" id="txt_account_sid" class="form-control">
            </div>   
            <div class="clear-space" style="clear:both;">&nbsp;</div>
            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                <label class="form-lbl">Twilio Auth Token : </label>
            </div>
            <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                <input value="<?php echo $TWILIO_AUTH_TOKEN['value']; ?>" name="txt_auth_token" id="txt_auth_token" class="form-control">
            </div>   
            <div class="clear-space hidden-lg hidden-md">&nbsp;</div>

            <div class="clear-space">&nbsp;</div>

            <div class="footer-btn-panel">
                <input type="hidden" value="<?php echo $TWILIO_ACCOUNT_SID['value']; ?>" name="hid_sid" id="hid_sid">
                <input type="hidden" value="<?php echo $TWILIO_ACCOUNT_SID['id']; ?>" name="hid_sid_id" id="hid_sid_id">
                <input type="hidden" value="<?php echo $TWILIO_AUTH_TOKEN['value']; ?>" name="hid_token" id="hid_token">
                <input type="hidden" value="<?php echo $TWILIO_AUTH_TOKEN['id']; ?>" name="hid_token_id" id="hid_token_id">
                <button id="btn_submit" class="btn green-btn" type="submit">Update</button>
                <input id="btn_cancel" type="button" class="btn white-btn" value="Cancel">
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
        
        $("#btn_cancel").click(function(){
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

