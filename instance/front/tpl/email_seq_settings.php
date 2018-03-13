<div class="MyPageHeader">
    Email Sequence Settings 
</div>

<div class="page_body">
    <div class="panel-body">   
        <form action="" method="post" id="userForm" novalidate="novalidate">
            <div class="form-group">
                <div class="col-lg-1 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                    <label class="form-lbl">Day1 Time : </label>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                    <input value="<?php echo $data['day1_1_sent']['time']; ?>" name="day1_1_sent" id="day1_1_sent" class="form-control">
                </div>  
                <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12"><input type="checkbox" id="chk_day1_1_sent" /><label for="chk_day1_1_sent">&nbsp;Active</label> </div>
            </div>
            <div class="clear-space" style="clear:both;">&nbsp;</div>
            <div class="form-group">
                <div class="col-lg-1 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                    <label class="form-lbl">Day2 Time : </label>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                    <input value="<?php echo $data['day2_1_sent']['time']; ?>" name="day2_1_sent" id="day2_1_sent" class="form-control">
                </div>   <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12"><input type="checkbox" id="chk_day2_1_sent" /><label for="chk_day2_1_sent">&nbsp;Active</label> </div>
            </div>            
            <div class="clear-space" style="clear:both;">&nbsp;</div>
            <div class="form-group">
                <div class="col-lg-1 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                    <label class="form-lbl">Day3 Time : </label>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                    <input value="<?php echo $data['day3_1_sent']['time']; ?>" name="day3_1_sent" id="day3_1_sent" class="form-control">
                </div>
                <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12"><input type="checkbox" id="chk_day3_1_sent" /><label for="chk_day3_1_sent">&nbsp;Active</label> </div>
            </div> 
            <div class="clear-space" style="clear:both;">&nbsp;</div>
            <div class="form-group">
                <div class="col-lg-1 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                    <label class="form-lbl">Day4 Time : </label>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                    <input value="<?php echo $data['day4_1_sent']['time']; ?>" name="day4_1_sent" id="day4_1_sent" class="form-control">
                </div>  
                <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12"><input type="checkbox" id="chk_day4_1_sent" /><label for="chk_day4_1_sent">&nbsp;Active</label> </div>
            </div> 
            <div class="clear-space" style="clear:both;">&nbsp;</div>
            <div class="form-group">
                <div class="col-lg-1 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                    <label class="form-lbl">Day5 Time : </label>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                    <input value="<?php echo $data['day5_1_sent']['time']; ?>" name="day5_1_sent" id="day5_1_sent" class="form-control">
                </div>   
                <div class="col-lg-4 col-md-3 col-sm-12 col-xs-12"><input type="checkbox" id="chk_day5_1_sent" /><label for="chk_day5_1_sent">&nbsp;Active</label> </div>
            </div>
            <div class="clear-space hidden-lg hidden-md">&nbsp;</div>

            <div class="clear-space">&nbsp;</div>

            <div class="footer-btn-panel">
                <input type="hidden" value="<?php echo $pipedriver_api_key['value']; ?>" name="hid_api_key" id="hid_api_key">
                <input type="hidden" value="<?php echo $pipedriver_api_key['id']; ?>" name="hid_is_edit" id="hid_is_edit">
                <input type="hidden" value="<?php echo $first_time; ?>" name="is_first_time" id="is_first_time">
                <?php if ($first_time == 1): ?>
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

        $("#btn_cancel").click(function () {
            $("#txt_api_key").val($("#hid_api_key").val());
        });
    </script>
    <style>
        .form-lbl{
            padding-top: 4px;
        }
    </style>


</div>

