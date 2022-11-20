
<script>
$(document).ready(function(){

    $('#form_cms_capaian_ipkn').ajaxForm({
      beforeSend: function() {
        achtungShowLoader();  
      },
      uploadProgress: function(event, position, total, percentComplete) {
      },
      complete: function(xhr) {     
        var data=xhr.responseText;
        var jsonResponse = JSON.parse(data);

        if(jsonResponse.status === 200){
          $.achtung({message: jsonResponse.message, timeout:5});
          $('#page-area-content').load('<?php echo base_url()?>cms/Cms_capaian_ipkn?_=' + (new Date()).getTime());
          reload_notification();
        }else{
          $.achtung({message: jsonResponse.message, timeout:5, className:'achtungFail'});
        }
        achtungHideLoader();
      }
    }); 
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

<form class="kt-form kt-form--label-right" method="post" id="form_cms_capaian_ipkn" action="<?php echo site_url('cms/Cms_capaian_ipkn/process')?>" enctype="multipart/form-data">
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
            <th style="color: white"></th>
            <th style="color: white">Provinsi</th>
            <th style="color: white; text-align: center">Ranking</th>
            <th style="color: white; text-align: center">Skor IPKN</th>
            <?php foreach($index as $row_index) :?>
              <th style="color: white; width: 100px; text-align: center" ><?php echo $row_index->index_desc; ?><br>[<?php echo $row_index->index_id?>]</th>
            <?php endforeach; ?>
          </tr>
        </thead>
        <tbody>
          <?php $no = 0; foreach($provinces as $row_prov) : $no++; ?>
            <tr>
              <td align="center"><?php echo $no;?></td>
              <td><input type="checkbox" style="text-align: center" name="is_active[]" class="form-control"></td>
              <td><input type="hidden" style="text-align: center" name="prov[]" value="<?php echo $row_prov->id;?>" class="form-control"><?php echo $row_prov->name;?></td>
              <td><input type="text" style="text-align: center" name="rank[]" class="form-control"></td>
              <td><input type="text" style="text-align: center" name="score_ipkn[]" class="form-control"></td>
              <?php foreach($index as $row_index) :?>
              <td style="color: white; width: 100px"><input type="text" name="score_index_<?php echo $row_index->index_id?>[]" class="form-control" style="text-align: center"></td>
            <?php endforeach; ?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <div class="kt-portlet__foot">
        <div class="kt-form__actions">
          <div class="row">
            <div class="col-10">
            <button type="submit" id="btnSave" name="submit" class="btn btn-sm btn-info">
              <i class="ace-icon fa fa-check-circle icon-on-right bigger-110"></i>
              Submit
            </button>
            </div>
          </div>
        </div>
      </div>
      <!--end: Datatable -->
    </div>
  </div>
</form>
