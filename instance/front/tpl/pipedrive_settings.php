<div style="padding: 7px; color: #86b414; font-size: 18px; border-bottom: 1px solid #86b414;">
    PipeDriver Settings 
</div>

<div class="page_body">
    <div class="panel-body">   
        <form action="" method="post" id="userForm" novalidate="novalidate">
            <div class="col-lg-1 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                <label class="form-lbl">Api Key : </label>
            </div>
            <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                <input value="<?php echo $pipedriver_api_key['value']; ?>" name="txt_api_key" id="txt_api_key" class="form-control">
            </div>   
            <div class="clear-space hidden-lg hidden-md">&nbsp;</div>

            <div class="clear-space">&nbsp;</div>

            <div class="footer-btn-panel">
                <input type="hidden" value="<?php echo $pipedriver_api_key['value']; ?>" name="hid_api_key" id="hid_api_key">
                <input type="hidden" value="<?php echo $pipedriver_api_key['id']; ?>" name="hid_is_edit" id="hid_is_edit">
                <button id="btn_submit" class="btn green-btn" type="submit">Update</button>
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

