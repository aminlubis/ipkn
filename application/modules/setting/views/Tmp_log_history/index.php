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
  
    <div class="kt-portlet__body">

      <!--begin: Datatable -->
      <table id="dynamic-table" base-url="<?php echo base_url()?>setting/Tmp_log_history" class="table table-responsive-sm table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline">
      <thead>
        <tr>  
          <th width="30px" class="center"></th>
          <th width="50px">ID</th>
          <th width="120px">User Activity</th>
          <th width="150px">IP Address</th>
          <th width="150px">User Agent</th>
          <th width="150px">Time</th>
          <!-- <th>Query Excecute</th> -->
          <th width="100px">Last Update</th>
          
        </tr>
      </thead>
      <tbody>
      </tbody>
      </table>

      <!--end: Datatable -->
    </div>
  </div>

<script src="<?php echo base_url().'assets/js/custom/als_datatable.js'?>"></script>