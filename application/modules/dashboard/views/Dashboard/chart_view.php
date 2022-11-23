
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
                  <?php echo isset($this->session->userdata('user')->kl_address)?strtoupper($this->session->userdata('user')->kl_address):'- No address found -'?>
                  <br>

                  <a href="<?php echo base_url().'dashboard/Dashboard/print_preview'?>" target="_blank" class="btn btn-sm btn-success">
                    <i class="ace-icon fa fa-print-preview icon-on-right bigger-110"></i>
                    Print Preview
                  </a>
                </div>
                
                
              </div>
            </div>
          </div>
          <hr>
          
          <div class="form-group row">
            <div class="col-lg-3">
              <label>Year:</label>
              <?php echo $this->master->get_tahun($year_current , 'year', 'year', 'form-control', 'onchange="reload_data()"', '') ?>
              <span class="form-text text-muted">Please select year</span>
            </div>
            <div class="col-lg-4">
              <label class="">Kementerian:</label>
              <?php echo $this->master->custom_selection($params = array('table' => 'mst_kl', 'id' => 'kl_id', 'name' => 'kl_name', 'where' => ($this->session->userdata('user')->role != 1) ? array('kl_id' => $this->session->userdata('user')->kl_id ,'is_active' => 'Y') : array('is_active' => 'Y') ), isset($this->session->userdata('user')->kl_id) ? $this->session->userdata('user')->kl_id : '' , 'kl_id', 'kl_id', 'form-control', 'onchange="reload_data()"', '') ?>
              
              <span class="form-text text-muted">Please select Kementerian</span>
              
            </div>

          </div>
          <hr>
          <div class="kt-widget__info">
            <div class="kt-widget__desc">
              
              <br>
              <div class="kt-widget__progress" style="width: 100%">
                <div class="kt-widget__text">
                  Progress input data <?php echo ($this->session->userdata('user')->role != 1) ? $this->session->userdata('user')->kl_name : 'Semua Kementerian'?>
                </div>
                <div class="progress" style="height: 5px;width: 100%;" id="bar_progress">
                  <div id="barprogress" class="progress-bar kt-bg-<?php echo isset($class_progress['class'])?$class_progress['class']:'danger'?>" role="progressbar" style="width: <?php echo isset($progress['persentase_progress']) ? $progress['persentase_progress'] : 0?>%;" aria-valuenow="<?php echo isset($progress['persentase_progress']) ? $progress['persentase_progress'] : 0?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="kt-widget__stats" id="persentase_progres"><?php echo number_format(isset($progress['persentase_progress']) ? $progress['persentase_progress'] : 0,2)?>%</div>
              </div>
              
            </div>
          </div><hr>
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
    load_data_table();
  });

  function load_polar_chart(){
    $('#kt_chart_global_value').load('<?php echo base_url()?>dashboard/Dashboard/chart_global?year='+$('#year').val()+'&kl='+$('#kl_id').val()+'&subpillar='+$('#subpillar_id').val()+'&' + (new Date()).getTime());
  }

  function load_data_table(){
    $('#kt_table_data').load('<?php echo base_url()?>dashboard/Dashboard/table_data_index?year='+$('#year').val()+'&kl='+$('#kl_id').val()+'&subpillar='+$('#subpillar_id').val()+'&' + (new Date()).getTime());
  }

  function get_progres(){
    $.getJSON('<?php echo base_url()?>dashboard/Dashboard/getProgresEntry', {year: $('#year').val(), kl: $('#kl_id').val() }, function(response) {
      var obj = response.progress;
      var class_obj = response.class_progress;
      var percent = ( obj.persentase_progress > 0 ) ? obj.persentase_progress : 0 ;
      $('#persentase_progres').text(percent+' %');
      $('#barprogress').attr('class', "progress-bar kt-bg-"+class_obj.class+"");
      $('#barprogress').attr('aria-valuenow', percent);
      $('#barprogress').css({"width": ""+percent+"%"});
    })
  }

  function reload_data(){
    load_polar_chart();
    load_data_table();
    get_progres();
  }

</script>

