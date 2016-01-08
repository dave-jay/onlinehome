<?php include "highcharts.php" ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#box_cls1').highcharts({
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 180
                }
            },
            title: {
                text: 'Best Source'
            },
            subtitle: {
                text: 'Best Source'
            },
            plotOptions: {
                pie: {
                    innerSize: 150,
                    depth: 90
                }
            },
            series: [{
                    name: 'Hot Leads',
                    data: [
                        ['Hot Leads', 38]
                    ]
                }]
        });

        $('#box_cls2').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Top Agents'
            },
            subtitle: {
                text: 'Top Agents'
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Top Agents Statistics'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:.0f}'
                    }
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b><br/>'
            },
            series: [{
                    name: 'Toper',
                    colorByPoint: true,
                    data: [{
                            name: 'Agent 1',
                            y: 56
                        }, {
                            name: 'Agent 2',
                            y: 24
                        }, {
                            name: 'Agent 3',
                            y: 10
                        }]
                }]
        });

        $('#box_cls3').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Under 5 minutes'
            },
            subtitle: {
                text: 'Under 5 minutes'
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Am I under 5 minutes?'
                }

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:.0f}'
                    }
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f} Min</b><br/>'
            },
            series: [{
                    name: 'Toper',
                    colorByPoint: true,
                    data: [{
                            name: '0-5 Min',
                            y: 88
                        }, {
                            name: '5-30 Min',
                            y: 12
                        }, {
                            name: '30-60 Min',
                            y: 1
                        }, {
                            name: '>60 Min',
                            y: 1
                        }]
                }]
        });

        $('#box_cls4').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Receive The Most Drips'
            },
            xAxis: {
                categories: ['10AM-11AM', '11AM-12AM', '12AM-1PM', '1PM-2PM', '2PM-3PM']
            },
            yAxis: {
                min: 0,
                title: {
                    text: '# of figure'
                },
                stackLabels: {
                    enabled: false,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    }
                }
            },
            legend: {
                align: 'right',
                x: -900,
                verticalAlign: 'top',
                y: 25,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false
            },
            tooltip: {
                headerFormat: '<b>{point.x}</b><br/>',
                pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: false,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                        style: {
                            textShadow: '0 0 3px black'
                        }
                    }
                }
            },
            series: [{
                    name: 'John',
                    data: [2, 0, 1, 2, 1]
                }, {
                    name: 'Jane',
                    data: [3, 3, 2, 3, 3.5]
                }]
        });

        $('#box_cls5').highcharts({
            title: {
                text: 'Am I connecting with prospects?',
                x: -20 //center
            },
            subtitle: {
                text: '',
                x: -20
            },
            xAxis: {
                categories: ['2016-01-01', '2016-01-02', '2016-01-03', '2016-01-04', '2016-01-05', '2016-01-06', '2016-01-07']
            },
            yAxis: {
                title: {
                    text: 'Rate'
                },
                plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
            },
            tooltip: {
                valueSuffix: ''
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [{
                    name: 'Connected',
                    data: [0, 2, 4, 3, 6, 3, 0]
                }, {
                    name: 'Not Called',
                    data: [0, 1, 5, 8, 5, 2, 0]
                }, {
                    name: 'Canceled',
                    data: [0, 5, 9, 2, 5, 1, 0]
                }, {
                    name: 'After Hour',
                    data: [0, 3, 2, 3, 6, 3, 0]
                }, {
                    name: 'Bed Number',
                    data: [0, 0, 0, 0, 0, 0, 0]
                }]
        });
    });
</script>