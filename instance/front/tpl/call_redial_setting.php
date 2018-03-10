<div class="MyPageHeader">
    Call Redial Settings 
</div>

<div class="page_body">
    <div class="panel-body">   
        <form action="" method="post" id="userForm" novalidate="novalidate">
            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                <label class="form-lbl">Call Redial Time : </label>
            </div>
            <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                <select name="txt_api_key" id="txt_api_key" class="form-control">
                    <option <?php echo $pipedriver_api_key['value']==1?"selected":""; ?> value="1">1 minute</option>
                    <option <?php echo $pipedriver_api_key['value']==2?"selected":""; ?> value="2">2 minute</option>
                    <option <?php echo $pipedriver_api_key['value']==5?"selected":""; ?> value="5">5 minute</option>
                    <option <?php echo $pipedriver_api_key['value']==10?"selected":""; ?> value="10">10 minute</option>
                    <option <?php echo $pipedriver_api_key['value']==15?"selected":""; ?> value="15">15 minute</option>
                    <option <?php echo $pipedriver_api_key['value']==20?"selected":""; ?> value="20">20 minute</option>
                </select>
            </div>   
            <div class="clear-space hidden-lg hidden-md">&nbsp;</div>

            <div class="clear-space">&nbsp;</div>

            <div class="footer-btn-panel">
                <input type="hidden" value="<?php echo $pipedriver_api_key['value']; ?>" name="hid_api_key" id="hid_api_key">
                <input type="hidden" value="<?php echo $pipedriver_api_key['id']; ?>" name="hid_is_edit" id="hid_is_edit">
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
                txt_api_key: "required"
            },
            messages: {
                txt_api_key: "Please enter api key"

            }
        });
        
        $("#btn_cancel").click(function(){
           $("#txt_api_key").val($("#hid_api_key").val());
        });
    </script>
    <style>
        .form-lbl{
            padding-top: 4px;
        }
    </style>


</div>

