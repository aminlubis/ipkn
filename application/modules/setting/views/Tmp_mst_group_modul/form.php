<script>
$(document).ready(function(){
  
    $('#form_Tmp_mst_group_modul').ajaxForm({
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
          $('#page-area-content').load('<?php echo base_url()?>setting/Tmp_mst_group_modul?_=' + (new Date()).getTime());
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
      <form class="kt-form kt-form--label-right" method="post" id="form_Tmp_mst_group_modul" action="<?php echo site_url('setting/Tmp_mst_group_modul/process')?>" enctype="multipart/form-data">
        <br>

        <div class="form-group row">
          <label class="col-form-label col-md-3">ID</label>
          <div class="col-md-1">
            <input name="id" id="id" value="<?php echo isset($value)?$value->group_modul_id:0?>" placeholder="Auto" class="form-control" type="text" readonly>
          </div>
          
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Group Modul Name</label>
          <div class="col-md-3">
            <input name="group_modul_name" id="group_modul_name" value="<?php echo isset($value)?$value->group_modul_name:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Description</label>
          <div class="col-md-4">
          <textarea name="group_modul_description" class="form-control" <?php echo ($flag=='read')?'readonly':''?> style="height:50px !important"><?php echo isset($value)?$value->group_modul_description:''?></textarea>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Is active?</label>
          <div class="col-md-3">
            <div class="radio">
                  <label>
                    <input name="is_active" type="radio" class="ace" value="Y" <?php echo isset($value) ? ($value->is_active == 'Y') ? 'checked="checked"' : '' : 'checked="checked"'; ?> <?php echo ($flag=='read')?'readonly':''?> />
                    <span class="lbl"> Ya</span>
                  </label>
                  <label>
                    <input name="is_active" type="radio" class="ace" value="N" <?php echo isset($value) ? ($value->is_active == 'N') ? 'checked="checked"' : '' : ''; ?> <?php echo ($flag=='read')?'readonly':''?>/>
                    <span class="lbl">Tidak</span>
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
              <a onclick="getMenu('setting/Tmp_mst_group_modul')" href="#" class="btn btn-sm btn-success">
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


