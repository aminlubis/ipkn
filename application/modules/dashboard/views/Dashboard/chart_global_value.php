<center>
<!-- <div id="polar-spider" style="min-width: 400px; width: 100%; min-height: 500px; margin: 0 auto"></div> -->
<br>
<div id="zoomable_radar_chart" style="min-width: 400px; width: 100%; max-height: 500px; margin: 0 auto"></div>

<div style="text-align: center; width: 70%">
    <span style="font-size: 11px">Note : Skenario dibuat berdasarkan data yang dikirim oleh masing-maing K/L dengan asumsi data primer (EOS) tetap, serta data sekunder yang belum tersedia diasumsikan tetap</span>
</div>
</center>

    <!-- end highchat modules -->
<script type="text/javascript">

    $(document).ready(function() {
        
        zoomable_radar_chart();
        //use getJSON to get the dynamic data via AJAX call
        $.getJSON('<?php echo base_url()?>Templates/Templates/graph?prefix=1&TypeChart=polar&style=1&mod=1', {id: 1, year: $('#year').val(), kl: $('#kl_id').val(), subpillar: $('#subpillar_id').val() }, function(chartData) {
        
            $('#polar-spider').highcharts({

                chart: {
                    polar: true,
                    type: 'line'
                },
                colors: ['#2f7ed8', '#cc8b36', '#8bbc21', '#910000', '#1aadce'],

                title: {
                    text: chartData.title,
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
                    min: 0,
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

    function zoomable_radar_chart(){
        $('#zoomable_radar_chart').load('<?php echo base_url()?>landing/Landing/zoomable_radar_chart?_=' + (new Date()).getTime());
    }
    
    
</script>