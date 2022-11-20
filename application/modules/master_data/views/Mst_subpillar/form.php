<script>
$(document).ready(function(){
  
    $('#form_Mst_subpillar').ajaxForm({
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
          $('#page-area-content').load('<?php echo base_url()?>master_data/Mst_subpillar?_=' + (new Date()).getTime());
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
      <form class="kt-form kt-form--label-right" method="post" id="form_Mst_subpillar" action="<?php echo site_url('master_data/Mst_subpillar/process')?>" enctype="multipart/form-data">
        <br>

        <div class="form-group row">
          <label class="col-form-label col-md-3">ID</label>
          <div class="col-md-1">
            <input name="id" id="id" value="<?php echo isset($value)?$value->subpillar_id:0?>" placeholder="Auto" class="form-control" type="text" readonly>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Label Tahun</label>
          <div class="col-md-2">
            <?php echo $this->master->get_tahun(isset($value)?$value->year_label:date('Y') , 'year_label', 'year_label', 'form-control', '', '') ?>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Subpillar</label>
          <div class="col-md-6">
          <textarea name="subpillar_desc" class="form-control" <?php echo ($flag=='read')?'readonly':''?> style="height:70px !important"><?php echo isset($value)?$value->subpillar_desc:''?></textarea>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Pillar TTCI</label>
          <div class="col-md-8">
            <?php echo $this->master->custom_selection($params = array('table' => 'mst_pillar', 'id' => 'pillar_id', 'name' => 'pillar_desc', 'where' => array('is_active' => 'Y') ), isset($value)?$value->pillar_id:'' , 'pillar_id', 'pillar_id', 'form-control', '', '') ?>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Kementerian/Lembaga (KL)</label>
          <div class="col-md-6">
            <?php echo $this->master->custom_selection($params = array('table' => 'mst_kl', 'id' => 'kl_id', 'name' => 'kl_name', 'where' => array('is_active' => 'Y') ), isset($value)?$value->kl_id:'' , 'kl_id', 'kl_id', 'form-control', '', '') ?>
          </div>
        </div>
        
        <div class="form-group row">
          <label class="col-form-label col-md-3">Question</label>
          <div class="col-md-6">
          <textarea name="question" class="form-control" <?php echo ($flag=='read')?'readonly':''?> style="height:70px !important"><?php echo isset($value)?$value->question:''?></textarea>
          </div>
        </div>
        
        <div class="form-group row">
          <label class="col-form-label col-md-3">Source</label>
          <div class="col-md-6">
          <textarea name="source" class="form-control" <?php echo ($flag=='read')?'readonly':''?> style="height:70px !important"><?php echo isset($value)?$value->source:''?></textarea>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Weighted</label>
          <div class="col-md-1">
            <input name="weighted" id="weighted" value="<?php echo isset($value)?$value->weighted:''?>"  class="form-control" type="text">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-lg-3 col-form-label">Min</label>
          <div class="col-lg-1">
            <input name="min_value" id="min_value" value="<?php echo isset($value)?$value->min_value:''?>"  class="form-control" type="text">
          </div>

          <label class="col-lg-1 col-form-label">Median</label>
          <div class="col-lg-1">
            <input name="med_value" id="med_value" value="<?php echo isset($value)?$value->med_value:''?>"  class="form-control" type="text">
          </div>

          <label class="col-lg-1 col-form-label">Max</label>
          <div class="col-lg-1">
            <input name="max_value" id="max_value" value="<?php echo isset($value)?$value->max_value:''?>"  class="form-control" type="text">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Data Type</label>
          <div class="col-md-3">
            <input name="type_data" id="type_data" value="<?php echo isset($value)?$value->type_data:''?>"  class="form-control" type="text">
            <span class="form-text text-muted"> E (Primary), S (Sekunder) </span>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Value Data</label>
          <div class="col-md-1">
            <input name="data_value" id="data_value" value="<?php echo isset($value)?$value->data_value:''?>"  class="form-control" type="text">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Rasio</label>
          <div class="col-md-2">
            <input name="ratio" id="ratio" value="<?php echo isset($value)?$value->ratio:''?>"  class="form-control" type="text">
          </div>
          <label class="col-lg-1 col-form-label">Satuan</label>
          <div class="col-lg-3">
            <?php echo $this->master->custom_selection($params = array('table' => 'global_parameter', 'id' => 'value', 'name' => 'label', 'where' => array('flag' => 'satuan') ), isset($value)?$value->unit_ratio:'' , 'unit_ratio', 'unit_ratio', 'form-control', '', '') ?>
          </div>

        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Note</label>
          <div class="col-md-6">
            <input name="note" id="note" value="<?php echo isset($value)?$value->note:''?>"  class="form-control" type="text">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Is exclusive?</label>
          <div class="col-md-2">
            <div class="kt-radio-inline">
              <label class="kt-radio">
                <input name="is_exclusive" type="radio" value="Y" <?php echo isset($value) ? ($value->is_exclusive == 'Y') ? 'checked="checked"' : '' : 'checked="checked"'; ?> <?php echo ($flag=='read')?'readonly':''?> /> Ya <span></span>
              </label>
              <label class="kt-radio">
                <input name="is_exclusive" type="radio" value="N" <?php echo isset($value) ? ($value->is_exclusive == 'N') ? 'checked="checked"' : '' : ''; ?> <?php echo ($flag=='read')?'readonly':''?>/> Tidak <span></span>
              </label>
            </div>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Is outlayer?</label>
          <div class="col-md-2">
            <div class="kt-radio-inline">
              <label class="kt-radio">
                <input name="is_outlayer" type="radio" value="Y" <?php echo isset($value) ? ($value->is_outlayer == 'Y') ? 'checked="checked"' : '' : 'checked="checked"'; ?> <?php echo ($flag=='read')?'readonly':''?> /> Ya <span></span>
              </label>
              <label class="kt-radio">
                <input name="is_outlayer" type="radio" value="N" <?php echo isset($value) ? ($value->is_outlayer == 'N') ? 'checked="checked"' : '' : ''; ?> <?php echo ($flag=='read')?'readonly':''?>/> Tidak <span></span>
              </label>
            </div>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Is Child?</label>
          <div class="col-md-2">
            <div class="kt-radio-inline">
              <label class="kt-radio">
                <input name="is_child" type="radio" value="Y" <?php echo isset($value) ? ($value->is_child == 'Y') ? 'checked="checked"' : '' : 'checked="checked"'; ?> <?php echo ($flag=='read')?'readonly':''?> /> Ya <span></span>
              </label>
              <label class="kt-radio">
                <input name="is_child" type="radio" value="N" <?php echo isset($value) ? ($value->is_child == 'N') ? 'checked="checked"' : '' : ''; ?> <?php echo ($flag=='read')?'readonly':''?>/> Tidak <span></span>
              </label>
            </div>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Is active?</label>
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
              <a onclick="getMenu('master_data/Mst_subpillar')" href="#" class="btn btn-sm btn-success">
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


