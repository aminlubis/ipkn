
<div class="kt-subheader   kt-grid__item" id="kt_subheader">
  <div class="kt-container  kt-container--fluid ">
    <div class="kt-subheader__main">
      <h2 class="kt-subheader__title">
      <?php echo $title?> </h2>
      <span class="kt-subheader__separator kt-hidden"></span>
      <i class="fa fa-angle-double-right"></i> &nbsp; 
      <?php echo isset($breadcrumbs)?$breadcrumbs:''?>
    </div>
  </div>
</div>

<!--Begin::Row-->

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">

  <!--Begin::Section-->
  <div class="row">
    <div class="col-xl-12">

      <!--begin:: Widgets/Applications/User/Profile3-->
      <div class="kt-portlet kt-portlet--height-fluid">
        <div class="kt-portlet__body">
        
          <div class="kt-widget kt-widget--user-profile-3">
            <div class="kt-widget__top">
              <div class="kt-widget__media kt-hidden-">
                <!-- <img src="assets/media/users/100_1.jpg" alt="image"> -->
              </div>
              <div class="kt-widget__pic kt-widget__pic--brand kt-font-brand kt-font-boldest kt-hidden-">
                SF
              </div>
              <div class="kt-widget__content">
                <div class="kt-widget__head">
                  <a href="#" class="kt-widget__username">
                    <?php echo isset($this->session->userdata('user')->kl_short_name)?strtoupper($this->session->userdata('user')->kl_short_name):'Administrator'?>
                    <i class="flaticon2-correct kt-font-success"></i>
                  </a>
                </div>
                <div class="kt-widget__subhead">
                  <a href="#"><i class="flaticon2-new-email"></i><?php echo isset($this->session->userdata('user')->kl_email)?strtoupper($this->session->userdata('user')->kl_email):'-'?></a>
                  <a href="#"><i class="fa fa-globe"></i><?php echo isset($this->session->userdata('user')->kl_link_website)?strtoupper($this->session->userdata('user')->kl_link_website):'-'?> </a>
                </div>
                <div class="kt-widget__info">
                  <div class="kt-widget__desc">
                  <?php echo isset($this->session->userdata('user')->kl_name)?ucwords($this->session->userdata('user')->kl_name):'<i>You are logged in as administrator</i>'?><br>
                  <?php echo isset($this->session->userdata('user')->kl_address)?strtoupper($this->session->userdata('user')->kl_address):'- No address found -'?>
                  </div>
                  
                  <div class="kt-widget__progress">
                    <div class="kt-widget__text" style="width: 250px">
                      Progress input data
                    </div>
                    <div class="progress" style="height: 5px;width: 100%;">
                      <div class="progress-bar kt-bg-<?php echo $class_progress['class']?>" role="progressbar" style="width: <?php echo $progress?>%;" aria-valuenow="<?php echo $progress?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="kt-widget__stats">
                    <?php echo $progress?>%
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr>
          
          <table class="table">
            <tr style="background: #646c9a; color: white;">
                <th>Travel &amp; Tourism Competitiveness Edition</th>
                <th style="text-align: right">Last Year</th>
                <th style="text-align: right">Year <?php echo date('Y')?></th>
            </tr>
              <tbody>
                  <tr>
                      <td>Overall</td>
                      <td style="text-align: right;"><?php echo $overall_score_last_year?></td>
                      <td style="text-align: right; font-size: 16px; font-weight: bold"><?php echo $overall_score?> &nbsp; <?php echo $sign; ?> </td>
                  </tr>
                  <tr>
                      <td>Total Subpillar</td>
                      <td style="text-align: right" colspan="2"> <?php echo $total_subpillar; ?> Components</td>
                  </tr>
                  <tr>
                      <td>Progress Current</td>
                      <td colspan="2" style="text-align: right; color: <?php echo $class_progress['color']?>; font-weight: bold"><?php echo $progress?> (%)  </td>
                  </tr>
              </tbody>
          </table>
          
          <div class="form-group row">
            <div class="col-lg-3">
              <label>Year:</label>
              <?php echo $this->master->get_tahun(date('Y') , 'year', 'year', 'form-control', '', '') ?>
              <span class="form-text text-muted">Please select year</span>
            </div>
            <div class="col-lg-4">
              <label class="">K/L:</label>
              <?php echo $this->master->custom_selection($params = array('table' => 'mst_kl', 'id' => 'kl_id', 'name' => 'kl_name', 'where' => ($this->session->userdata('user')->role != 1) ? array('kl_id' => $this->session->userdata('user')->kl_id ,'is_active' => 'Y') : array('is_active' => 'Y') ), isset($this->session->userdata('user')->kl_id) ? $this->session->userdata('user')->kl_id : '' , 'kl_id', 'kl_id', 'form-control', '', '') ?>
              <span class="form-text text-muted">Please select K/L</span>
            </div>
            <div class="col-lg-4">
              <label>Index Component :</label>
              <?php echo $this->master->custom_selection($params = array('table' => 'mst_subpillar', 'id' => 'subpillar_id', 'name' => 'subpillar_desc', 'where' => ($this->session->userdata('user')->role != 1) ? array('kl_id' => $this->session->userdata('user')->kl_id ,'is_active' => 'Y') : array('is_active' => 'Y') ), '' , 'subpillar_id', 'subpillar_id', 'form-control', '', '') ?>
              <span class="form-text text-muted">Please select index component</span>
            </div>
          </div>
          <hr>
          <div class="kt-widget14__chart">
            <div id="kt_chart_global_value"></div>
          </div>

          <!-- <div class="kt-portlet">
            <div class="kt-portlet__body  kt-portlet__body--fit">
              <div class="row row-no-padding row-col-separator-xl">
                <div class="col-xl-12">

                  <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-widget14">
                      <div class="kt-widget14__chart">
                        <div id="kt_list_datatable"></div>
                      </div>
                    </div>
                  </div>

                </div>
                
              </div>
            </div>
          </div> -->
  
          <span style="font-size: 16px">Travel & Tourism Competitiveness Index, 1–7 (best)</span>
          <table id="summary-table" class="table">
            <thead>
              <tr>  
                <th width="30px" class="center"></th>
                <th width="40px" class="center"></th>
                <th width="40px" class="center">ID</th>
                <th>Pillar</th>
                <th>Subpillar</th>
                <!-- <th>K/L</th> -->
                <th style="text-align: center">Reference Value</th>
                <th style="text-align: center">Input Value</th>
                <th>Score</th>
                <th style="text-align: center">Status Data</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>

        </div>
      </div>

      <!--end:: Widgets/Applications/User/Profile3-->
    </div>
  </div>

  <!--End::Section-->

  <!--Begin::Section-->
  

