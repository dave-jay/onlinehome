<div id="soundDialog" class="sound-dialog" title="Reservation Sound" style="display: none;">
    <p>
        <audio id="soundAudio" controls style="margin-top: 10px;">
            <source id="soundSrc" type="audio/wav">
        </audio>
    </p>
    <div>
        <button type="button" style="margin-left: 20px;" onclick="restart();" title="Repeat" ><i class='fa fa-repeat'></i></button>        
        <button type="button"  onclick="fastbackward();" title="Fast Rewind"><i class='fa fa-fast-backward'></i></button>        
        <button type="button"  onclick="backward();" title="Rewind" ><i class='fa fa-chevron-left'></i></button>
        <button type="button"  onclick="forward();" title="Forward"><i class='fa fa-chevron-right'></i></button>
        <button type="button"  onclick="fastforward();" title="Fast Forward"><i class='fa fa-fast-forward'></i></button>
        <button type="button"  onclick="download();" title="Download"><i class='fa fa-download'></i></button>
    </div>
</div>

<div style="padding: 7px; color: #86b414; font-size: 18px; border-bottom: 1px solid #86b414;">
    Call Report
</div>

<div class="col-md-12 col-sm-12" style="margin-top:10px;">
    <form action="" method="post">
        <div class="col-md-4 col-sm-12 col-xs-12">&nbsp;</div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <input class="form-control" type="text" name="start_date" id="start_date" value="<?php print $from_date; ?>" placeholder="Start Date" required/>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <input class="form-control" type="text" name="end_date" id="end_date" value="<?php print $to_date; ?>" placeholder="End Date" required/>
        </div>
        <div style="padding-left:0px;padding-right:0px;" class="col-md-2 col-sm-12 col-xs-12"><button type="submit" class="btn btn-success">Search</button>&nbsp;<button type="button" onclick="return ResetPage()" class="btn btn-default">Reset</button></div>
        <div style="clear:both;"></div>
    </form>
</div>

<div class="page_body">
    <div class="panel-body">           
        <div class="clear-space" style='clear: both;'>&nbsp;</div>
        <table class="table gray_table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Agent</th>
                    <th>Agent Phone</th>
                    <th>Customer Phone</th>
                    <th>Date</th>
                    <th>Duration</th>
                    <th>Record</th>
                    <th>Download</th>

                </tr>
            </thead>
            <tbody>
                <?php if (count($call_list) > 0): $cnt = 1; ?>
                    <?php foreach ($call_list as $each_call) { ?>
                        <tr>
                            <td><?php echo $cnt; ?></td>
                            <td><?php echo ($each_call['agent_id'] == 0 ? '-' : $each_call['agent_id'] . "<br>" . $each_call['agent_name']); ?></td>
                            <td><?php echo $each_call['agent_phone']; ?></td>
                            <td><?php echo $each_call['customer_phone']; ?></td>
                            <td><?php echo date('m/d/Y g:i A', strtotime($each_call['created_at'])); ?></td>
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
                ?>
            <?php else: ?>
                <td colspan="10" class='error'>No record found!</td>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script>
        var last_id = '';
        var is_play = '0';
        var audio;
        function play_record(id) {

            var path = $("#hid_rec_" + id).val();
            if (path == '') {
                alert('No Recording for the call');
            } else {
                if (is_play == '1' && last_id == id) {
                    is_play = '0';
                    audio.pause();
                    $("#play_btn_" + id).html("Play");
                } else if (is_play == '0' && last_id == id) {
                    is_play = '1';
                    audio.play();
                    $("#play_btn_" + id).html("Pause");
                } else {
                    if (last_id != '') {
                        audio.pause();
                        audio.currentTime = 0;
                    }
                    audio = new Audio(path); //incoming_call.mp3
                    audio.play();
                    last_id = id;
                    is_play = '1';
                    $(".play_btn").html("Play");
                    $("#play_btn_" + id).html("Pause");
                }
            }
        }
    </script>
    <style>
        .form-lbl{
            padding-top: 4px;
        }
        
        #soundDialog button {
    margin-right: 8px;
    padding: 2px 9px;
}

.ui-dialog-titlebar-close {
  visibility: hidden;
}

    </style>


</div>

