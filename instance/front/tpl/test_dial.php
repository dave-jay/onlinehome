<div style="padding: 7px; color: #86b414; font-size: 18px; border-bottom: 1px solid #86b414;">
    Test Dial 
</div>

<div class="page_body">
    <div class="panel-body">   
        <form action="" method="post" id="userForm" novalidate="novalidate">
            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                <label class="form-lbl">Phone Number : </label>
            </div>
            <div class="col-lg-4 col-md-3 col-sm-8 col-xs-8">
                <input value="" name="txt_api_key" id="txt_api_key" class="form-control">
            </div>   
            <div class="clear-space hidden-lg hidden-md">&nbsp;</div>

            <div class="clear-space">&nbsp;</div>

            <div class="footer-btn-panel">                
                <button id="btn_submit" class="btn green-btn" type="submit">Dial</button>
            </div>
        </form>
    </div>
    <script>
        $("#userForm").validate({
            rules: {
                txt_api_key: "required"
            },
            messages: {
                txt_api_key: "Please enter phone number"

            }
        });
        
    </script>
    <style>
        .form-lbl{
            padding-top: 4px;
        }
    </style>


</div>

