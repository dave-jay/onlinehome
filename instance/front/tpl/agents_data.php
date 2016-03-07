<tr>
                <td style="width: 20%;font-weight:bold;background-color:#1294d5;color:white">Agent Name</td>
                <td style="width: 30%;font-weight:bold;background-color:#1294d5;color:white">Email</td>
                <td style="width: 20%;font-weight:bold;background-color:#1294d5;color:white">Phone</td>
                <td style="width: 20%;font-weight:bold;background-color:#1294d5;color:white">Agent Cell Number</td>
                <td style="width: 10%;font-weight:bold;background-color:#1294d5;color:white">Action</td>
            </tr>
<?php foreach ($agents as $each_agents): ?>
    <tr>
        <td>
                        <div id="<?=  "div_".$each_agents['id']."_agent_name"; ?>"><?php print $each_agents['name']; ?></div>
                    </td>
                    <td><div><?php print $each_agents['email'] ?></div></td>
                    <td><div id="<?=  "td_".$each_agents['id']."_phone"; ?>"><?php print $each_agents['phone']==''?'-':$each_agents['phone'] ?></div></td>
                    <td><div id="<?=  "td_".$each_agents['id']."_cell"; ?>"><?php print $each_agents['cell']==''?'-':$each_agents['cell'] ?></div></td>
                    <td><div onclick="doOpenEditPopup('<?php print $each_agents['id'] ?>')" style="cursor: pointer;color:#1294d5;"><i class="fa fa-edit"></i>&nbsp;Edit</div></td>
<!--                    <td><div><input type="text" class="form-control" value="<?php print $each_agents['phone'] ?>" onblur="doSavePhone(this.value, '<?php print $each_agents['id'] ?>')" /></div></td>
                    <td><div><input type="text" class="form-control" value="<?php print $each_agents['cell'] ?>" onblur="doSaveCell(this.value, '<?php print $each_agents['id'] ?>')" /></div></td>-->
    </tr>
<?php endforeach; ?>