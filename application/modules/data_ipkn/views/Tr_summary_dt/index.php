
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="<?php echo base_url()?>assets/landing/css/bootstrap.min.css" type="text/css">

<!-- Material Icon -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/landing/css/materialdesignicons.min.css" /><link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/landing/css/style.css" />

<style>

</style>
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

<style>
.wrapper {
  border: 1px solid #ccc;
  background: #eee;
  /* width: 320px; */
  height: 800px;
  overflow: auto;
  position: relative;
}
table {
  border-spacing: 0;
  white-space: nowrap;
  table-layout: fixed;
}

thead,
tr>th {
  position: sticky;
  background: #eee;
}

thead {
  top: 0;
  z-index: 2;
}
tr>th {
  left: 0;
  z-index: 1;
}
thead tr>th:first-child {
  z-index: 3;
}

th,
td {
  height: 50px;
  border: 1px solid #ccc;
  border-width: 0 0 1px 1px;
  text-align: left;
  padding: 10px;
  font-family: sans-serif;
}
td {
  background: #fff;
}
th:first-child {
  border-right-width: 1px;
  border-left: 0;
}
th+td,
th:first-child+th {
  border-left: 0;
}
tbody tr:last-child>* {
  border-bottom: 0;
}
tr>*:last-child {
  border-right: 0;
}
      </style>

      







<form class="form-horizontal" method="post" id="form_search" action="#">

  <div class="kt-portlet">
    <div class="kt-portlet__head">
      <div class="kt-portlet__head-label">
        <h3 class="kt-portlet__head-title">
          Hasil Perhitungan Data Indikator
        </h3>
      </div>
    </div>

    <!--begin::Form-->
      <div class="kt-portlet__body">
        <div class="kt-section kt-section--first">
          
        <div class="form-group row">
          <label class="col-lg-1 col-form-label">Tahun</label>
          <div class="col-lg-3">
            <?php echo $this->master->get_tahun(date('Y') , 'tahun', 'tahun', 'form-control', '', '') ?>
          </div>
          <!-- <div class="col-lg-4">
            <a href="#" id="btn_search_data" class="btn btn-xs btn-primary">
              Search
            </a>
            <a href="#" id="btn_reset_data" class="btn btn-xs btn-warning">
              Reset
            </a>
          </div> -->
        </div>

        <div class="wrapper">
          <table>
            <thead>
              <tr style="color: black !important">
                <th rowspan="3" style="width: 20px !important">No</th>
                <th rowspan="3">Provinsi</th>
                <?php 
                  foreach ($header as $key_subindex => $row_subindex) {
                    foreach($row_subindex as $key_pillar => $row_pillar){
                      $colspan = count($row_pillar) * 2;
                      echo '<th colspan="'.$colspan.'" align="center">'.$key_pillar.'</th>';
                    }
                }?>
              </tr>
              <tr style="color: black !important">
                <?php 
                  foreach ($header as $key_subindex => $row_subindex) {
                    foreach($row_subindex as $key_pillar => $row_pillar){
                      foreach ($row_pillar as $key_indicator => $row_indicator) {
                        # code...
                        echo '<th colspan="2" style="white-space: pre-wrap">'.$row_indicator->indicator_code.'<br>'.$row_indicator->indicator_name.'</th>';
                      }
                    }
                }?>
              </tr>
              <tr style="color: black !important">
              <?php 
                  foreach ($header as $key_subindex => $row_subindex) {
                    foreach($row_subindex as $key_pillar => $row_pillar){
                      foreach ($row_pillar as $key_indicator => $row_indicator) {
                        # code...
                        echo '<th>Nilai</th>';
                        echo '<th>Skor</th>';
                      }
                    }
                }?>
              <tr>
            </thead>
            <tbody>
              <?php $no=0; foreach ($provinces as $key => $value_prov) : $no++?>
                <tr>
                  <th scope="row"><?php echo $no?></th>
                  <th scope="row"><?php echo $value_prov->name?></th>
                  <?php 
                  foreach ($header as $key_subindex => $row_subindex) {
                    foreach($row_subindex as $key_pillar => $row_pillar){
                      foreach ($row_pillar as $key_indicator => $row_indicator) {
                        # code...
                        $getrow = isset($summary[$value_prov->id][$row_indicator->indicator_id])?$summary[$value_prov->id][$row_indicator->indicator_id]:'';
                        $value_dt = isset($getrow->value)?$getrow->value:0;
                        $score_dt = isset($getrow->score1)?$getrow->score1:0;
                        echo '<td>'.number_format($value_dt, 2).'</td>';
                        echo '<td>'.number_format($score_dt, 2).'</td>';
                      }
                    }
                }?>
                </tr>
              <?php endforeach;?>
            </tbody>
          </table>
        </div>
        
        </div>
      </div>
      
    <!--end::Form-->
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
