<p style="font-family: verdana; margin-top: 30px; margin-bottom: 0px; color: #626262">
    Best Regards,
</p>
<div style="font-family: verdana; font-weight: bold; font-size: 15px; margin-top: 0px; margin-bottom: 0px; color: #5d5d5d;">
    <?= $agent_name; ?>
    <div style="color: #0b6121; font-family: verdana; font-weight: normal; margin: -4px 0px 0px; font-size: 13px;">
        <?= $agent_role; ?>
    </div>
</div>
<div>
    <img src="<?= _MEDIA_URL . "img/sprout.png"; ?>" style="width: 183px;" />
    <img src="<?= _U . "email_tracking?deal_id={$deal_id}&next_seq={$next_seq}&email_type={$email_type}"; ?>" style="height:1px;width:1px;display:none;">
</div>
<div style="color: gray; font-size: 14px;">
    1111 Broadhollow Road - 3rd Floor<br>
    Farmingdale, NY 11735<br>
    Direct. <?= $agent_phone; ?><br>
    <a style="color:blue;" href="http://www.sproutlending.com">www.sproutlending.com</a>
</div>
<div  style="margin-top: 7px;">
    <a href="<?= $agent_linked ?>"><img src="<?= _MEDIA_URL . "img/linkedin.png"; ?>" /></a>
</div>