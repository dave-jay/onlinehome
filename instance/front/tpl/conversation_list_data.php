
<?php
if(count($conversation_list)>0):
foreach ($conversation_list as $each_conv):

    if ($each_conv['type'] == "RECEIVED") {
        $stylefloat = "float:right;margin-right:8px;border-radius: 4px 0 4px 4px;";
        $triangle = "<div style='width: 0px; height: 0px; border-bottom: 10px solid transparent; position: absolute; border-left: 10px solid #d1d1d1; right: 9px;'></div>";
    } else {
        $stylefloat = "float:left;margin-left:8px;border-radius: 0 4px 4px 4px;";
        $triangle = "<div style='width: 0px; height: 0px; border-bottom: 10px solid transparent; position: absolute; border-right: 10px solid #d1d1d1; left: 9px;'></div>";
    }
    ?>
    <div style="clear: both;"></div>
    <div style="min-height: 24px; padding: 5px 10px;overflow: auto;position:relative;">
        <?php if ($each_conv['type'] == "RECEIVED"): ?>
            <div style="border-radius: 4px;padding: 0px 10px 3px 2px;color: black;font-weight: bold;text-align: right;">Customer : </div>
        <?php else: ?>
            <div style="border-radius: 4px;padding: 0px 10px 3px 2px;color: black;font-weight: bold;">Agent : </div>
        <?php endif;
        echo $triangle;
        ?>
        <span style="border: 1px solid #d1d1d1; background-color: #d1d1d1; padding: 7px 10px;<?= $stylefloat; ?>"><?= $each_conv['text']; ?></span>
        <div style="clear: both;"></div>
        <?php if ($each_conv['type'] == "RECEIVED"): ?>
            <div style="border-radius: 4px;padding: 7px 10px 3px 2px;color: black;text-align: right;font-size: 12px;font-family: verdana;"><?= date("d M, Y h:i a", strtotime($each_conv['messageTime'])); ?></div>
        <?php else: ?>
            <div style="border-radius: 4px;padding: 7px 10px 3px 2px;color: black;font-size: 12px;font-family: verdana;"><?= date("d M, Y h:i a", strtotime($each_conv['messageTime'])); ?></div>
    <?php endif; ?>
    </div>
<?php endforeach; 
else:
    echo "<div style='padding: 10px; margin: 10px; background-color: #dadada; border-radius: 0px 0px 5px 5px;'>Sorry, No Record Found!</div>";
endif;
?>