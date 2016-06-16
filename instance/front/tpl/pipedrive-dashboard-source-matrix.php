<table class="table">
        <thead>
            <tr style="border-top: 2px solid #dadada;">
                <th rowspan="2"  style="text-align: center;border-right: 1px solid #dadada;" >&nbsp;</th>
                <th style="text-align: center;border-right: 1px solid #dadada;" colspan="4"><?= $curr_graph_label; ?></th>
                <th style="text-align: center;"  colspan="4"><?= $prev_graph_label; ?></th>
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
            <?php foreach ($value_data as $each_source): ?>
                <tr>
                    <th style="border-right: 1px solid #dadada;"><?= $each_source['source']; ?></th>
                    <td style="text-align: right;" ><?= $each_source['curr_submitted_count'] . ' (' . number_format(($each_source['curr_submitted_count'] * 100) / $each_source['current_count'], 0) . '%)'; ?></td>
                    <td style="text-align: right;" ><?= $each_source['curr_approved_count'] . ' (' . number_format(($each_source['curr_approved_count'] * 100) / $each_source['current_count'], 0) . '%)'; ?></td>
                    <td style="text-align: right;" ><?= $each_source['curr_funded_count'] . ' (' . number_format(($each_source['curr_funded_count'] * 100) / $each_source['current_count'], 0) . '%)'; ?></td>
                    <td style="text-align: right;border-right: 1px solid #dadada;" ><?= $each_source['curr_other_count'] . ' (' . number_format(($each_source['curr_other_count'] * 100) / $each_source['current_count'], 0) . '%)'; ?></td>
                    <td style="text-align: right;" ><?= $each_source['prev_submitted_count'] . ' (' . number_format(($each_source['prev_submitted_count'] * 100) / $each_source['prev_count'], 0) . '%)'; ?></td>
                    <td style="text-align: right;" ><?= $each_source['prev_approved_count'] . ' (' . number_format(($each_source['prev_approved_count'] * 100) / $each_source['prev_count'], 0) . '%)'; ?></td>
                    <td style="text-align: right;" ><?= $each_source['prev_funded_count'] . ' (' . number_format(($each_source['prev_funded_count'] * 100) / $each_source['prev_count'], 0) . '%)'; ?></td>
                    <td style="text-align: right;" ><?= $each_source['prev_other_count'] . ' (' . number_format(($each_source['prev_other_count'] * 100) / $each_source['prev_count'], 0) . '%)'; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>