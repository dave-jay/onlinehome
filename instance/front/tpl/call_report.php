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
        <div class="col-lg-5">
            <div  style="border: 1px solid #1294d5;border-radius: 7px;padding:10px;">
                <div class="col-lg-12">
                    <label>Source: </label>
                    <select class="form-control" id="ddlSource" name="ddlSource">
                        <option value="">Select Source</option>
                        <?php foreach ($_SESSION['pipedrive_source'] as $each_source): ?>
                            <option value="<?= $each_source['pd_source_id']; ?>" <?php _cprint($fil_source, $each_source['pd_source_id'], "selected"); ?>><?= $each_source['source_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div style="clear:both;height: 10px;">&nbsp;</div>
                <div class="col-lg-12">
                    <label>Agent: </label>
                    <input type="text" id="txtAgent" name="txtAgent" class="form-control" value="<?= $fil_agents; ?>" />
                </div>
                <div style="clear:both;height: 10px;">&nbsp;</div>
                <div class="col-lg-12">
                    <label>Duration: </label>
                    <select class="form-control" id="ddlDateRange" name="ddlDateRange">
                        <option value="ALL_TIME" <?php _cprint($fil_duration, "ALL_TIME", "selected"); ?>>All Time</option>
                        <option value="TODAY" <?php _cprint($fil_duration, "TODAY", "selected"); ?>>Today</option>
                        <option value="YESTERDAY" <?php _cprint($fil_duration, "YESTERDAY", "selected"); ?>>Yesterday</option>
                        <option value="CURRENT_WEEK" <?php _cprint($fil_duration, "CURRENT_WEEK", "selected"); ?>>Current Week</option>
                        <option value="CURRENT_MONTH" <?php _cprint($fil_duration, "CURRENT_MONTH", "selected"); ?>>Current Month</option>
                        <option value="CUSTOM" <?php _cprint($fil_duration, "CUSTOM", "selected"); ?>>Select Dates</option>
                    </select>
                </div>
                <div style="clear:both;height: 10px;">&nbsp;</div>
                <div class="col-lg-12">
                    <div id="CustomDateBlock" style="<?php echo ($fil_duration == "CUSTOM" ? "" : "display:none;"); ?>">
                        <input class="form-control" type="text" name="start_date" id="start_date" value="<?php print $fil_from_date; ?>" placeholder="Start Date"/>
                        <div class="line-break" style="height: 10px;"></div>
                        <input class="form-control" type="text" name="end_date" id="end_date" value="<?php print $fil_to_date; ?>" placeholder="End Date"/>
                        <div class="line-break"></div>
                        <div>&nbsp;</div>
                    </div>
                </div>  
                <div style="clear:both;"></div>
                <div style="" class="col-lg-12">
                    <div style="" class="col-lg-6">
                        <button type="submit" class="btn btn-info" style='width: 100%;background-color: #1294D5;border-color: #1294D5;' id="btnSearch">Search</button>
                    </div>
                    <div style="" class="col-lg-6">
                        <button type="button" onclick="return ResetPage()" style='width: 100%;' class="btn btn-default">Reset</button>
                    </div>
                </div>
                <div style="clear:both;"></div>
            </div>
        </div>
        <div class="col-lg-7">
            <div  style="border: 1px solid #1294d5;border-radius: 7px;padding:10px;">
                <div class="col-lg-4 my_circle">
                    <div class='my_circle_number'><div id="circle_no_call">--</div></div>
                    <div class='my_circle_label'>Calls</div>
                </div>
                <div class="col-lg-4 my_circle">
                    <div class='my_circle_number'><div id="circle_no_day">--</div></div>
                    <div class='my_circle_label'>Days</div>
                </div>
                <div class="col-lg-4 my_circle">
                    <div class='my_circle_number' style='font-size:26px;'><div id="circle_call_duration">--</div></div>
                    <div class='my_circle_label'>Call Duration</div>
                </div>
                <div style="clear:both;"></div>
            </div>
        </div>
    </form>
</div>

<div class="page_body">
    <div class="panel-body">           
        <div class="clear-space" style='clear: both;'>&nbsp;</div>
        <table class="table gray_table">
            <thead>
                <tr>
                    <td style="font-weight:bold;background-color:#1294d5;color:white;display:none;">#</td>
                    <td style="font-weight:bold;background-color:#1294d5;color:white; padding-left: 20px;">Deal</td>
                    <td style="font-weight:bold;background-color:#1294d5;color:white;">Customer</td>
                    <td style="font-weight:bold;background-color:#1294d5;color:white;">Call Log</td>
                    <td style="font-weight:bold;background-color:#1294d5;color:white;">Date</td>
                    <td style="font-weight:bold;background-color:#1294d5;color:white;">Duration</td>
                    <td style="font-weight:bold;background-color:#1294d5;color:white;">Record</td>
                    <td style="font-weight:bold;background-color:#1294d5;color:white;">Download</td>

                </tr>
            </thead>
            <tbody id="body_detail">
                <?php include _PATH . "instance/front/tpl/call_report_data.php"; ?>
            </tbody>
        </table>
        <div id="divDataLoading" style="text-align: center; margin-top: -25px;display:none;">
            <img src="<?php print _MEDIA_URL ?>img/Loading.gif">
        </div>
    </div>
    <input type="hidden" id="hidPageSize" name="hidPageSize" value="<?= $page_size; ?>" />
    <input type="hidden" id="hidLastRecord" name="hidLastRecord" value="<?= $page_size; ?>" />
    <input type="hidden" id="hidTotalRecord" name="hidTotalRecord" value="" />
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
        #body_detail td{
            background-color: #E8F6FF;
        }
        .log-lbl-seperator{
            height: 4px;
        }
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
        .my_circle{
            text-align: center;
        }
        .my_circle .my_circle_number{
            background-color: #1294D5;
            border-radius: 50%;
            font-family: verdana;
            font-size: 30px;
            height: 150px;
            margin: 0 auto;
            text-align: center;
            width: 150px;
            display: table;
        }
        .my_circle .my_circle_number div{
            display: table-cell;
            vertical-align: middle;
        }
        .my_circle .my_circle_label{
            font-family: verdana;
            font-size: 20px;
        }
    </style>


