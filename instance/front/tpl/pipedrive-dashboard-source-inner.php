<script>

    $(function () {
        $('#container').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: '<?php echo $dashboard_title; ?>'
            },
            xAxis: {
            categories: [<?php echo "'" . implode($label_arr, "','") . "'"; ?>],
            crosshair: true
        },
          yAxis: {
            min: 0,
            title: {
            text: 'No. of Deals'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.0f} Deals</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            },series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.0f}'
                }
            }
        },
           series: [{
            name: '<?= $curr_graph_label; ?>',
            data: [<?php echo implode($curr_arr, ","); ?>]

        }, {
            name: '<?= $prev_graph_label; ?>',
            data: [<?php echo  implode($prev_arr, ","); ?>]

        }]
        });
    });    
</script>
