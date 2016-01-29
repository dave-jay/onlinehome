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
                <td style="font-weight:bold;background-color:#e4f3e5">Agent Name</td>
                <td style="font-weight:bold;background-color:#e4f3e5">Email</td>
                <td style="font-weight:bold;background-color:#e4f3e5">Phone</td>
            </tr>
            <?php foreach ($agents as $each_agents): ?>
                <tr>
                    <td>
                        <div><?php print $each_agents['name'] ?></div>
                    </td>
                    <td><div><?php print $each_agents['email'] ?></div></td>
                    <td><div><input type="text" class="form-control" value="<?php print $each_agents['phone'] ?>" onblur="doSavePhone(this.value, '<?php print $each_agents['id'] ?>')" /></div></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

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
</style>