$(function () {

    //on page load  
    pageLoadGraph();
    
    function pageLoadGraph(){
      var url_string = window.location;
      var url = new URL(url_string);
      var mod = 1;
      console.log(mod);
      $.getJSON('templates/Templates/getGraphModule', {mod: mod}, function(response_data) {
        html = '';
        $.each(response_data, function (i, o) {
          html += '<div class="col-sm-'+o.col_size+'"><div id="'+o.nameid+'"></div></div>';
          if(o.style=='column'){
            GraphColumnStyle(o.mod, o.nameid, o.url);
          }
          if(o.style=='pie'){
            GraphPieStyle(o.mod, o.nameid, o.url);
          }
          if(o.style=='line'){
            GraphLineStyle(o.mod, o.nameid, o.url);
          }
          if(o.style=='table'){
            GraphTableStyle(o.mod, o.nameid, o.url);
          }
          if(o.style=='polar'){
            GraphPolarSpiderStyle(o.mod, o.nameid, o.url);
          }

          });
          $('#content_graph').html(html);
      });
    }

    function GraphColumnStyle(id, nameid, url){

      //use getJSON to get the dynamic data via AJAX call
      $.getJSON(url, {id: id}, function(chartData) {
        //alert(chartData.xAxis.categories); return false;
        $('#'+nameid).highcharts({

          chart: {
                type: 'column'
            },
            title: {
                text: chartData.title,
            },
            subtitle: {
                text: chartData.subtitle,
            },
            xAxis: chartData.xAxis,
            yAxis: {
                min: 0,
                title: {
                    text: 'Total'
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: chartData.series
        });
      });
    }

    function GraphPieStyle(id, nameid, url){

      //use getJSON to get the dynamic data via AJAX call
      $.getJSON(url, {id: id}, function(chartData) {
        //alert(chartData.xAxis.categories); return false;
        $('#'+nameid).highcharts({

          chart: {
              type: 'pie',
              options3d: {
                  enabled: true,
                  alpha: 45,
                  beta: 0
              }
          },
          title: {
              text: chartData.title
          },
          subtitle: {
                text: chartData.subtitle,
            },
          tooltip: {
              pointFormat: 'Persentase: <b>{point.percentage:.1f}%</b>'
          },
          plotOptions: {
              pie: {
                  allowPointSelect: true,
                  cursor: 'pointer',
                  depth: 35,
                  dataLabels: {
                      enabled: true,
                      format: '{point.name}'
                  }
              }
          },
          series: [{
              data: chartData.series
          }]

        });

      });
    }

    function GraphLineStyle(id, nameid, url){

      //use getJSON to get the dynamic data via AJAX call
      $.getJSON(url, {id: id}, function(chartData) {
        //alert(chartData.xAxis.categories); return false;
        $('#'+nameid).highcharts({

          title: {
              text: chartData.title,
              x: -20 //center
          },
          subtitle: {
              text: chartData.subtitle,
              x: -20
          },
          xAxis: chartData.xAxis,
          yAxis: {
              title: {
                  text: 'Total'
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
              align: 'center',
              verticalAlign: 'bottom',
              borderWidth: 0
          },
          series: chartData.series

        });

      });
    }

    function GraphTableStyle(id, nameid, url){

      //use getJSON to get the dynamic data via AJAX call
      $.getJSON(url, {id: id}, function(chartData) {
        //alert(chartData.xAxis.categories); return false;
        $('#'+nameid).html('<h3 align="center">'+chartData.title+'</h3>'+chartData.series);

      });
    }

    function GraphPolarSpiderStyle(id, nameid, url){

      //use getJSON to get the dynamic data via AJAX call
      $.getJSON(url, {id: id}, function(chartData) {
        
        $('#'+nameid).highcharts({

          chart: {
              polar: true,
              type: 'line'
          },

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
              min: 0
          },

          tooltip: {
              shared: true,
              pointFormat: '<span style="color:{series.color}">{series.name}: <b>${point.y:,.0f}</b><br/>'
          },

          legend: {
              align: 'right',
              verticalAlign: 'top',
              y: 70,
              layout: 'vertical'
          },

          series: chartData.series,

          // series: [{
          //     name: 'Allocated Budget',
          //     data: [43000, 19000, 60000, 35000, 17000, 10000],
          //     pointPlacement: 'on'
          // }, {
          //     name: 'Actual Spending',
          //     data: [50000, 39000, 42000, 31000, 26000, 14000],
          //     pointPlacement: 'on'
          // }]

      });

        $('#'+nameid).highcharts({

          chart: {
                type: 'column'
            },
            title: {
                text: chartData.title,
            },
            subtitle: {
                text: chartData.subtitle,
            },
            xAxis: chartData.xAxis,
            yAxis: {
                min: 0,
                title: {
                    text: 'Total'
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: chartData.series
        });
      });
    }


});
