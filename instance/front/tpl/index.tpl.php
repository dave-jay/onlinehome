<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title> LySoft Media | <?php print _cg("page_title"); ?></title>
        <link rel="shortcut icon" href="<?php print _MEDIA_URL ?>img/Affiliates.jpg" />
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
                <div class="container">
                    <div class="row topbar">
                       
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-2">
                          LySoft Media
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 menu_right">
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown hidden-xs">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding: 0 22px;">
                                        admin&nbsp;<i class="fa fa-user" >&nbsp;</i><b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0);"><i class="fa fa-gear"></i> Change Password</a></li>
                                        <li><a href="<?php print _U ?>?logout=1"><i class="glyphicon glyphicon-off"></i> Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12 leftbar">
                            <?php include_once('left.php'); ?>
                        </div>
                        <div id="div_main_content" class="col-lg-10 col-md-9 col-sm-9 col-xs-12 content_body">
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
                $("#div_main_content").css("min-height", (h - 50) + "px");
                $(window).resize(function e() {
                    var h = $(window).height();
                    $("#div_main_content").css("min-height", (h - 50) + "px");
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