</div>

<!--End::Row-->
<script>
  $(document).ready(function() {
    $('#kt_chart_global_value').load('<?php echo base_url()?>dashboard/Dashboard/chart_global?_=' + (new Date()).getTime());
    GraphPolarSpiderStyle();
  });

  $(document).ready(function() {
    
    //initiate dataTables plugin
    oTable = $('#summary-table').DataTable({ 
          
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "ordering": false,
      "searching": false,
      "paging": false,
      "bFilter": false,
      
      // Load data for the table's content from an Ajax source
      "ajax": {
          "url": '<?php echo base_url()?>data/Tr_summary_dt/get_data',
          "type": "POST"
      },
      "columnDefs": [
          { 
            "targets": [ 0 ], //last column
            "orderable": false, //set not orderable
          },
          { "aTargets" : [ 0 ], "mData" : 1, "sClass":  "details-control"}, 
          { "visible": true, "targets": [ 0 ] },
          { "targets": [ 0,1 ], "visible": false },
      ],

    });

    $('#summary-table tbody').on('click', 'td.details-control', function () {
        var url_detail = '<?php echo base_url()?>data/Tr_summary_dt/show_detail';
        preventDefault();
        var tr = $(this).closest('tr');
        var row = oTable.row( tr );
        var data = oTable.row( $(this).parents('tr') ).data();
        var kode_primary = data[ 0 ];                  
        console.log(data);
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            /*data*/            
            $.getJSON( url_detail + "/" + kode_primary , '' , function (data) {
                response_data = data;
                // Open this row
                row.child( format_html( response_data ) ).show();
                tr.addClass('shown');
            });
        }
        
    } );

    $('#summary-table tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            oTable.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );
      
  });

  function format_html ( data ) {
    return data.html;
  }

</script>

