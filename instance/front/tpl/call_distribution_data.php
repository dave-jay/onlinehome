<tr>
    <td style="font-weight:bold;background-color:#1294d5;color:white">Deal Source</td>
    <td style="font-weight:bold;background-color:#1294d5;color:white">Total Agent</td>
    <td style="width:19%;font-weight:bold;background-color:#1294d5;color:white;">Is Active?<br>
        <span style="font-weight: normal; font-size: 11px;">Note: Followup Sequence will work only for 'Active' source.</span></td>
    <td style="font-weight:bold;background-color:#1294d5;color:white">Edit</td>
</tr>
<?php if (!empty($source_list)): ?>
    <?php
    foreach ($source_list as $each_source):
        $bg_color = ($each_source['is_active'] == 1) ? "background-color: #E6E6FA;" : "";
        ?>
        <tr style="<?= $bg_color; ?>">
            <td style="font-weight:bold;"><?php echo $each_source["source_name"] ?>

                <?php if ($each_source['is_active'] == 1): ?>
                    &nbsp;<i style="cursor: pointer;color:black;" class="fa fa-check-circle-o defaultOwner"data-toggle="tooltip" title="Default Owner" data-placement="top"></i>
                <?php endif; ?>
            </td>
            <td style="">
                <?php
                $source_user_list = array();
                $source_user_list_ids = array();
                $source_user_list = Call_distribution::GetSourceUserIdList($each_source["pd_source_id"]);
                if (!empty($source_user_list)) {
                    if (trim($source_user_list["pd_user_id"]) != '' && trim($source_user_list["pd_user_id"]) != '[]') {
                        $source_user_list_ids = json_decode(trim($source_user_list["pd_user_id"]), true);
                    }
                }
                ?>                                
                <?php echo count($source_user_list_ids); ?>
            </td>
            <?php if ($each_source['is_active'] == 1): ?>
                <td><div class="defaultOwner" data-toggle="tooltip" title="Click to inactive" data-placement="top" onclick="RemoveFromActive('<?php print $each_source['id'] ?>')" style="cursor: pointer;color:maroon;width: fit-content;width: -moz-fit-content;"><i class="fa fa-minus-square-o"></i>&nbsp;Click to Inactive</div></td>
            <?php else: ?>
                <td><div class="defaultOwner" data-toggle="tooltip" title="Click to active" data-placement="top" onclick="AddtoActive('<?php print $each_source['id'] ?>')" style="cursor: pointer;color:green;width: fit-content;width: -moz-fit-content;"><i class="fa fa-check-square-o"></i>&nbsp;Click to Active</div></td>
            <?php endif; ?>
            <td><label class="label label-success" style="cursor:pointer;font-size:12px;" onclick="return OpenEditPopup('<?php print $each_source['id']; ?>')">Edit</label></td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="2">Record Not Available</td>
    </tr>
<?php endif; ?>