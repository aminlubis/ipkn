
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
                <?php echo isset($this->session->userdata('user')->kl_icon)?'<img src="'.base_url().PATH_IMAGES.'/'.$this->session->userdata('user')->kl_icon.'" alt="image">':''?>
              </div>
              <!-- <div class="kt-widget__pic kt-widget__pic--brand kt-font-brand kt-font-boldest kt-hidden-">
                SF
              </div> -->
              <div class="kt-widget__content">
                <div class="kt-widget__head">
                  <a href="#" class="kt-widget__username">
                    <?php echo isset($this->session->userdata('user')->kl_name)?strtoupper($this->session->userdata('user')->kl_name):'Administrator'?>
                    <i class="flaticon2-correct kt-font-success"></i>
                  </a>
                  <!-- <a href="<?php echo base_url().'dashboard/Dashboard_ipkn/print_preview'?>" target="_blank" class="btn btn-sm btn-success">
                    <i class="ace-icon fa fa-print-preview icon-on-right bigger-110"></i>
                    Print Preview
                  </a> -->
                </div>
                <!-- <div class="kt-widget__subhead">
                  <a href="#"><i class="flaticon2-new-email"></i><?php echo isset($this->session->userdata('user')->kl_email)?strtoupper($this->session->userdata('user')->kl_email):'-'?></a>
                  <a href="#"><i class="fa fa-globe"></i><?php echo isset($this->session->userdata('user')->kl_link_website)?strtoupper($this->session->userdata('user')->kl_link_website):'-'?> </a>
                </div> -->
                <div class="kt-widget__info">
                  <div class="kt-widget__desc">
                    <!-- <?php echo isset($this->session->userdata('user')->kl_name)?'<span style="font-size:18px !important">'.strtoupper($this->session->userdata('user')->kl_name).'</span>':'<i>You are logged in as administrator</i>'?><br> -->
                    <?php echo isset($this->session->userdata('user')->kl_address)?strtoupper($this->session->userdata('user')->kl_address):'- No address found -'?>
                    <br>
                    <br>
                    <div class="kt-widget__progress" style="width: 100%">
                      <!-- <div class="kt-widget__text">
                        Progress input data <?php echo ($this->session->userdata('user')->role != 1) ? $this->session->userdata('user')->kl_name : 'All Provinsi'?>
                      </div> -->
                      <!-- <div class="progress" style="height: 5px;width: 100%;">
                        <div class="progress-bar kt-bg-<?php echo $class_progress['class']?>" role="progressbar" style="width: <?php echo $progress['persentase_progress']?>%;" aria-valuenow="<?php echo $progress['persentase_progress']?>" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <div class="kt-widget__stats"><?php echo number_format($progress['persentase_progress'],2)?>%</div> -->
                    </div>
                    
                  </div>   
                </div>
                
              </div>
            </div>
          </div>
          <hr>
          
          <div class="form-group row">
            <div class="col-lg-3">
              <label>Year:</label>
              <?php echo $this->master->get_tahun(date('Y'), 'year', 'year', 'form-control', 'onchange="reload_data()"', '') ?>
              <span class="form-text text-muted">Silahkan pilih tahun</span>
            </div>
            <div class="col-lg-4">
              <label class="">Provinsi:</label>
              <?php echo $this->master->custom_selection($params = array('table' => 'mst_provinces', 'id' => 'id', 'name' => 'name', 'where' => array() ), '' , 'province_id', 'province_id', 'form-control', 'onchange="reload_data()"', '') ?>
              <span class="form-text text-muted">Silahkan pilih provinsi</span>
            </div>

            <!-- <div class="col-lg-4">
              <label class="">Pillar:</label>
              <?php echo $this->master->custom_selection($params = array('table' => 'ipkn_mst_pillar', 'id' => 'pillar_id', 'name' => 'pillar_desc', 'where' => array() ), '' , 'pillar_id', 'pillar_id', 'form-control', 'onchange="reload_data()"', '') ?>
              <span class="form-text text-muted">Silahkan pilih pillar</span>
            </div> -->

          </div>
          <hr>
          <div class="kt-widget14__chart">
            <center><div id="kt_chart_global_value" style="padding-bottom: 20px"></div></center>
          </div>

          <hr>

          <div id="kt_table_data"></div>
        
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
    load_polar_chart();
    // load_data_table();
  });

  function load_polar_chart(){
    $('#kt_chart_global_value').load('<?php echo base_url()?>dashboard/Dashboard_ipkn/chart_global?year='+$('#year').val()+'&province='+$('#province_id').val()+'&pillar='+$('#pillar_id').val()+'&' + (new Date()).getTime());
  }

  function load_data_table(){
    $('#kt_table_data').load('<?php echo base_url()?>dashboard/Dashboard_ipkn/table_data_index?year='+$('#year').val()+'&kl='+$('#kl_id').val()+'&subpillar='+$('#subpillar_id').val()+'&' + (new Date()).getTime());
  }

  


  function reload_data(){
    load_polar_chart();
    // load_data_table();
  }

</script>

