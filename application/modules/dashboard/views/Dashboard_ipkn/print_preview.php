<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/landing/css/materialdesignicons.min.css" /><link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/landing/css/style.css" />
<link href="<?php echo base_url()?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

<body style="background: white !important; padding: 20px">
 <!-- hidden -->
 <input type="hidden" name="year" id="year" value="2021">
<input type="hidden" name="kl_id" id="kl_id" value="<?php echo isset($this->session->userdata('user')->kl_id) ? $this->session->userdata('user')->kl_id : 0; ?>">

<!-- <div class="row">
  <div class="col-xl-8 col-lg-12 order-lg-3 order-xl-1">

    <div class="kt-portlet kt-portlet--height-fluid">
      <div class="kt-portlet__head" id="print-btn">
        <div class="kt-portlet__head-label">
            
        </div>
      </div>
      <div class="kt-portlet__body">
        <div class="col-xl-8 col-lg-12 order-lg-3 order-xl-1">
          <div id="zoomable_radar_chart"></div>
        </div>
      </div>
    </div>
  </div>
</div> -->

<div class="row" id="printpagebutton">
  <div class="col-sm-12">
    <a href="#" onclick="printPage()" class="btn btn-sm btn-success" width="100px">
      <i class="ace-icon fa fa-print-preview icon-on-right bigger-110"></i>
      Print Preview
    </a>
  </div>
</div>
<!-- 
<div class="row">
  <div class="col-sm-12">
    <div id="polar-spider"></div>
  </div>
</div> -->
<center>
  <h2>Indonesia Performance Overview</h2>
  Travel & Tourism Competitiveness Index
</center>
<div class="row">
  <div class="col-sm-12">
    <div id="zoomable_radar_chart"></div>
    <div style="text-align: center; width: 100%; padding-top: 20px">
        Note : Skenario dibuat berdasarkan data yang dikirim oleh masing-maing K/L dengan asumsi data primer (EOS) tetap, serta data sekunder yang belum tersedia diasumsikan tetap
    </div>
  </div>
</div>

<div class="row" style="padding-top: 10%">
  <div class="col-sm-12">
    <div id="kt_table_data_detail"></div>
  </div>
</div>

</body>
<!--begin::Global Theme Bundle(used by all pages) -->
<script src="<?php echo base_url()?>assets/plugins/global/plugins.bundle.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/js/scripts.bundle.js" type="text/javascript"></script>
<!--end::Global Theme Bundle -->

<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<!-- highchat modules -->
<script src="<?php echo base_url()?>assets/js/chart/highcharts.js"></script>
<script src="<?php echo base_url()?>assets/js/chart/highcharts-more.js"></script>
<script src="<?php echo base_url()?>assets/js/chart/modules/exporting.js"></script>


<!--End::Row-->
<script>

  function printPage() {
      //Get the print button and put it into a variable
      var printButton = document.getElementById("printpagebutton");
      //Set the print button visibility to 'hidden' 
      printButton.style.visibility = 'hidden';
      //Print the page content
      window.print()
      printButton.style.visibility = 'visible';
  }

  $(document).ready(function() {
    load_polar_chart();
    load_data_table();
  });

  function load_polar_chart(){
    $('#kt_chart_global_value').load('<?php echo base_url()?>dashboard/Dashboard/chart_global?year='+$('#year').val()+'&kl='+$('#kl_id').val()+'&subpillar='+$('#subpillar_id').val()+'&' + (new Date()).getTime());
  }

  function load_data_table(){
    $('#kt_table_data_detail').load('<?php echo base_url()?>dashboard/Dashboard/table_data_index_detail?year='+$('#year').val()+'&kl='+$('#kl_id').val()+'&subpillar='+$('#subpillar_id').val()+'&' + (new Date()).getTime());
  }

  function reload_data(){
    load_polar_chart();
    load_data_table();
  }

</script>

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

