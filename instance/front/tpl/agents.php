<div style="padding: 7px; color: #86b414; font-size: 18px; border-bottom: 1px solid #86b414;">
    Pipedrive Agents List
</div>

<div class="page_body">
    <div class="panel-body" style="padding-left:0px;padding-right:0px;">   
        <table class="table" border='0' style="width:100%;">
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
</script>
