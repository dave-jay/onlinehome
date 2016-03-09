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

<div class="MyPageHeader">
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
                    <td style="font-weight:bold;background-color:#1294d5;color:white;">#</td>
                    <td style="font-weight:bold;background-color:#1294d5;color:white;">Source</td>                    
                    <td style="font-weight:bold;background-color:#1294d5;color:white;">Customer</td>
                    <td style="font-weight:bold;background-color:#1294d5;color:white;">Answered by</td>
                    <td style="font-weight:bold;background-color:#1294d5;color:white;">Deal Id</td>
                    <td style="font-weight:bold;background-color:#1294d5;color:white;">Date</td>
                    <td style="font-weight:bold;background-color:#1294d5;color:white;">Duration</td>
                    <td style="font-weight:bold;background-color:#1294d5;color:white;">Record</td>
                    <td style="font-weight:bold;background-color:#1294d5;color:white;">Download</td>

                </tr>
            </thead>
            <tbody>
                <?php include  _PATH."instance/front/tpl/call_report_data.php"; ?>
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

