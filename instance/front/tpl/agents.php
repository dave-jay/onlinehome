<div class="MyPageHeader">
    Pipedrive Agents List
    <div class="TopRight" onclick="syncUser()">
        <i class="glyphicon glyphicon-refresh"></i>
        Sync User With Pipedrive
    </div>
</div>

<div class="page_body">
    <div class="panel-body" style="padding-left:0px;padding-right:0px;">   
        <table class="table" border='0' style="width:100%;" id="tblAgents">
            <?php include _PATH . 'instance/front/tpl/agents_data.php'; ?>
        </table>
    </div>
</div>

<div class="modal fade" id="selectAgentPopup" >
    <div class="modal-dialog" style="width:800px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Edit Agent Detail<span id="deal_nm"></span></h4>

            </div>
            <div class="modal-body" style="height:350px;overflow: auto;" >
                <div id="row">
                    <div class="col-lg-3 col-lg-offset-1" style='text-align: right;'>
                        <label>Agent Name</label>
                    </div>
                    <div class="col-lg-7">
                        <div id="txtAgentName"></div>
                    </div>
                    <div style="clear: both;height: 18px;"></div>
                    <div class="col-lg-3 col-lg-offset-1" style='text-align: right;'>
                        <label>Password</label>
                    </div>
                    <div class="col-lg-7">
                        <input type="password" class="form-control" id="txtPass" name="txtPass" />
                        <label class="helptext">Password for access email '<span id='sp_email'></span>'.</label>
                        <br>
                        <a href="https://www.google.com/settings/security/lesssecureapps" target="_blank" style='color:blue;'>Click Here</a> and Set 'Allow less secure apps' to 'ON' to send email sequence by above email address.
                    </div>
                    <div style="clear: both;height: 12px;"></div>
                    <div class="col-lg-3 col-lg-offset-1" style='text-align: right;'>
                        <label>Group</label>
                    </div>
                    <div class="col-lg-7">
                        <select id="ddlGroup" name="ddlGroup"  class="form-control">
                            <option value="A">A - Higher Level</option>
                            <option value="B">B - Middle Level</option>
                            <option value="C">C - Lower Level</option>
                        </select>
                    </div>
                    <div style="clear: both;height: 18px;"></div>
                    <div class="col-lg-3 col-lg-offset-1" style='text-align: right;'>
                        <label>Agent Phone Number</label>
                    </div>
                    <div class="col-lg-7">
                        <input type="text" class="form-control" id="txtPhone" name="txtPhone" />
                        <label class="helptext">On this number automated call will be initiated</label>
                    </div>
                    <div style="clear: both;height: 14px;"></div>
                    <div class="col-lg-3 col-lg-offset-1" style='text-align: right;'>
                        <label>Agent Cell Number</label>
                    </div>
                    <div class="col-lg-7">
                        <input type="text" class="form-control" id="txtCell" name="txtCell" />
                        <label class="helptext">On this number customer will reply to SMS</label>
                    </div>
                    <div style="clear: both;height: 12px;"></div>

                    <div class="col-lg-3 col-lg-offset-1" style='text-align: right;'>
                        <label>Agent LinkedIn Link</label>
                    </div>
                    <div class="col-lg-7">
                        <input type="text" class="form-control" id="txtlinkdin" name="txtlinkdin" />
                        <label class="helptext">Agent LinkedIn Profile URL</label>
                    </div>
                    <div style="clear: both;height: 12px;"></div>
                    <div class="col-lg-3 col-lg-offset-1" style='text-align: right;'>
                        <label>Agent Role</label>
                    </div>
                    <div class="col-lg-7">
                        <input type="text" class="form-control" id="txtroleno" name="txtroleno" />
                        <label class="helptext">Agent Role (i.e. Sales Agent, Sales Manager etc)</label>
                    </div>
                    <div style="clear: both;height: 12px;"></div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="pd_user_id" id="pd_user_id" value="" />
                <button type="button" class="btn btn-success process_cls_submit" onclick="SaveContact()" >Update</button>
                <button type="button" class="btn btn-success submit_wait_process_btn" style="display:none;cursor:none;">Please Wait..</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<style>
    #tblAgents div.group-A{
        background-color: darkgreen; display: inline-block; border-radius: 89px; color: white; height: 20px; padding: 0px 6px;
    }
    #tblAgents div.group-B{
        background-color: #1d991d; display: inline-block; border-radius: 89px; color: white; height: 20px; padding: 0px 6px;
    }
    #tblAgents div.group-C{
        background-color: lightgreen; display: inline-block; border-radius: 89px; color: black; height: 20px; padding: 0px 6px;
    }

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
    .tooltip-inner{
        color: white !important;
    }
    .TopRight{
        position: absolute; 
        top: 12px; 
        cursor: pointer; 
        padding: 1px 8px; 
        border-radius: 3px; 
        background-color: yellowgreen; 
        right: 10px; 
        color: white; 
        font-weight: bold; 
        font-size: 12px;
    }
    .helptext {
        color: gray;
        font-weight: normal;
    }
</style>