
<script>
$(document).ready(function(){

  $('#content_datatable').load('<?php echo base_url()?>cms/Cms_capaian_ipkn/load_datatable');

})

</script>

<style>
  .table>thead tr th {
      white-space: normal !important;
  }
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

<div id="content_datatable"></div>
