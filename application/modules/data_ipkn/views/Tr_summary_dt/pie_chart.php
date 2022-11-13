
<div id="pie-chart-summary" style="min-width: 400px; width: 100%; min-height: 400px; margin: 0 auto"></div>

<!-- end highchat modules -->
<script type="text/javascript">

    $(document).ready(function() {
    //use getJSON to get the dynamic data via AJAX call
        $.getJSON('<?php echo base_url()?>Templates/Templates/graph?prefix=2&TypeChart=pie&style=1&mod=1', {id: 1}, function(chartData) {
            
            $('#pie-chart-summary').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: ''
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    type: 'pie',
                    name: 'Percentage',
                    data: chartData.series
                }]
            });
    
        });
    });

    
</script>