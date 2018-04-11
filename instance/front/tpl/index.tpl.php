<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title> LeadPropel | <?php print _cg("page_title"); ?></title>
        <link rel="shortcut icon" href="<?php print _MEDIA_URL ?>img/favicon.ico" />
        <link type="text/css" rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/base/jquery-ui.css" />
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php print _MEDIA_URL ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />

        <link href="<?php print _MEDIA_URL ?>css/sidebar.css" rel="stylesheet" type="text/css" />
        <link href="<?php print _MEDIA_URL ?>css/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="<?php print _MEDIA_URL ?>css/jquery.dataTables.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="<?php print _MEDIA_URL ?>js/jquery.validate.min.js"></script>

        <style>            
            body{
                background: url("<?php print _MEDIA_URL ?>img/Optimized-wild_oliva_light.png") repeat scroll 0 0 rgba(0, 0, 0, 0);
                font-family: tahoma;
            } 
        </style>
    </head>
    <body>
        <div class="">            
            <?php if ($no_visible_elements) : ?>
                <?php include $modulePage; ?>
            <?php else: ?> 
                <?php include_once('left.php'); ?>
                <div class="container" style="margin-top: 66px;">                    
                    <div class="row">                        
                        <div id="div_main_content" class="col-lg-12 col-md-12 col-sm-12 col-xs-12 content_body">
                            <?php if (!(@include $modulePage)) : ?>
                                <?php include "404.php"; ?>
                            <?php endif; ?>
                        </div>                        
                    </div>
                </div>	
            <?php endif; ?>
        </div>


<!--<script src="<?php print _MEDIA_URL ?>js/dropzone.min.js"></script>-->

        <?php include "scripts.php"; ?>        

        <?php include $jsInclude; ?>
        <script src="<?php print _MEDIA_URL ?>bootstrap/js/bootstrap.min.js"></script>
        <!-- Start Message Block -->
        <?php include "top_message.php"; ?>
        <!-- End Message Block -->
        <script type="text/javascript">
            $(document).ready(function () {
                var h = $(window).height();
                $("#div_main_content").css("min-height", (h - 70) + "px");
                $(window).resize(function e() {
                    var h = $(window).height();
                    $("#div_main_content").css("min-height", (h - 70) + "px");
                });

            });
        </script>

        <?php if ($error): ?>
            <script type="text/javascript">
                $(document).ready(function () {
                    setTimeout(function () {
                        $('#error_msg_div').fadeOut(1200);
                    }, 3500);
                });
            </script>
        <?php endif; ?>

        <?php if ($greetings): ?>
            <script type="text/javascript">
                $(document).ready(function () {
                    setTimeout(function () {
                        $('#success_msg_div').fadeOut(1200);
                    }, 3500);
                });
            </script>
        <?php endif; ?>

        <div id="waitBar">Please wait</div>
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="alert alert-error" style="">
                            Are you sure you want to take this action ?
                        </div>
                        </br>
                        <div style="text-align:right;">
                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                            <button type="button" class="btn btn-primary" onclick="genericFun()">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                var header_menu_height = $(".header-menu").height();
                if (parseFloat(header_menu_height) > parseInt(50)) {
                    $(".pageheading").css({"margin-top": "25px"});
                }
            });
        </script>

        <script>
            function  changeCallStatus(curr_status){
                if(curr_status=="on"){
                    new_status = "OFF";
                }else{
                    new_status = "ON";
                }
                if(confirm("Are you sure, you want to Turn "+new_status+" Call Distributor?")){
                    
                }else{
                    return;
                }
                if(curr_status=="on"){
                    $("#call_status_img").html('<i class="fa fa-exclamation-triangle"></i> OFF');
                    $("#call_status_img").css("background-color","#CC1E1E");
                    $("#call_status_img").attr("onclick","changeCallStatus('off')");
                }else{
                    $("#call_status_img").html('<i class="fa fa-check"></i> ON');
                    $("#call_status_img").css("background-color","#39891D");
                    $("#call_status_img").attr("onclick","changeCallStatus('on')");
                }
                $.ajax({
                url: _U + 'call_report',
                data: {change_call_status: 1,curr_status:curr_status},
                success: function (r) {
                
                }
            });
            }
            function  changeSequenceStatus(curr_status){
                if(curr_status=="on"){
                    new_status = "OFF";
                }else{
                    new_status = "ON";
                }
                if(confirm("Are you sure, you want to Turn "+new_status+" SMS followup Sequence?")){
                    
                }else{
                    return;
                }
                if(curr_status=="on"){
                    $("#call_status_img_seq").html('<i class="fa fa-exclamation-triangle"></i> OFF');
                    $("#call_status_img_seq").css("background-color","#CC1E1E");
                    $("#call_status_img_seq").attr("onclick","changeSequenceStatus('off')");
                }else{
                    $("#call_status_img_seq").html('<i class="fa fa-check"></i> ON');
                    $("#call_status_img_seq").css("background-color","#39891D");
                    $("#call_status_img_seq").attr("onclick","changeSequenceStatus('on')");
                }
                $.ajax({
                url: _U + 'call_report',
                data: {change_seq_status: 1,curr_status:curr_status},
                success: function (r) {
                
                }
            });
            }
            function  changeEmailSequenceStatus(curr_status){
                if(curr_status=="on"){
                    new_status = "OFF";
                }else{
                    new_status = "ON";
                }
                if(confirm("Are you sure, you want to Turn "+new_status+" Email followup Sequence?")){
                    
                }else{
                    return;
                }
                if(curr_status=="on"){
                    $("#call_status_img_email_seq").html('<i class="fa fa-exclamation-triangle"></i> OFF');
                    $("#call_status_img_email_seq").css("background-color","#CC1E1E");
                    $("#call_status_img_email_seq").attr("onclick","changeEmailSequenceStatus('off')");
                }else{
                    $("#call_status_img_email_seq").html('<i class="fa fa-check"></i> ON');
                    $("#call_status_img_email_seq").css("background-color","#39891D");
                    $("#call_status_img_email_seq").attr("onclick","changeEmailSequenceStatus('on')");
                }
                $.ajax({
                url: _U + 'call_report',
                data: {change_email_seq_status: 1,curr_email_status:curr_status},
                success: function (r) {
                
                }
            });
            }
        </script>
    </body>
</html>
<?php
if (isset($_mail_send_arr) && !empty($_mail_send_arr)) {
    if (!empty($_mail_send_arr['to'])) {
        if (isset($_mail_send_arr['from_email']) && trim($_mail_send_arr['from_email']) != '') {
            $mail_from_info['name'] = trim($_mail_send_arr['from_name']);
            $mail_from_info['email'] = trim($_mail_send_arr['from_email']);
            $mail_res = _mail_with_from($_mail_send_arr['to'], $_mail_send_arr['subject'], $_mail_send_arr['content'], $mail_from_info);
        } else {
            $mail_res = _mail($_mail_send_arr['to'], $_mail_send_arr['subject'], $_mail_send_arr['content']);
        }
    }
}
?>