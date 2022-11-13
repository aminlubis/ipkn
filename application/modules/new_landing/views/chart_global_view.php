
<div id="polar-spider" style="min-width: 400px; width: 100%; min-height: 500px; margin: 0 auto"></div>
    <!-- end highchat modules -->
<script type="text/javascript">

    $(document).ready(function() {
    //use getJSON to get the dynamic data via AJAX call
        $.getJSON('<?php echo base_url()?>Templates/Templates/graph?prefix=11&TypeChart=polar&style=1&mod=1', {id: 1}, function(chartData) {
        
            $('#polar-spider').highcharts({

                chart: {
                    polar: true,
                    type: 'line'
                },
                colors: ['#2f7ed8', '#cc8b36', '#8bbc21', '#910000', '#1aadce'],

                title: {
                    text: '',
                },
                subtitle: {
                    text: chartData.subtitle,
                },

                pane: {
                    size: '80%'
                },

                xAxis: chartData.xAxis,
                yAxis: {
                    gridLineInterpolation: 'polygon',
                    lineWidth: 0,
                    min: 0
                },
                plotOptions: {
                    line: {
                        dataLabels: {
                            enabled: true
                        },
                        enableMouseTracking: false
                    }
                },
                tooltip: {
                    shared: true,
                    pointFormat: '<span style="color:{series.color}">{series.name}: <b> {point.y:,.2f}</b><br/>'
                },

                legend: {
                    align: 'right',
                    verticalAlign: 'top',
                    y: 70,
                    layout: 'vertical'
                },

                series: chartData.series,

            });
    
        });
    });

    
</script>