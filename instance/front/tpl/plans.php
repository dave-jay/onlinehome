<!DOCTYPE html>
<html class="js flexbox canvas canvastext webgl no-touch geolocation postmessage no-websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients no-cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths js-menubar" style="" lang="en"><head>

        <title> LySoft Media</title>


        <!-- Stylesheets -->
        <link rel="stylesheet" href="<?php print _MEDIA_URL ?>loginDesignNew/bootstrap.css">
        <link rel="stylesheet" href="<?php print _MEDIA_URL ?>loginDesignNew/bootstrap-extend.css">
        <link rel="stylesheet" href="<?php print _MEDIA_URL ?>loginDesignNew/site.css">

        <!-- Plugins -->

        <!-- Fonts -->
        <link rel="stylesheet" href="<?php print _MEDIA_URL ?>loginDesignNew/web-icons.css">
        <link rel="stylesheet" href="<?php print _MEDIA_URL ?>loginDesignNew/brand-icons.css">
        <link rel="stylesheet" href="<?php print _MEDIA_URL ?>loginDesignNew/css_002.css">
        <link href="<?php print _MEDIA_URL ?>loginDesignNew/css.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="<?php print _MEDIA_URL ?>loginDesignNew/font-awesome.css">

        <script>

        </script><link rel="stylesheet" href="<?php print _MEDIA_URL ?>loginDesignNew/formValidation.css">   
        <link rel="stylesheet" href="<?php print _MEDIA_URL ?>loginDesignNew/login-v3.css">    



    </head>

    <body class="page-login-v3 layout-full">
        <div style="animation-duration: 0.8s; opacity: 1;" class="page animsition vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
            <div class="page-content vertical-align-middle">
                <div id="plan_block_1" class="plan_block" onclick="select_plan('1')" data-amount="0">
                    <div class="plan_head"><span class="fa fa-check-square-o">&nbsp;</span>Free Trial</div>
                    <div style=";" class="plan_amount"><span>$</span>0</div>
                    <div>free for 7 days</div>
                    <div class="cont_plan"><div>select</div></div>
                </div>
                <div id="plan_block_2" class="plan_block selected" onclick="select_plan('2')" data-amount="10">
                    <div class="plan_head"><span class="fa fa-check-square-o">&nbsp;</span>Monthly</div>
                    <div style=";" class="plan_amount"><span>$</span>10</div>
                    <div>short term plan</div>
                    <div class="cont_plan"><div>select</div></div>
                </div>
                <div id="plan_block_3" class="plan_block" onclick="select_plan('3')" data-amount="100">
                    <div class="plan_head"><span class="fa fa-check-square-o">&nbsp;</span>Yearly</div>
                    <div style=";" class="plan_amount"><span>$</span>100</div>
                    <div>long term plan</div>
                    <div class="cont_plan"><div>select</div></div>
                </div>
            </div>
            <div><a id="pay_btn" href="<?= l('pipedrive_settings?first_time=1'); ?>" style="background-color: rgb(105, 105, 105); color: white; font-size: 20px; width: 300px;" class="btn  ">PAY $10 & CONTINUE</a></div>
        </div>

    </body>
</html>

<style>
    .plan_block .fa-check-square-o{
        display:none;
    }
    .plan_block{
        float:left; 
        width: 200px;
        margin: 10px;
        border-radius: 6px;
        background-color: #FFFFFF;
    }
    .plan_head{
        font-size: 20px;
        background-color: #d5d5d5;
        color: #565656;
        padding: 10px;
    }
    .plan_amount{
        font-size: 42px;
    }
    .cont_plan{
        margin-top: 55px;
    }
    .cont_plan div{
        margin: 20px;
        overflow: auto;
        width: auto;
        border-radius: 100px; 
        padding: 4px; 
        cursor: pointer; 
        color: white;
        background-color: rgb(58, 131, 199); 
        text-transform: uppercase;
    }
    .plan_block.selected{
        box-shadow: 2px 2px 10px 1px #003941;
    }
    .plan_block.selected .plan_head{
        background: #696969;
        color:white;
    }
</style>
