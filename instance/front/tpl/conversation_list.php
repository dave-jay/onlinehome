<!--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center;">
    <img style="width:165px;" src="<?php print _MEDIA_URL ?>img/wayne-logo.jpg" />
</div>
<div style="clear: both;">&nbsp;</div>-->
<div style="clear: both;height: 4px;"></div>
<div id="first_header" class="acc_header" onclick="openBlock('first');" style="border-radius: 5px;">
    <div style="float: left;"> Send Message</div>
    <div style="float: right;margin-top: 3px;" id="first_icon" class="fa fa-plus"></div>
</div>
<div id="first_block" style="display: none;">
    <div style="clear: both;">&nbsp;</div>
    <div class="col-lg-12">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="text-align: right">
            <label>To:</lable>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-7">
            <select id="ddlPhone" class="form-control">
                <?php if(count($contact_list)>0){ ?>
                <?php foreach ($contact_list as $each_phone): ?>
                    <option value="<?= $each_phone; ?>"><?= $each_phone; ?></option>
                <?php endforeach; ?>
                <?php }else {
                    echo "<option value='0'>Select Phone Number</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <div style="clear: both;">&nbsp;</div>
    <div class="col-lg-12">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="text-align: right">
            <label>Message:</lable>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-7">
            <textarea id="txtMessage" cols="20" rows="1" class="form-control"></textarea>
        </div>
    </div>
    <div style="clear: both;">&nbsp;</div>
    <div class="col-lg-12">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align: center">
            <input type="hidden" id="hidDealId" value="<?=$dealId;?>" />
            <button id="btnSend" type="button" class="btn btn-info">Send</button>
        </div>
    </div>
    <div style="clear: both;">&nbsp;</div>
</div>
<div style="clear: both;height: 4px;"></div>
<div id="second_header" class="acc_header" onclick="closeBlock('second');">
    <div style="float: left;">Message List</div>
    <div style="float: right;margin-top: 3px;" id="second_icon" class="fa fa-minus"></div>
</div>
<div id="second_block" style="overflow: auto;">
    <?php 
        include _PATH.'instance/front/tpl/conversation_list_data.php';
    ?>
</div>
<style>
    .acc_header{
        font-family: verdana; 
        font-size: 17px; 
        font-weight: 600; 
        padding: 4px 10px;
        overflow: auto;
        cursor: pointer;
        border-radius: 5px 5px 0 0;
        margin: 0 10px 0 20px;
        background: #39B3D7; /* For browsers that do not support gradients */
        background: -webkit-linear-gradient(#39B3D7, #229cb2); /* For Safari 5.1 to 6.0 */
        background: -o-linear-gradient(#39B3D7, #229cb2); /* For Opera 11.1 to 12.0 */
        background: -moz-linear-gradient(#39B3D7, #229cb2); /* For Firefox 3.6 to 15 */
        background: linear-gradient(#39B3D7, #229cb2); /* Standard syntax */
    }
    #second_block, #first_block{
        margin: 0 10px 0 20px;
        border: 2px solid #2ea8c5;
        border-radius: 0 0 5px 5px;
    }
    body{
        overflow-y: scroll !important;
    }
</style>
<script>
    
</script>