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

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
      <div class="kt-portlet__head-toolbar">
        <div class="kt-portlet__head-wrapper">
          <div class="kt-portlet__head-actions">
          <?php echo $this->authuser->show_button('setting/Global_parameter?flag='.$flag_string.'','C','','7/'.$flag_string.'')?>
            <?php echo $this->authuser->show_button('setting/Global_parameter?flag='.$flag_string.'','D','',5)?>
          </div>
        </div>
      </div>
    </div>
    <div class="kt-portlet__body">

      <!--begin: Datatable -->
      <table id="dynamic-table" base-url="<?php echo base_url()?>setting/Global_parameter" data-id="flag=<?php echo $flag_string?>" url-detail="<?php echo base_url()?>setting/Global_parameter/show_detail" class="table table-responsive-sm table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline">
      <thead>
        <tr>  
          <th width="30px" style="text-align: center; valign: top"></th>
          <th></th>
          <th></th>
          <th width="100px">Action</th>
          <th width="50px">ID</th>
          <th>Label</th>
          <th>Value</th>
          <th>Status</th>
          <th width="100px">Last Update</th>
          
        </tr>
      </thead>
      <tbody>
      </tbody>
      </table>

      <!--end: Datatable -->
    </div>
  </div>


  <script src="<?php echo base_url().'assets/js/custom/als_datatable_with_detail_custom_url.js'?>"></script>