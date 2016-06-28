<div class="click_to_call_container">
    <div class="click_to_call_half">
        <div class="click_to_call_label">Your Number</div>
        <?php if ($is_agent_number == 0): ?>
            <div class="click_to_call_warning">We have not your phone number.</div>
        <?php else: ?>
            <div style='margin-bottom: 10px;'><span class="click_to_call_phone fa fa-phone">&nbsp;<?= $agent_no; ?></span></div>
        <?php endif; ?>
        <div style="font-size: 15px;margin-top: 10px;display: none;"><span onclick="ManualAgentNo()" style="color: #004889; font-weight: bold; cursor: pointer;"> Click Here</span> to change above number.</div>
        <div style="display: none;" id="divManualAgent">
            <input type="text" class="form-control">
        </div>        
    </div>
    <div class="click_to_call_half">
        <div class='click_to_call_label'>Customer Number</div>
        <?php if ($is_cust_number == 0): ?>
            <div class="click_to_call_warning">We have not customer phone number.</div>
        <?php else: ?>
            <?php
            $first_number = 1;
            $first_cust_phone = '';
            foreach ($contact_list as $each_cust_no):
                if ($first_number == 1):
                    $first_cust_phone = $each_cust_no;
                    ?>
                    <div style='margin-bottom: 10px;'><span id='<?= "cust_phone_" . $first_number ?>' onclick="change_phone_number('customer', '<?= "cust_phone_" . $first_number ?>', '<?= $each_cust_no; ?>')" class="cust_phone click_to_call_phone fa fa-phone">&nbsp;<?= formatCellDash($each_cust_no); ?></span></div>        
                <?php else: ?>
                    <div style='margin-bottom: 10px;'><span id='<?= "cust_phone_" . $first_number ?>' onclick="change_phone_number('customer', '<?= "cust_phone_" . $first_number ?>', '<?= $each_cust_no; ?>')" class="cust_phone click_to_call_phone_extra">&nbsp;<?= formatCellDash($each_cust_no); ?></span></div>       
                <?php
                endif;
                $first_number++;
                ?>
            <?php endforeach; ?>
<?php endif; ?>
    </div>
    <div style="clear:both;"></div>
<?php if ($is_agent_number == 0 || $is_cust_number == 0): ?>
        <div id='call_btn_disabled'>
            <img src="instance/front/media/img/call_now.png" style='width:235px;' />
        </div>
<?php else: ?>
        <div id='call_btn_enabled'>
            <img src="instance/front/media/img/call_now.png" style='width:235px;' />
        </div>
<?php endif; ?>
    <div id='connecting_icon' style='display: none;'>
        <img src="instance/front/media/img/connecting.gif" />
        <div style='color: #f35f26;font-size: 19px;margin-top: 12px;'>We are connecting with you...</div>
    </div>
    <div id='connected_icon'  style="display:none;">
        <i class="fa fa-check-square-o"></i>&nbsp;Connected
    </div>
</div>
<input type='hidden' id='hidAgentName' name="hidAgentName" value="<?= $agent_name; ?>" />
<input type='hidden' id='hidAgentPhone' name="hidAgentPhone" value="<?= $agent_no; ?>" />
<input type='hidden' id='hidCustPhone' name="hidCustPhone" value="<?= $first_cust_phone; ?>" />
<input type='hidden' id='hidDealId' name="hidDealId" value="<?= $dealId; ?>" />
<style>
    .click_to_call_container{
        padding-left: 60px;margin-top: 20px;
    }
    .click_to_call_half{
        font-family: verdana;width:50%;float:left;text-align: center;
    }
    .click_to_call_label{
        font-size: 20px; color: #1294d5;
    }
    .click_to_call_warning{
        font-size: 16px; font-weight: bold;color: red;margin-top: 10px;
    }
    .click_to_call_phone{
        font-size: 24px; font-weight: bold; border: 1px solid; padding: 7px; color: #696969; border-radius: 5px;cursor: pointer;font-family: FontAwesome;
    }
    .click_to_call_phone_extra{
        font-size: 24px; font-weight: bold; padding: 7px; color: #999; cursor: pointer;font-family: FontAwesome;margin-right: -19px;
    }
    .click_to_call_phone_extra:hover{
        color:#696969;
    }
    #call_btn_disabled{
        margin-top: 30px;text-align: center;cursor:not-allowed;opacity: 0.5;
    }
    #call_btn_enabled{
        margin-top: 30px;text-align: center;cursor:pointer;
    }
    #connecting_icon{
        margin-top: 30px;text-align: center;
    }
    #connected_icon{
        text-align: center; color: green; font-size: 30px; font-family: verdana;
    }
</style>