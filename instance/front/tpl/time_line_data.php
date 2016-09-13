<?php ?>
<tr>
    <td></td>
    <td style="text-align: center;">
        <div class="timeline-date">
            <?= $date; ?>
        </div>
    </td>
    <td></td>
</tr>
<tr>
    <td colspan="3" class="middle-block">&nbsp;</td>
</tr>
<tr>
    <td class="left-block">
        <div class="timeline-log">
            <?= $timeline['first_data']; ?>
        </div>
    </td>
    <td class="middle-block">
        <div class="timeline-circle">
            &nbsp;
        </div>
        <div class="timeline-line">
            &nbsp;
        </div>
    </td>
    <td class="right-block">
        <div class="timeline-time">
            <?= $timeline['first_time']; ?>
        </div>
    </td>
</tr>
<tr>
    <td colspan="3" class="middle-block">&nbsp;</td>
</tr>
<?php
$first_block = 'timeline-time';
$last_block = 'timeline-log';
foreach ($timeline[$date] as $time => $data):
    if ($first_block == 'timeline-log') {
        $first_block_data = $data;
        $last_block_data = $time;
    } else {
        $first_block_data = $time;
        $last_block_data = $data;
    }
    ?>
    <tr>
        <td class="left-block">
            <div class="<?= $first_block; ?>">
                <?= $first_block_data; ?>
            </div>
        </td>
        <td class="middle-block">
            <div class="timeline-circle">
                &nbsp;
            </div>
            <div class="timeline-line">
                &nbsp;
            </div>
        </td>
        <td class="right-block">
            <div class="<?= $last_block; ?>">
                <?= $last_block_data; ?>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="3" class="middle-block">&nbsp;</td>
    </tr>
    <?php
    if ($first_block == 'timeline-log') {
        $first_block = 'timeline-time';
        $last_block = 'timeline-log';
    } else {
        $first_block = 'timeline-log';
        $last_block = 'timeline-time';
    }
endforeach;
?>
