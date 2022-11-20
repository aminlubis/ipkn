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

<div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
      <div class="kt-portlet__head-toolbar">
        <div class="kt-portlet__head-wrapper">
          <div class="kt-portlet__head-actions">
            <?php echo $this->master->get_tahun(date('Y'),'tahun','tahun','form-control','','');?>
          </div>
        </div>
      </div>
    </div>
    <div class="kt-portlet__body">

      <!--begin: Datatable -->
      <table base-url="<?php echo base_url()?>cms/Cms_capaian_ipkn" class="table table-responsive-sm table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline">
        <thead>
          <tr class="table-bg-green">  
            <th width="30px" style="text-align: center; valign: top">No</th>
            <th style="color: white">Provinsi</th>
            <th style="color: white; text-align: center">Ranking</th>
            <th style="color: white; text-align: center">IPKN</th>
            <?php foreach($index as $row_index) :?>
              <th style="color: white; width: 100px; text-align: center" ><?php echo $row_index->index_desc; ?></th>
            <?php endforeach; ?>
          </tr>
        </thead>
        <tbody>
          <?php $no = 0; foreach($provinces as $row_prov) : $no++; ?>
            <tr>
              <td align="center"><?php echo $no;?></td>
              <td><?php echo $row_prov->name;?></td>
              <td><input type="text" style="text-align: center" class="form-control"></td>
              <td><input type="text" style="text-align: center" class="form-control"></td>
              <?php foreach($index as $row_index) :?>
              <td style="color: white; width: 100px"><input type="text" class="form-control" style="text-align: center"></td>
            <?php endforeach; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <!--end: Datatable -->
    </div>
  </div>

<script src="<?php echo base_url().'assets/js/custom/als_datatable.js'?>"></script>