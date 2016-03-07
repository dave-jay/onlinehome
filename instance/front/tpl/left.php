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
                <li class="<?php print _cg("url") == 'dashboard' ? 'active' : ''  ?>"><a href="<?php l('dashboard'); ?>">Dashboard</a></li>
                <li class="<?php print _cg("url") == 'sms_service' ? 'active' : ''  ?>"><a href="<?php l('sms_service'); ?>">SMS Text</a></li>
                <li class="<?php print _cg("url") == 'call_distribution' ? 'active' : ''  ?>"><a href="<?php l('call_distribution'); ?>">Call Distribution</a></li>
                <li class="<?php print _cg("url") == 'agents' ? 'active' : ''  ?>"><a href="<?php l('agents'); ?>">Agents List</a></li>
                <li class="<?php print _cg("url") == 'call_report' ? 'active' : ''  ?>"><a href="<?php l('call_report'); ?>">Call Reports</a></li>
                <li class="<?php print _cg("url") == 'call_statistics' ? 'active' : ''  ?>"><a href="<?php l('call_statistics'); ?>">Call Statistics</a></li>                
                <li class="<?php print (_cg("url") == 'twilio_settings' || _cg("url") == 'pipedrive_settings') ? 'active' : ''  ?>" id="report-menu">
                    <a href="#">Setting&nbsp;<i class="fa fa-cog">&nbsp;</i></a>
                    <ul class="dropdown-menu" style="width: 100%;">
                        <li><a href="<?php l('twilio_settings'); ?>"><i class="visible-xs fa fa-chevron-right" style="width: 10px; float: left; margin-top: 4px;"></i>Twilio Settings</a></li>
                        <li><a href="<?php l('pipedrive_settings'); ?>"><i class="visible-xs fa fa-chevron-right" style="width: 10px; float: left; margin-top: 4px;"></i>PipeDrive Settings</a></li>
                        <?php if (isset($_SESSION['user'])): ?>                
                            <li><a href="<?php l('login_new?logout=1'); ?>"><i class="visible-xs fa fa-chevron-right" style="width: 10px; float: left; margin-top: 4px;"></i>Logout</a></li>               
                        <?php else: ?>
                            <li><a href="<?php l('login_new'); ?>"><i class="visible-xs fa fa-chevron-right" style="width: 10px; float: left; margin-top: 4px;"></i>Login</a></li>
                        <?php endif; ?>
                    </ul>
                </li>                
            </ul>
        </div><!--/.navbar-collapse -->
    </div>
</nav>
