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
            <?php echo $this->authuser->show_button('cms/Cms_posting','C','',1)?>
            <?php echo $this->authuser->show_button('cms/Cms_posting','D','',5)?>
            <?php echo $this->authuser->show_button('cms/Cms_posting','EX','',1)?>
          </div>
        </div>
      </div>
    </div>
    <div class="kt-portlet__body">

      <!--begin: Datatable -->
      <table id="dynamic-table" base-url="<?php echo base_url()?>cms/Cms_posting" class="table table-responsive-sm table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline">
        <thead>
          <tr class="table-bg-green">  
            <th width="30px" style="text-align: center; valign: top"></th>
            <th style="color: white; width: 130px">Action</th>
            <th style="color: white">Section</th>
            <th style="color: white">Judul</th>
            <th style="color: white">Author</th>
            <th style="color: white">Tgl Publish</th>
            <th style="color: white">Viewer</th>
            <th style="color: white">Status</th>
            <th style="color: white" width="100px">Posted By</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>

      <!--end: Datatable -->
    </div>
  </div>

<script src="<?php echo base_url().'assets/js/custom/als_datatable.js'?>"></script>