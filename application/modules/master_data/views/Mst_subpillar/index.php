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

  <!-- <div class="kt-portlet">
    <div class="kt-portlet__head">
      <div class="kt-portlet__head-label">
        <h3 class="kt-portlet__head-title">
          Pencarian Data
        </h3>
      </div>
    </div>

    <div class="kt-portlet__body">
      <div class="kt-section kt-section--first">
        
      <div class="form-group row">
        <label class="col-lg-2 col-form-label">Kementerian/Lembaga</label>
        <div class="col-lg-5">
          <?php echo $this->master->custom_selection($params = array('table' => 'mst_kl', 'id' => 'kl_id', 'name' => 'kl_name', 'where' => array() ), '' , 'mst_kl', 'mst_kl', 'form-control', '', '') ?>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-lg-2 col-form-label">Pillar TTCI</label>
        <div class="col-lg-7">
          <?php echo $this->master->custom_selection($params = array('table' => 'mst_pillar', 'id' => 'pillar_id', 'name' => 'pillar_desc', 'where' => array() ), '' , 'mst_pillar', 'mst_pillar', 'form-control', '', '') ?>
        </div>
        <div class="col-lg-2">
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
  </div> -->

  <div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
      <div class="kt-portlet__head-toolbar">
        <div class="kt-portlet__head-wrapper">
          <div class="kt-portlet__head-actions">
            <?php echo $this->authuser->show_button('master_data/Mst_subpillar','C','',1)?>
            <?php echo $this->authuser->show_button('master_data/Mst_subpillar','D','',5)?>
            <?php echo $this->authuser->show_button('master_data/Mst_subpillar','EX','',1)?>
          </div>
        </div>
      </div>
    </div>
    <div class="kt-portlet__body">

      <!--begin: Datatable -->
      <table id="dynamic-table" base-url="<?php echo base_url()?>master_data/Mst_subpillar"  url-detail="<?php echo base_url()?>master_data/Mst_subpillar/show_detail"class="table table-responsive-sm table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline">
      <thead>
        <tr class="table-bg-green">  
          <th width="20px" class="center"></th>
          <th width="20px" class="center"></th>
          <th width="20px" class="center"></th>
          <th style="color: white" width="80px">Action</th>
          <!-- <th style="color: white" width="50px">ID</th> -->
          <th style="color: white">K/L</th>
          <th style="color: white">Pillar</th>
          <th style="color: white">Subpillar</th>
          <th style="color: white" width="80px">Status</th>
          <th style="color: white" width="100px">Last Update</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
      </table>

      <!--end: Datatable -->
    </div>
  </div>

</form>

<script src="<?php echo base_url().'assets/js/custom/als_datatable_with_detail_custom_url.js'?>"></script>