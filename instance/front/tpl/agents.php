<div style="padding: 7px; color: #86b414; font-size: 18px; border-bottom: 1px solid #86b414;">
    Pipedrive Agents List
    <div class="TopRight" onclick="syncUser()">
    <i class="glyphicon glyphicon-refresh"></i>
      Sync User With Pipedrive
  </div>
</div>

<div class="page_body">
    <div class="panel-body" style="padding-left:0px;padding-right:0px;">   
        <table class="table" border='0' style="width:100%;" id="tblAgents">
            <tr>
                <td style="width: 20%;font-weight:bold;background-color:#e4f3e5">Agent Name</td>
                <td style="width: 30%;font-weight:bold;background-color:#e4f3e5">Email</td>
                <td style="width: 20%;font-weight:bold;background-color:#e4f3e5">Phone</td>
                <td style="width: 20%;font-weight:bold;background-color:#e4f3e5">Agent Cell Number</td>
                <td style="width: 10%;font-weight:bold;background-color:#e4f3e5">Action</td>
            </tr>
            <?php foreach ($agents as $each_agents): ?>
                <tr>
                    <td>
                        <div id="<?=  "div_".$each_agents['id']."_agent_name"; ?>"><?php print $each_agents['name']; ?></div>
                    </td>
                    <td><div><?php print $each_agents['email'] ?></div></td>
                    <td><div id="<?=  "td_".$each_agents['id']."_phone"; ?>"><?php print $each_agents['phone']==''?'-':$each_agents['phone'] ?></div></td>
                    <td><div id="<?=  "td_".$each_agents['id']."_cell"; ?>"><?php print $each_agents['cell']==''?'-':$each_agents['cell'] ?></div></td>
                    <td><div onclick="doOpenEditPopup('<?php print $each_agents['id'] ?>')" style="cursor: pointer;color:#BD7A1B;"><i class="fa fa-edit"></i>&nbsp;Edit</div></td>
<!--                    <td><div><input type="text" class="form-control" value="<?php print $each_agents['phone'] ?>" onblur="doSavePhone(this.value, '<?php print $each_agents['id'] ?>')" /></div></td>
                    <td><div><input type="text" class="form-control" value="<?php print $each_agents['cell'] ?>" onblur="doSaveCell(this.value, '<?php print $each_agents['id'] ?>')" /></div></td>-->
                </tr>
            <?php endforeach; ?>
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
<script type="text/javascript">
    function doSavePhone(value, id) {
        if(value == ''){
            return;
        }
        showWait();
        $.ajax({
            url: _U + 'agents',
            data: {doUpdateAgent:id,value:value},
            success: function(r) {
                hideWait();
                _success("Agent phone updated successfully");
                
            }
        });
    }
    function doSaveCell(value, id) {
        if(value == ''){
            return;
        }
        showWait();
        $.ajax({
            url: _U + 'agents',
            data: {doUpdateAgentCell:id,value:value},
            success: function(r) {
                hideWait();
                _success("Agent Cell Number updated successfully");
                
            }
        });
    }
    function syncUser(){
        showWait();
        $.ajax({
            url: _U + 'agents',
            data: {syncUser:1},
            success: function(r) {
                updateUser();
            }
        });
    }
    function updateUser(){
        $.ajax({
            url: _U + 'agents',
            data: {updateUser:1},
            success: function(r) {
                $("#tblAgents").html(r);
                 hideWait();
                _success("Users sync with pipedrive successfully");
                
            }
        });
    }
    function doOpenEditPopup(id){
        $("#pd_user_id").val(id);
        $("#txtAgentName").html($("#div_"+id+"_agent_name").html());
        $("#txtPhone").val($("#td_"+id+"_phone").html()=="-"?'':$("#td_"+id+"_phone").html());
        $("#txtCell").val($("#td_"+id+"_cell").html()=="-"?'':$("#td_"+id+"_cell").html());        
        $("#selectAgentPopup").modal("show");
        
    }
    function SaveContact(){
        showWait();
        var id=$("#pd_user_id").val();
        var phone=$("#txtPhone").val();
        var cell=$("#txtCell").val();
        $.ajax({
            url: _U + 'agents',
            data: {doUpdateContact:id,phone:phone,cell:cell},
            success: function(r) {
                hideWait();
                if(r.toString()=="1"){
                    $("#td_"+id+"_phone").html(phone==''?'-':phone);
                    $("#td_"+id+"_cell").html(cell==''?'-':cell);
                    $("#selectAgentPopup").modal("hide");
                    _success("Agent Detail updated successfully");
                }else if(r.toString()=="0"){
                    $("#selectAgentPopup").modal("hide");
                    _error("No rows to update");
                }else{
                    $("#selectAgentPopup").modal("hide");
                    _error("Can not Update Agent Detail. Please Try Again.");
                }
                
            }
        });
    }
    
</script>
<style> 
    .TopRight{
        position: absolute; 
        top: 12px; 
        cursor: pointer; 
        padding: 1px 8px; 
        border-radius: 3px; 
        background-color: #f0ad4e; 
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