<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="top-divider"></div>
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#" style='padding: 8px 0;font-weight: bold;text-transform:uppercase;' id="header_customer_name"><img style="width:165px;" src="<?php print _MEDIA_URL ?>img/wayne-logo.jpg" /></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">                
                <li id="dashboard-menu" class="<?php print _cg("url") == 'pipedrive-dashboard-source' ? 'active' : ''  ?>">
                    <a href="<?php l('pipedrive-dashboard-source'); ?>">Dashboard</a>
                    <ul class="dropdown-menu" style="width: 100%;">
                        <li><a href="<?php l('pipedrive-dashboard-source'); ?>"><i class="visible-xs fa fa-chevron-right" style="width: 10px; float: left; margin-top: 4px;"></i>Source Dashboard</a></li>                        
                    </ul>
                </li>                
                <li class="<?php print _cg("url") == 'call_distribution' ? 'active' : ''  ?>"><a href="<?php l('call_distribution'); ?>">Call Distribution</a></li>
                <li class="<?php print _cg("url") == 'agents' ? 'active' : ''  ?>"><a href="<?php l('agents'); ?>">Agents List</a></li>
                <li class="<?php print _cg("url") == 'call_report' ? 'active' : ''  ?>"><a href="<?php l('call_report'); ?>">Call Reports</a></li>                
                <li class="<?php print (_cg("url") == 'twilio_settings' || _cg("url") == 'pipedrive_settings') ? 'active' : ''  ?>" id="report-menu">
                    <a href="#">Setting&nbsp;<i class="fa fa-cog">&nbsp;</i></a>
                    <ul class="dropdown-menu" style="">
                        <li><a href="<?php l('twilio_settings'); ?>"><i class="visible-xs fa fa-chevron-right" style="width: 10px; float: left; margin-top: 4px;"></i>Twilio Settings</a></li>
                        <li><a href="<?php l('pipedrive_settings'); ?>"><i class="visible-xs fa fa-chevron-right" style="width: 10px; float: left; margin-top: 4px;"></i>PipeDrive Settings</a></li>
                        <li><a href="<?php l('call_redial_setting'); ?>"><i class="visible-xs fa fa-chevron-right" style="width: 10px; float: left; margin-top: 4px;"></i>Call Redial Settings</a></li>
                        <li><a href="<?php l('sms_seq_settings'); ?>"><i class="visible-xs fa fa-chevron-right" style="width: 10px; float: left; margin-top: 4px;"></i>SMS Sequence Settings</a></li>                        
                        <li><a href="<?php l('email_seq_settings'); ?>"><i class="visible-xs fa fa-chevron-right" style="width: 10px; float: left; margin-top: 4px;"></i>Email Sequence Settings</a></li>                        
                        <li><a href="<?php l('call_statistics'); ?>"><i class="visible-xs fa fa-chevron-right" style="width: 10px; float: left; margin-top: 4px;"></i>Call Statistics</a></li>
                        <?php if (isset($_SESSION['user'])): ?>                
                            <li><a href="<?php l('login?logout=1'); ?>"><i class="visible-xs fa fa-chevron-right" style="width: 10px; float: left; margin-top: 4px;"></i>Logout</a></li>               
                        <?php else: ?>
                            <li><a href="<?php l('login'); ?>"><i class="visible-xs fa fa-chevron-right" style="width: 10px; float: left; margin-top: 4px;"></i>Login</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php
                $call_status = qs("select *,value as call_status from config where `key` = 'CALL_STATUS'");
                if (strtolower($call_status['call_status']) != "on") {
                    $status_img = "<i class='fa fa-exclamation-triangle'></i> OFF";
                    $current_status = "off";
                    $current_style="background-color:#CC1E1E";
                }else{
                    $status_img = "<i class='fa fa fa-check'></i> ON";
                    $current_status = "on";
                    $current_style="background-color:#39891D";
                }
                ?>
                <li>
                    <div style="font-size: 14px; float: left; padding-top: 15px; color: rgb(110, 86, 86);">&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;Call Distributor &nbsp;</div>
                    <!--<img id="call_status_img" onclick="changeCallStatus('<?= $current_status; ?>')" src="<?php print _MEDIA_URL ?>img/<?= $status_img; ?>" style="cursor: pointer;margin: 15px 0 0;height: 25px;" title="Click to change call distributor" />-->
                    <div style="cursor:pointer;float: left; color: white; margin-top: 15px; font-family: verdana; width: 57px; padding: 2px 0px 5px; text-align: center;<?php print $current_style; ?>" id="call_status_img" onclick="changeCallStatus('<?= $current_status; ?>')"><?= $status_img; ?></div>
                </li>
                <?php
                $call_status = qs("select *,value as seq_status from config where `key` = 'SEQUENCE_STATUS'");
                if (strtolower($call_status['seq_status']) != "on") {
                    $status_img = "<i class='fa fa-exclamation-triangle'></i> OFF";
                    $current_status = "off";
                    $current_style="background-color:#CC1E1E";
                }else{
                    $status_img = "<i class='fa fa fa-check'></i> ON";
                    $current_status = "on";
                    $current_style="background-color:#39891D";
                }
                ?>
                <li>
                    <div style="font-size: 14px; float: left; padding-top: 15px; color: rgb(110, 86, 86);">&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;SMS-Email Sequence &nbsp;</div>
                    <div style="cursor:pointer;float: left; color: white; margin-top: 15px; font-family: verdana; width: 57px; padding: 2px 0px 5px; text-align: center;<?php print $current_style; ?>" id="call_status_img_seq" onclick="changeSequenceStatus('<?= $current_status; ?>')"><?= $status_img; ?></div>
                </li>
            </ul>
        </div><!--/.navbar-collapse -->
    </div>
</nav>
