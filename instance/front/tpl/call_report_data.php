<?php
if (count($call_list) > 0):
    $cnt = ($start_limit+1);
    foreach ($call_list as $each_call) {
        ?>
        <tr>
            <td><?php echo $cnt; ?></td>
            <td><?php echo $_SESSION['pipedrive_source'][$each_call['source_id']]['source_name']; ?></td>
            <td style="max-width:150px; word-wrap: break-word;"><?php
                if ($each_call['customer_name'] != '')
                    echo "<a style='color:#1294D5;' title='View Deal in Pipedrive' target='_blank' href='https://sprout2.pipedrive.com/deal/".$each_call['deal_id']."'>". $each_call['customer_name'] . "</a><br>";
                if ($each_call['customer_phone'] != '')
                    echo $each_call['customer_phone'] . "<br>";
                if ($each_call['customer_email'] != '')
                    echo $each_call['customer_email'];
                ?></td>
            <td><?php echo ($each_call['agent_id'] == 0 ? '-' : $each_call['agent_name']); ?></td>
            <td style="max-width: 120px;">
                <?php 
                    echo "<a style='color: white; cursor: pointer;' class='label label-primary' title='View Deal in Pipedrive' target='_blank' href='https://sprout2.pipedrive.com/deal/".$each_call['deal_id']."'>". $each_call['deal_id'] . "</a><br>"; 
                    echo "<div style='height:2px;'></div>";
                    echo "<a style='color: gray; cursor: pointer;'  title='View Deal in Pipedrive' target='_blank' href='https://sprout2.pipedrive.com/deal/".$each_call['deal_id']."'>". $each_call['org_name'] . "</a><br>"; 
                ?>
            </td>
            <td><?php echo date('m/d/Y', strtotime($each_call['created_at'])) . "<br>" . date('g:i A', strtotime($each_call['created_at'])); ?></td>
            
            <td><?php echo ($each_call['recording_duration'] == 0 ? '00:00:00' : (gmdate("H:i:s", $each_call['recording_duration']))); ?></td>
            <td>
                <?php if ($each_call['recording_url'] == ''): ?>
                    <img src="<?php print _MEDIA_URL . "img/mute.png" ?>" style="cursor: not-allowed;"/>
                <?php else: ?>
                    <img src="<?php print _MEDIA_URL . "img/sound.png" ?>" style="cursor: pointer;" onclick="openAudioFile(<?php echo $each_call['id']; ?>)" />
                <?php endif; ?>
            </td>
            <td>
                <?php if ($each_call['recording_url'] == ''): ?>
                    <div  style="cursor: not-allowed;color:#A6A6A6;" title="No Audio Available"><i class="fa fa-download fa-2x"></i></div>
                <?php else: ?>
                    <div  onclick="download_all(<?php echo $each_call['id']; ?>)"  style="cursor: pointer;"><i class="fa fa-download  fa-2x"></i></div>                                
                <?php endif; ?>
            </td>
        <!--                            <td><button onclick="play_record(<?php echo $each_call['id']; ?>)" id="play_btn_<?php echo $each_call['id']; ?>" class="btn btn-info play_btn">Play</button></td>-->
        <input type="hidden" id="hid_rec_<?php echo $each_call['id']; ?>" value="<?php echo $each_call['recording_url']; ?>" />
        </tr>
        <?php
        $cnt++;
    }
elseif($start_limit==0):
    ?>
    <td colspan="10" class='error'>No record found!</td>
<?php endif; ?>