<body style='padding: 0px; margin: 0px;'>
    <style>
        .widget{
            background-color: #fff; border: 1px solid #e0e4e7; border-radius: 4px; box-sizing: border-box; display: block; margin-bottom: 0px; width: 100%; padding: 0px; 
            font-family: 
                "OpenSans" ,Arial,sans-serif;
        }
        .columnTitle{
            padding: 16px;height: 20px;
        }
        .columnItem{
            -moz-user-select: none;     color: #806aa5;     display: inline-block;     font-size: 12px;     font-weight: 600;     text-transform: uppercase;
        }
        .item{
            padding: 0 16px 12px;
        }
        .enum{
            margin-bottom: 6px;
        }
        .hr-line{
            height: 1px; margin-bottom: 6px; margin-top: 6px; background-color: #C5C5C5;
        }
    </style>
    <div class="widget fieldsView">
        <div class="columnTitle">
            <span class="columnItem">Leadpropel Intelligence</span>
        </div>
        <div class="fieldsList read collapsed">
            <div class="visible">
                <div class="item read enumField editable">
                    <div class="labelWrap clearfix"></div>
                    
                    <?php 
                    $dealId = isset($_REQUEST['dealId'])?$_REQUEST['dealId']:'';
                    if($dealId==''):
                        echo '<div class="valueWrap singleRow clearfix">';
                        echo '<div class="enum">No call recording found.<br><br><br></div>';
                        echo '</div>';
                    else:
                        $call_detail = qs("select * from call_detail where deal_id='{$dealId}' order by id desc limit 0,1");
                        if(empty($call_detail) || !isset($call_detail['recording_url']) || $call_detail['recording_url']==''){
                            echo '<div class="valueWrap singleRow clearfix">';
                            echo '<div class="enum">No call recording found.<br><br><br></div>';
                            echo '</div>';
                        }else{
                            echo '<div class="valueWrap singleRow clearfix">';
                            echo '<div class="enum">Call on '.date('d F,Y h:i A',  strtotime($call_detail['created_at'])).'</div>';
                            echo '<audio style="width: 100%;" controls=""><source type="audio/mpeg" src="'.$call_detail['recording_url'].'"></source>Your browser does not support the audio element.</audio>';
                            echo '</div>';
                        }
                    endif;
                    ?>                   
                        
                    <!--<div class="hr-line"></div>
                    <div class="valueWrap singleRow clearfix">
                        <div class="enum">Call on 02 May,2016 05:00</div>
                        <audio style='width: 100%;' controls=""><source type="audio/mpeg" src="https://api.twilio.com/2010-04-01/Accounts/AC0ed3b59448346c77c722e15188fecf31/Recordings/RE33dcdb4b3c9fa3d8787a12ab9ff52328"></source>Your browser does not support the audio element.</audio>
                    </div>-->
                </div>
            </div>
        </div>
    </div>
</body>
<script>
 
</script>
<?php
die;
?>