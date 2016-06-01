<script src="<?php echo _MEDIA_URL; ?>js/highcharts.js"></script>
<div class="MyPageHeader">
    Source Dashboard
</div>
<div style="text-align: center;margin-top: 10px;">
    <div class="btn-group source-btn-group" role="group" aria-label="...">
        <?php 
        foreach($value_data as $each_source){
            echo '<button type="button" class="btn btn-default" onclick="changeGraph(\''.$each_source['source'].'\')" >'.$each_source['source'].'</button>';
        }
        echo '<button type="button" class="btn btn-info" onclick="changeGraph(\'ALL\')" >Reset</button>';
        ?>

    </div>
</div>
<div id="container" style="width:100%; height:400px;"></div>
<div style="margin-top: 36px;">
    <table class="table">
    <thead>
      <tr style="border-top: 2px solid #dadada;">
        <th rowspan="2"  style="text-align: center;border-right: 1px solid #dadada;" >&nbsp;</th>
        <th style="text-align: center;border-right: 1px solid #dadada;" colspan="4">May</th>
        <th style="text-align: center;"  colspan="4">April</th>
      </tr>
      <tr>
        <th style="text-align: right;" >Submitted</th>
        <th style="text-align: right;" >Approved</th>
        <th style="text-align: right;" >Funded</th>
        <th style="text-align: right;border-right: 1px solid #dadada;" >Other</th>
        <th style="text-align: right;" >Submitted</th>
        <th style="text-align: right;" >Approved</th>
        <th style="text-align: right;" >Funded</th>
        <th style="text-align: right;" >Other</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach($value_data as $each_source): ?>
        <tr>
            <th style="border-right: 1px solid #dadada;"><?=$each_source['source'];?></th>
            <td style="text-align: right;" ><?=$each_source['curr_submitted_count'].' ('.  number_format(($each_source['curr_submitted_count']*100)/$each_source['current_count'],0).'%)'; ?></td>
            <td style="text-align: right;" ><?=$each_source['curr_approved_count'].' ('.number_format(($each_source['curr_approved_count']*100)/$each_source['current_count'],0).'%)';?></td>
            <td style="text-align: right;" ><?=$each_source['curr_funded_count'].' ('.number_format(($each_source['curr_funded_count']*100)/$each_source['current_count'],0).'%)';?></td>
            <td style="text-align: right;border-right: 1px solid #dadada;" ><?=$each_source['curr_other_count'].' ('.number_format(($each_source['curr_other_count']*100)/$each_source['current_count'],0).'%)';?></td>
            <td style="text-align: right;" ><?=$each_source['prev_submitted_count'].' ('.number_format(($each_source['prev_submitted_count']*100)/$each_source['prev_count'],0).'%)';?></td>
            <td style="text-align: right;" ><?=$each_source['prev_approved_count'].' ('.number_format(($each_source['prev_approved_count']*100)/$each_source['prev_count'],0).'%)';?></td>
            <td style="text-align: right;" ><?=$each_source['prev_funded_count'].' ('.number_format(($each_source['prev_funded_count']*100)/$each_source['prev_count'],0).'%)';?></td>
            <td style="text-align: right;" ><?=$each_source['prev_other_count'].' ('.number_format(($each_source['prev_other_count']*100)/$each_source['prev_count'],0).'%)';?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
  </table>
</div>
<style>
    .source-btn-group > button{
        font-family: "Lucida Grande","Lucida Sans Unicode",Verdana,Arial,Helvetica,sans-serif;
    }
</style>
