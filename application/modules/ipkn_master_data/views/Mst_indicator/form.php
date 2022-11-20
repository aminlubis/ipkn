<script>
$(document).ready(function(){
  
    $('#form_Mst_indicator').ajaxForm({
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
          $('#page-area-content').load('<?php echo base_url()?>ipkn_master_data/Mst_indicator?_=' + (new Date()).getTime());
        }else{
          $.achtung({message: jsonResponse.message, timeout:5, className:'achtungFail'});
        }
        achtungHideLoader();
      }
    }); 
})

</script>
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

<div class="row">
  <div class="col-md-12">
    <!-- PAGE CONTENT BEGINS -->
    <div class="kt-portlet">
      <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
          <h3 class="kt-portlet__head-title">
            Form Add/Edit Data
          </h3>
        </div>
      </div>

      <!--begin::Form-->
      <form class="kt-form kt-form--label-right" method="post" id="form_Mst_indicator" action="<?php echo site_url('ipkn_master_data/Mst_indicator/process')?>" enctype="multipart/form-data">
        <br>

        <div class="form-group row">
          <label class="col-form-label col-md-2">ID</label>
          <div class="col-md-1">
            <input name="id" id="id" value="<?php echo isset($value)?$value->indicator_id:0?>" placeholder="Auto" class="form-control" type="text" readonly>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-2">Pillar</label>
          <div class="col-md-8">
            <?php echo $this->master->custom_selection($params = array('table' => 'ipkn_mst_pillar', 'id' => 'pillar_id', 'name' => 'pillar_desc', 'where' => array('is_active' => 'Y') ), isset($value)?$value->pillar_id:'' , 'pillar_id', 'pillar_id', 'form-control', '', '') ?>
          </div>
        </div>


        <div class="form-group row">
          <label class="col-form-label col-md-2">Kode</label>
          <div class="col-md-1">
            <input type="text" name="indicator_code" class="form-control" <?php echo ($flag=='read')?'readonly':''?>  value="<?php echo isset($value)?$value->indicator_code:''?>">
          </div>
          <label class="col-form-label col-md-1">Indikator</label>
          <div class="col-md-7">
            <input type="text" name="indicator_name" class="form-control" <?php echo ($flag=='read')?'readonly':''?>  value="<?php echo isset($value)?$value->indicator_name:''?>">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-2">Sumber Data</label>
          <div class="col-md-9">
            <input type="text" name="indicator_source" class="form-control" <?php echo ($flag=='read')?'readonly':''?>  value="<?php echo isset($value)?$value->indicator_source:''?>">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-2">Owner Data</label>
          <div class="col-md-2">
            <input name="indicator_owner" id="indicator_owner" value="<?php echo isset($value)?$value->indicator_owner:''?>"  class="form-control" type="text">
          </div>
          <label class="col-form-label col-md-1">Satuan</label>
          <div class="col-md-4">
            <input name="indicator_unit" id="indicator_unit" value="<?php echo isset($value)?$value->indicator_unit:''?>"  class="form-control" type="text">
          </div>
          <label class="col-form-label col-md-1">Rasio</label>
          <div class="col-md-1">
            <input name="indicator_ratio" id="indicator_ratio" value="<?php echo isset($value)?$value->indicator_ratio:''?>"  class="form-control" type="text">
          </div>
        </div>


        <div class="form-group row">
          <label class="col-md-2 col-form-label">Min</label>
          <div class="col-lg-1">
            <input name="indicator_min_value" id="indicator_min_value" value="<?php echo isset($value)?$value->indicator_min_value:''?>"  class="form-control" type="text">
          </div>

          <label class="col-lg-1 col-form-label">Median</label>
          <div class="col-lg-1">
            <input name="indicator_med_value" id="indicator_med_value" value="<?php echo isset($value)?$value->indicator_med_value:''?>"  class="form-control" type="text">
          </div>

          <label class="col-lg-1 col-form-label">Max</label>
          <div class="col-lg-1">
            <input name="indicator_max_value" id="indicator_max_value" value="<?php echo isset($value)?$value->indicator_max_value:''?>"  class="form-control" type="text">
          </div>

          <label class="col-lg-1 col-form-label">Tipe Nilai</label>
          <div class="col-lg-1">
            <input name="indicator_type_value" id="indicator_type_value" value="<?php echo isset($value)?$value->indicator_type_value:''?>"  class="form-control" type="text">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-2">Deskripsi</label>
          <div class="col-md-9">
            <input type="text" name="indicator_desc" class="form-control" <?php echo ($flag=='read')?'readonly':''?>  value="<?php echo isset($value)?$value->indicator_desc:''?>">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-2">Prinsip</label>
          <div class="col-md-9">
            <input type="text" name="indicator_principal" class="form-control" <?php echo ($flag=='read')?'readonly':''?>  value="<?php echo isset($value)?$value->indicator_principal:''?>">
          </div>
        </div>


        <div class="form-group row">
          <label class="col-form-label col-md-2">Is active?</label>
          <div class="col-md-2">
            <div class="kt-radio-inline">
              <label class="kt-radio">
                <input name="is_active" type="radio" value="Y" <?php echo isset($value) ? ($value->is_active == 'Y') ? 'checked="checked"' : '' : 'checked="checked"'; ?> <?php echo ($flag=='read')?'readonly':''?> /> Ya <span></span>
              </label>
              <label class="kt-radio">
                <input name="is_active" type="radio" value="N" <?php echo isset($value) ? ($value->is_active == 'N') ? 'checked="checked"' : '' : ''; ?> <?php echo ($flag=='read')?'readonly':''?>/> Tidak <span></span>
              </label>
            </div>
          </div>
        </div>

       

        <div class="kt-portlet__foot">
          <div class="kt-form__actions">
            <div class="row">
              <div class="col-2">
              </div>
              <div class="col-10">
              <a onclick="getMenu('ipkn_master_data/Mst_indicator')" href="#" class="btn btn-sm btn-success">
                <i class="ace-icon fa fa-arrow-left icon-on-right bigger-110"></i>
                Back previous
              </a>
              <?php if($flag != 'read'):?>
              <button type="reset" id="btnReset" class="btn btn-sm btn-danger">
                <i class="ace-icon fa fa-close icon-on-right bigger-110"></i>
                Reset
              </button>
              <button type="submit" id="btnSave" name="submit" class="btn btn-sm btn-info">
                <i class="ace-icon fa fa-check-square-o icon-on-right bigger-110"></i>
                Submit
              </button>
            <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </form>

    </div>
    <!-- PAGE CONTENT ENDS -->
  </div><!-- /.col -->
</div><!-- /.row -->


