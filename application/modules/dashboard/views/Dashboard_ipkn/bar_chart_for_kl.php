
<div id="pie_chart_kl" style="min-width: 400px; width: 100%; min-height: 500px; margin: 0 auto"></div>

<script type="text/javascript">

    $(document).ready(function() {

        $.getJSON('<?php echo base_url()?>Templates/Templates/graph?prefix=3&TypeChart=bar&style=1&mod=1', {id: 1, kl: $('#kl_id').val(), year: $('#year').val()}, function(chartData) {
            $('#pie_chart_kl').highcharts({
                chart: {
                    type: 'bar'
                },
                colors: ['#cd8a34', '#16345D', '#8bbc21', '#910000', '#1aadce'],
                title: {
                    text: '<?php echo $this->session->userdata('user')->kl_name?>'
                },
                subtitle: {
                    text: 'Travel & Tourism Competitiveness Index'
                },
                xAxis: chartData.xAxis,
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Score',
                        align: 'high'
                    },
                    labels: {
                        overflow: 'justify'
                    }
                },
                tooltip: {
                    valueSuffix: ' (score)'
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom',
                    x: 80,
                    y: 20,
                    floating: true,
                    borderWidth: 1,
                    backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                    shadow: true
                },
                credits: {
                    enabled: false
                },
                series: chartData.series
            });
        });
    });

    
</script>