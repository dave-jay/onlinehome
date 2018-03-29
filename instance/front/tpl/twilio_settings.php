<div class="MyPageHeader">
    Twilio Settings 
</div>

<div class="page_body">
    <div class="panel-body">   
        <form action="" method="post" id="userForm" novalidate="novalidate">
            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                <label class="form-lbl">Twilio Account SID : </label>
            </div>
            <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                <input value="<?php echo $conf_data['TWILIO_ACCOUNT_SID']; ?>" name="txt_account_sid" id="txt_account_sid" class="form-control">
            </div>   
            <div class="clear-space" style="clear:both;">&nbsp;</div>
            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                <label class="form-lbl">Twilio Auth Token : </label>
            </div>
            <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                <input value="<?php echo $conf_data['TWILIO_AUTH_TOKEN']; ?>" name="txt_auth_token" id="txt_auth_token" class="form-control">
            </div>   
            <div class="clear-space" style="clear:both;">&nbsp;</div>

            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                <label class="form-lbl">Twilio Phone #1 : </label>
            </div>
            <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                <input value="<?php echo $conf_data['TWILIO_PHONE_1']; ?>" name="txt_phone1" id="txt_phone1" class="form-control">
            </div>   
            <div class="clear-space" style="clear:both;">&nbsp;</div>
            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                <label class="form-lbl">Twilio Phone #2 : </label>
            </div>
            <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                <input value="<?php echo $conf_data['TWILIO_PHONE_2']; ?>" name="txt_phone2" id="txt_phone2" class="form-control">
            </div>   
            <div class="clear-space hidden-lg hidden-md">&nbsp;</div>

            
            <div class="clear-space">&nbsp;</div>

            <div class="footer-btn-panel">                
                <input type="hidden" value="<?php echo $first_time; ?>" name="is_first_time" id="is_first_time">
                <?php if($first_time==1): ?>
                    <button id="btn_submit" class="btn green-btn" type="submit">Save & Continue</button>
                <?php else: ?>
                    <button id="btn_submit" class="btn green-btn" type="submit">Update</button>
                <?php endif; ?>
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

