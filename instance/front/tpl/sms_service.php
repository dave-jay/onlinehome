<div class="MyPageHeader">
    SMS Text 
</div>

<div class="page_body">
    <div class="panel-body">   
        <form action="" method="post" id="userForm" novalidate="novalidate">
            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                <label class="form-lbl">Message : </label>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-8 col-xs-8">
                <textarea id='txt_sms' name='txt_sms' class="form-control"></textarea>                
            </div>   
            <div class="clear-space" style='clear: both;'>&nbsp;</div>

            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                <label class="form-lbl">Type : </label>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-8 col-xs-8">
                <select id='ddl_type' name="ddl_type" class="form-control" style=''>
                    <option value='Deal Updated'>Deal Updated</option>
                    <option value='Lead Updated'>Lead Updated</option>
                    <option value='New Hot Lead'>New Hot Lead</option>
                </select>               
            </div>   
            <div class="clear-space" style='clear: both;'>&nbsp;</div>

            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-4" style="padding-right: 0px;">
                <label class="form-lbl">Agent Name : </label>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-8 col-xs-8">
                <select id='ddl_agent' name="ddl_agent" class="form-control" style=''>
                    <option value=''>Select Agent</option>
                    <option value='Alan Pearce'>Alan Pearce</option>
                    <option value='Charle Zamora'>Charle Zamora</option>
                    <option value='Daniel Aronoff'>Daniel Aronoff</option>
                    <option value='Jamal Holley'>Jamal Holley</option>
                    <option value='Nocholas Angiulo'>Nocholas Angiulo</option>
                </select>  
            </div>   
            <div class="clear-space" style='clear: both;'>&nbsp;</div>
            <div class='col-lg-6 col-md-6 col-sm-8 col-xs-8 col-lg-offset-2 col-md-offset-3 col-sm-offset-4 col-xs-offset-4'>
                <input type="hidden" value="<?php echo $pipedriver_api_key['value']; ?>" name="hid_api_key" id="hid_api_key">
                <button id="btn_submit" class="btn green-btn" type="submit">Add</button>
                <input id="btn_cancel" type="button" class="btn gray-btn" value="Cancel">
            </div>
        </form>
        <div class="clear-space" style='clear: both;'>&nbsp;</div>
        <table class="table gray_table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Messages</th>
                    <th>Type</th>
                    <th>Agent</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($message_list) > 0): $cnt=1; ?>
                <?php foreach($message_list as $each_message){ ?>
                <tr>
                    <td><?php echo $cnt; ?></td>
                    <td style='width: 40%;'><?php echo $each_message['sms']; ?></td>
                    <td><?php echo $each_message['activity']; ?></td>
                    <td><?php echo $each_message['agent']; ?></td>
                </tr>
                <?php $cnt++; } ?>
                <?php else: ?>
                <td colspan="10" class='error'>No record found!</td>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script>
        $("#userForm").validate({
            rules: {
                txt_sms: "required",
                ddl_type: "required",
                ddl_agent: "required"
            },
            messages: {
                txt_sms: "Please enter message",
                ddl_type: "Please select message type",
                ddl_agent: "Please select agent name"

            }
        });

        $("#btn_cancel").click(function () {
            $("#txt_sms").val('');
            $("#ddl_type").val('Deal Updated');
            $("#ddl_agent").val('');
        });
    </script>
    <style>
        .form-lbl{
            padding-top: 4px;
        }
    </style>


</div>

