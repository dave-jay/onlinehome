<tr>
    <td style="width: 18%;font-weight:bold;background-color:#1294d5;color:white;">Agent Name</td>
    <td style="width: 5%;font-weight:bold;background-color:#1294d5;color:white;">Group</td>
    <td style="width: 22%;font-weight:bold;background-color:#1294d5;color:white;">Email</td>
    <td style="width: 13%;font-weight:bold;background-color:#1294d5;color:white;">Phone</td>
    <td style="width: 13%;font-weight:bold;background-color:#1294d5;color:white;">Agent Cell Number</td>
    <td style="width: 19%;font-weight:bold;background-color:#1294d5;color:white;">Mark As Default Owner<br>
    <span style="font-weight: normal; font-size: 11px;">Note: At a time, only one agent can be mark as default owner</span></td>
    <td style="width: 10%;font-weight:bold;background-color:#1294d5;color:white;">Action</td>
</tr>
<?php foreach ($agents as $each_agents): 
    if($each_agents['is_default']==1): ?>
    <tr style="background-color: #E6E6FA;">
        <td>
            <div id="<?= "div_" . $each_agents['id'] . "_agent_name"; ?>"><?php print $each_agents['name']; ?>&nbsp;<i style="cursor: pointer;color:black;" class="fa fa-check-circle-o defaultOwner"data-toggle="tooltip" title="Default Owner" data-placement="top"></i></div>
        </td>
        <td><div id="<?= "div_" . $each_agents['id'] . "_group"; ?>" class="group-<?php print $each_agents['group']; ?>"><?php print $each_agents['group']; ?></div></td>
        <td><div id="<?= "div_" . $each_agents['id'] . "_email"; ?>"><?php print $each_agents['email'] ?></div></td>
        <td><div id="<?= "td_" . $each_agents['id'] . "_phone"; ?>"><?php print $each_agents['phone'] == '' ? '-' : $each_agents['phone']  ?></div></td>
        <td><div id="<?= "td_" . $each_agents['id'] . "_cell"; ?>"><?php print $each_agents['cell'] == '' ? '-' : $each_agents['cell']  ?></div></td>
        <input type="hidden" id="<?= "hid_" . $each_agents['id'] . "_linkdin"; ?>" value="<?php print $each_agents['linkedin_link']; ?>" />
        <input type="hidden" id="<?= "hid_" . $each_agents['id'] . "_roleno"; ?>" value="<?php print $each_agents['role']; ?>" />
        <input type="hidden" id="<?= "hid_" . $each_agents['id'] . "_pass"; ?>" value="<?php print $each_agents['password']; ?>" />
        <td><div class="defaultOwner" data-toggle="tooltip" title="Remove From Default Owner" data-placement="top" onclick="RemoceFromDefault('<?php print $each_agents['id'] ?>')" style="cursor: pointer;color:maroon;width: fit-content;width: -moz-fit-content;"><i class="fa fa-minus-square-o"></i>&nbsp;Remove from Default Owner</div></td>
        <td><div onclick="doOpenEditPopup('<?php print $each_agents['id'] ?>')" style="cursor: pointer;color:#1294d5;"><i class="fa fa-edit"></i>&nbsp;Edit</div></td>
    </tr>
    <?php else: ?>
    <tr>
        <td>
            <div id="<?= "div_" . $each_agents['id'] . "_agent_name"; ?>"><?php print $each_agents['name']; ?></div>
        </td>
        <td><div id="<?= "div_" . $each_agents['id'] . "_group"; ?>" class="group-<?php print $each_agents['group']; ?>"><?php print $each_agents['group']; ?></div></td>
        <td><div id="<?= "div_" . $each_agents['id'] . "_email"; ?>"><?php print $each_agents['email'] ?></div></td>
        <td><div id="<?= "td_" . $each_agents['id'] . "_phone"; ?>"><?php print $each_agents['phone'] == '' ? '-' : $each_agents['phone']  ?></div></td>
        <td><div id="<?= "td_" . $each_agents['id'] . "_cell"; ?>"><?php print $each_agents['cell'] == '' ? '-' : $each_agents['cell']  ?></div></td>
        <input type="hidden" id="<?= "hid_" . $each_agents['id'] . "_linkdin"; ?>" value="<?php print $each_agents['linkedin_link']; ?>" />
        <input type="hidden" id="<?= "hid_" . $each_agents['id'] . "_roleno"; ?>" value="<?php print $each_agents['role']; ?>" />
        <input type="hidden" id="<?= "hid_" . $each_agents['id'] . "_pass"; ?>" value="<?php print $each_agents['password']; ?>" />
        <td><div class="defaultOwner" data-toggle="tooltip" title="Mark As Default" data-placement="top" onclick="MarkAsDefault('<?php print $each_agents['id'] ?>')" style="cursor: pointer;color:green;width: fit-content;width: -moz-fit-content;"><i class="fa fa-check-square-o"></i>&nbsp;Mark As Default</div></td>
        <td><div onclick="doOpenEditPopup('<?php print $each_agents['id'] ?>')" style="cursor: pointer;color:#1294d5;"><i class="fa fa-edit"></i>&nbsp;Edit</div></td>
    </tr>
    <?php endif; ?>
<?php endforeach; ?>