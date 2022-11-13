<div id="zoomable-radar-chart" style="min-width: 400px; width: 100%; min-height: 500px; margin: 0 auto"></div>
    
<!-- end highchat modules -->
<script>
    am4core.ready(function() {
        
        $.getJSON('<?php echo base_url()?>Templates/Templates/graph?prefix=12&TypeChart=radar-zoomable&style=1&mod=1', {id: 1}, function(chartData) {

            // Themes begin
            am4core.useTheme(am4themes_animated);
            // Themes end

            var chart = am4core.create("zoomable-radar-chart", am4charts.RadarChart);
            chart.hiddenState.properties.opacity = 0; // this creates initial fade-in

            chart.data = chartData.series.data;

            chart.padding(20, 20, 20, 20);

            var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
            categoryAxis.dataFields.category = "category";
            categoryAxis.renderer.labels.template.location = 0.5;
            categoryAxis.renderer.tooltipLocation = 0.5;

            var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
            valueAxis.tooltip.disabled = true;
            valueAxis.renderer.labels.template.horizontalCenter = "left";
            valueAxis.min = 0;

            // $.each(chartData.series.category,function(index, value){
            //     console.log('My array has at position ' + index + ', this value: ' + value);
            //     var index = chart.series.push(new am4charts.RadarColumnSeries());
            //     index.columns.template.tooltipText = "{name} : {valueY.value}";
            //     index.columns.template.width = am4core.percent(80);
            //     index.name = "Score "+value;
            //     index.dataFields.categoryX = "category";
            //     index.dataFields.valueY = "value_"+index;
            //     index.stacked = true;
            // });

            var series1 = chart.series.push(new am4charts.RadarColumnSeries());
            series1.columns.template.tooltipText = "{name} : {valueY.value}";
            series1.columns.template.width = am4core.percent(80);
            series1.name = "Score 2019";
            series1.dataFields.categoryX = "category";
            series1.dataFields.valueY = "value_2019";
            series1.stacked = true;
            series1.columns.template.fill = am4core.color("#8dabda");

            var series2 = chart.series.push(new am4charts.RadarColumnSeries());
            series2.columns.template.width = am4core.percent(80);
            series2.columns.template.tooltipText = "{name} : {valueY.value}";
            series2.name = "Score 2021";
            series2.dataFields.categoryX = "category";
            series2.dataFields.valueY = "value_2021";
            series2.stacked = true;

            series2.columns.template.fill = am4core.color("#4d5f7b");

            chart.seriesContainer.zIndex = -1;

            // chart.scrollbarX = new am4core.Scrollbar();
            // chart.scrollbarX.exportable = false;
            // chart.scrollbarY = new am4core.Scrollbar();
            // chart.scrollbarY.exportable = false;

            chart.cursor = new am4charts.RadarCursor();
            chart.cursor.xAxis = categoryAxis;
            chart.cursor.fullWidthXLine = true;
            chart.cursor.lineX.strokeOpacity = 0;
            chart.cursor.lineX.fillOpacity = 0.1;
            chart.cursor.lineX.fill = am4core.color("#000000");

            var label = categoryAxis.renderer.labels.template;
            label.wrap = true;
            label.maxWidth = 120;
        });
    }); // end am4core.ready()
    </script>