</div>
<div class="modal fade" id="TimelinePopup" >
    <div class="modal-dialog" style="width: 800px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Time Line - <span id="deal_nm"></span></h4>

            </div>
            <div class="modal-body" style="height:350px;overflow: auto;" >
                <div id="user_selection_area" style="margin:0px auto;">
                    <table style="margin: 0 auto;" id="timeline">                        
                    </table>                   
                    <div style="clear: both;"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<style>
    .timeline-date{
        background-color: brown;
        border-radius: 1000px;
        color: white;
        font-size: 18px;
        height: 100px;
        width: 100px;
        padding-top: 25px;
        text-align: center;
    }
    .left-block{
        width:250px;
        text-align: right;
    }
    
    .middle-block{
        width:100px;
        text-align: center;
        background: url("instance/front/media/img/today_marker.png") no-repeat scroll center center;
    }
    .right-block{
        width:250px;
        text-align: left;
    }    
    .timeline-log{
        background-color: #1294d5; 
        text-align: left; 
        padding: 10px; 
        color: white; 
        font-size: 15px;
        display: inline-block;
        width: 210px;

    }    
    .timeline-circle{
        background-color: white; 
        border: 1px solid red;
        border-radius: 100px;
        display: inline-block;
        height: 20px;
        width: 20px;        
    }
    .timeline-line{
        height: 1px; 
        display: block; 
        width: 100px; 
        border: 0px none; 
        margin-top: -10px; 
        background-color: black;
    }
    .timeline-time{
        background-color: green; 
        text-align: center;         
        padding: 10px; 
        color: white; 
        font-size: 15px;
        display: inline-block;
        width: 100px;
        margin-top: 7px;
    }
    
    .right-block .timeline-time{
        border-radius: 100px  100px 100px 100px;
    }
    .left-block .timeline-time{
        border-radius:  100px 100px 100px 100px;
    }
    
    .left-block .timeline-log,.left-block .timeline-time{
        margin-right: -8px;
    }
    .right-block .timeline-log,.right-block .timeline-time{
        margin-left: -8px;
    }
    
</style>

