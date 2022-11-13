
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="<?php echo base_url()?>assets/landing/css/bootstrap.min.css" type="text/css">

<!-- Material Icon -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/landing/css/materialdesignicons.min.css" /><link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/landing/css/style.css" />

<div class="kt-subheader   kt-grid__item" id="kt_subheader">
  <div class="kt-container  kt-container--fluid ">
    <div class="kt-subheader__main">
      <h1 class="kt-subheader__title">
      <?php echo $title?> </h1>
      <span class="kt-subheader__separator kt-hidden"></span>
      <i class="fa fa-angle-double-right"></i> &nbsp; 
      <?php echo isset($breadcrumbs)?$breadcrumbs:''?>
    </div>
  </div>
</div>

<form class="form-horizontal" method="post" id="form_search" action="#">

  <div class="kt-portlet">
    <div class="kt-portlet__head">
      <div class="kt-portlet__head-label">
        <h3 class="kt-portlet__head-title">
          Pencarian Data
        </h3>
      </div>
    </div>

    <!--begin::Form-->
      <div class="kt-portlet__body">
        <div class="kt-section kt-section--first">
          
        <div class="form-group row">
          <label class="col-lg-1 col-form-label">Tahun</label>
          <div class="col-lg-3">
            <?php echo $this->master->get_tahun('' , 'tahun', 'tahun', 'form-control', '', '') ?>
          </div>
          <!-- <label class="col-lg-2 col-form-label">Kementerian/Lembaga</label>
          <div class="col-lg-5">
            <?php echo $this->master->custom_selection($params = array('table' => 'mst_kl', 'id' => 'kl_id', 'name' => 'kl_name', 'where' => array() ), '' , 'mst_kl', 'mst_kl', 'form-control', '', '') ?>
          </div> -->
          <div class="col-lg-4">
            <a href="#" id="btn_search_data" class="btn btn-xs btn-primary">
              Search
            </a>
            <a href="#" id="btn_reset_data" class="btn btn-xs btn-warning">
              Reset
            </a>
          </div>
        </div>
        
        </div>
      </div>
      
    <!--end::Form-->
  </div>

  <div class="kt-portlet">
    <div class="kt-portlet__head">
      <div class="kt-portlet__head-label">
        <span class="kt-portlet__head-icon kt-hidden">
          <i class="la la-gear"></i>
        </span>
        <h3 class="kt-portlet__head-title">
          Percentage of data status
        </h3>
      </div>
    </div>
    <div class="kt-portlet__body">
      <div id="kt_pie_chart" style="height: 400px;"></div>

    </div>
  </div>
  
  
  <div class="kt-portlet kt-portlet--mobile">
    
    <div class="kt-portlet__body">

    

    <table class="table fold-table">
      <thead>
          <tr>
              <th style="width: 60px">No</th>
              <th>Index Component</th>
              <th style="width: 80px">Last Score</th>
              <th style="width: 80px">Current Score (<?php echo $year_current?>)</th>
              <th></th>
          </tr>
      </thead>
      <tbody>
          <?php 
            $no=0; 
            foreach ($subpillar as $key_dt => $row_dt) : 
              $no++; 
              $last_score_pillar = array_sum($last_score[$key_dt]) / count($last_score[$key_dt]);
              $current_score_pillar = array_sum($current_score[$key_dt]) / count($current_score[$key_dt]);
              $sign = $this->master->getSignScore($current_score_pillar, $last_score_pillar);
          ?>
            <tr class="view">
                <td style="text-align: center"><?php echo $no?></td>
                <td style="text-align: left"><?php echo ucwords($key_dt); ?></td>
                <td style="width:80px; text-align: right"><?php echo number_format($last_score_pillar, 2)?></td>
                <td style="width:80px; text-align: right"><?php echo number_format($current_score_pillar, 2)?> <?php echo $sign; ?></td>
                <td style="width:80px; text-align: right"><span class="table-view-dropdown"></span></td>
            </tr>
            
              <tr class="fold">
                  <td class="fold-area" colspan="5">
                      <div class="fold-content">
                          <table class="table">
                              <tbody>
                              <?php 
                                foreach ($row_dt as $key_ln => $row_ln) : 
                                  $sign_subpillar = $this->master->getSignScore($row_ln['current_score'], $row_ln['last_score']);
                              ?>
                                <tr>
                                    <td style="width: 60px"></td>
                                    <td style="text-align: left; padding-left: 30px"><?php echo ucwords($row_ln['subpillar_desc']); ?></td>
                                    <td style="width:80px; text-align: right"><?php echo number_format($row_ln['last_score'], 2)?></td>
                                    <td style="width:80px; text-align: right"><?php echo number_format($row_ln['current_score'], 2)?> <?php echo $sign_subpillar; ?></td>
                                    <th style="width:80px; text-align: right">&nbsp;</th>
                                </tr>
                              <?php endforeach; ?>
                              </tbody>
                          </table>
                      </div>
                  </td>
              </tr>
          <?php endforeach; ?>
        </tbody>
    </table>
    
           <!--end: Datatable -->
    </div>
  </div>
  
</form>


<script src="<?php echo base_url()?>assets/landing/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url()?>assets/landing/js/jquery.easing.min.js"></script>
<script src="<?php echo base_url()?>assets/landing/js/scrollspy.min.js"></script>
<script src="<?php echo base_url()?>assets/landing/js/feather.min.js"></script>

<!-- app js -->
<script src="<?php echo base_url()?>assets/landing/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url()?>assets/landing/js/app.js"></script>

<script>
  $(document).ready(function() {
    $('#kt_pie_chart').load('<?php echo base_url()?>data/Tr_summary_dt/summary_pie_chart?_=' + (new Date()).getTime());
  });
</script>
