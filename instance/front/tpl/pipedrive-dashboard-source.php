<script src="<?php echo _MEDIA_URL; ?>js/highcharts.js"></script>
<div class="MyPageHeader">
    Source Dashboard
</div>
<div style="text-align: center;margin: 30px 30px 10px 30px;">
    <div class="btn-group source-btn-group" role="group" aria-label="...">
        <button type="button" id="btn-TODAY" class="btn btn-default duration-btn" onclick="changeDashboard('TODAY')">Today</button>
        <button type="button" id="btn-CURRENT_WEEK" class="btn btn-default duration-btn" onclick="changeDashboard('CURRENT_WEEK')">Current Week</button>
        <button type="button" id="btn-CURRENT_WEEK_TO_DATE" class="btn btn-default duration-btn" onclick="changeDashboard('CURRENT_WEEK_TO_DATE')">Current Week to date</button>
        <button type="button" id="btn-CURRENT_MONTH" class="btn btn-default duration-btn" onclick="changeDashboard('CURRENT_MONTH')">Current Month</button>
        <button type="button" id="btn-CURRENT_MONTH_TO_DATE" class="btn btn-default duration-btn" onclick="changeDashboard('CURRENT_MONTH_TO_DATE')">Current Month to Date (MTD)</button>
        <button type="button" id="btn-CURRENT_YEAR" class="btn btn-default duration-btn" onclick="changeDashboard('CURRENT_YEAR')">Current Year</button>
    </div>
</div>


<div style="text-align: center;margin-top: 10px;">
    <div class="btn-group source-btn-group" role="group" aria-label="...">
        <?php
        foreach ($value_data as $each_source) {
            echo '<button type="button" class="btn btn-default" onclick="changeGraph(\'' . $each_source['source'] . '\')" >' . $each_source['source'] . '</button>';
        }
        echo '<button type="button" class="btn btn-info" onclick="changeGraph(\'ALL\')" >All Sources</button>';
        ?>

    </div>
</div>
<div style="margin: 10px 0 30px;font-size: 20px;">
    <div id="div-duration-TODAY" style="display: none;" class="div-duration">
        <div style="float: left; color: #2F7ED8; margin-left: 20%; width: 30%;">
            <div style="background-color: #2F7ED8; width: 14px; height: 14px; float: left; margin-top: 6px; margin-right: 6px;"></div>
            <div style="float: left;">
                <?= date('m/d/Y');?>
            </div>
        </div>
        <div style="float: left; color: #0D233A; margin-left: 10%; width: 30%;">
            <div style="background-color: #0D233A; width: 14px; height: 14px; float: left; margin-top: 6px; margin-right: 6px;"></div>
            <div style="float: left;">
                <?= date('m/d/Y', strtotime("-1 day"));?>
            </div>
        </div>
    </div>
    <div id="div-duration-CURRENT_WEEK" style="display: none;" class="div-duration">
        <div style="float: left; color: #2F7ED8; margin-left: 20%; width: 30%;">
            <div style="background-color: #2F7ED8; width: 14px; height: 14px; float: left; margin-top: 6px; margin-right: 6px;"></div>
            <div style="float: left;">
                <?= date('m/d/Y', strtotime("monday this week"));?>
                <?= " - "; ?>
                <?= date('m/d/Y', strtotime("sunday this week"));?>
            </div>
        </div>
        <div style="float: left; color: #0D233A; margin-left: 10%; width: 30%;">
            <div style="background-color: #0D233A; width: 14px; height: 14px; float: left; margin-top: 6px; margin-right: 6px;"></div>
            <div style="float: left;">
                <?= date('m/d/Y', strtotime("monday last week"));?>
                <?= " - "; ?>
                <?= date('m/d/Y', strtotime("sunday last week"));?>
            </div>
        </div>
    </div>
    <div id="div-duration-CURRENT_WEEK_TO_DATE" style="display: none;" class="div-duration">
        <div style="float: left; color: #2F7ED8; margin-left: 20%; width: 30%;">
            <div style="background-color: #2F7ED8; width: 14px; height: 14px; float: left; margin-top: 6px; margin-right: 6px;"></div>
            <div style="float: left;">
                <?= date('m/d/Y', strtotime("monday this week"));?>
                <?= " - "; ?>
                <?= date('m/d/Y');?>
            </div>
        </div>
        <div style="float: left; color: #0D233A; margin-left: 10%; width: 30%;">
            <div style="background-color: #0D233A; width: 14px; height: 14px; float: left; margin-top: 6px; margin-right: 6px;"></div>
            <div style="float: left;">
                <?= date('m/d/Y', strtotime("monday last week"));?>
                <?= " - "; ?>
                <?= date('m/d/Y', strtotime("-1 week"));?>
            </div>
        </div>
    </div>
    <div id="div-duration-CURRENT_MONTH" style="display: none;" class="div-duration">
        <div style="float: left; color: #2F7ED8; margin-left: 20%; width: 30%;">
            <div style="background-color: #2F7ED8; width: 14px; height: 14px; float: left; margin-top: 6px; margin-right: 6px;"></div>
            <div style="float: left;">
                <?= date('m/d/Y', strtotime("first day of this month"));?>
                <?= " - "; ?>
                <?= date('m/d/Y', strtotime("last day of this month"));?>
            </div>
        </div>
        <div style="float: left; color: #0D233A; margin-left: 10%; width: 30%;">
            <div style="background-color: #0D233A; width: 14px; height: 14px; float: left; margin-top: 6px; margin-right: 6px;"></div>
            <div style="float: left;">
                <?= date('m/d/Y', strtotime("first day of last month"));?>
                <?= " - "; ?>
                <?= date('m/d/Y', strtotime("last day of last month"));?>
            </div>
        </div>
    </div>
    <div id="div-duration-CURRENT_MONTH_TO_DATE" style="display: none;" class="div-duration">
        <div style="float: left; color: #2F7ED8; margin-left: 20%; width: 30%;">
            <div style="background-color: #2F7ED8; width: 14px; height: 14px; float: left; margin-top: 6px; margin-right: 6px;"></div>
            <div style="float: left;">
                <?= date('m/d/Y', strtotime('first day of this month'));?>
                <?= " - "; ?>
                <?= date('m/d/Y');?>
            </div>
        </div>
        <div style="float: left; color: #0D233A; margin-left: 10%; width: 30%;">
            <div style="background-color: #0D233A; width: 14px; height: 14px; float: left; margin-top: 6px; margin-right: 6px;"></div>
            <div style="float: left;">
                <?= date('m/d/Y', strtotime('first day of last month'));?>
                <?= " - "; ?>
                <?= date('m/d/Y', strtotime("-1 month"));?>
            </div>
        </div>
    </div>
    <div id="div-duration-CURRENT_YEAR" style="display: none;" class="div-duration">
        <div style="float: left; color: #2F7ED8; margin-left: 20%; width: 30%;">
            <div style="background-color: #2F7ED8; width: 14px; height: 14px; float: left; margin-top: 6px; margin-right: 6px;"></div>
            <div style="float: left;">
                <?= date('01/01/Y');?>
                <?= " - "; ?>
                <?= date('12/31/Y');?>
            </div>
        </div>
        <div style="float: left; color: #0D233A; margin-left: 10%; width: 30%;">
            <div style="background-color: #0D233A; width: 14px; height: 14px; float: left; margin-top: 6px; margin-right: 6px;"></div>
            <div style="float: left;">
                <?= date('01/01/Y', strtotime("last year"));?>
                <?= " - "; ?>
                <?= date('01/01/Y', strtotime("last year"));?>
            </div>
        </div>
    </div>
    <div id="div-duration" class="div-duration">
        <div style="float: left; color: #2F7ED8; margin-left: 20%; width: 30%;">
            <div style="background-color: #2F7ED8; width: 14px; height: 14px; float: left; margin-top: 6px; margin-right: 6px;"></div>
            <div style="float: left;">
                <?= "05/01/2016 - 05/31/2016"; ?>
            </div>
        </div>
        <div style="float: left; color: #0D233A; margin-left: 10%; width: 30%;">
            <div style="background-color: #0D233A; width: 14px; height: 14px; float: left; margin-top: 6px; margin-right: 6px;"></div>
            <div style="float: left;">
                <?= "04/01/2016 - 04/30/2016"; ?>
            </div>
        </div>
    </div>
    <div style="clear: both;"></div>
</div>
<div id="container" style="width:100%; height:400px;"></div>
<div style="margin-top: 36px;" id="graphMatrix">
    <?php include _PATH."instance/front/tpl/pipedrive-dashboard-source-matrix.php"; ?>    
</div>
<style>
    .source-btn-group > button{
        font-family: "Lucida Grande","Lucida Sans Unicode",Verdana,Arial,Helvetica,sans-serif;
    }
</style>
