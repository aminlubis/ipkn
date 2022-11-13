<script>
$(document).ready(function(){
  
  $('#form_Tmp_mst_menu').ajaxForm({
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
        $('#page-area-content').load('<?php echo base_url()?>setting/Tmp_mst_menu?_=' + (new Date()).getTime());
      }else{
        $.achtung({message: jsonResponse.message, timeout:5});
      }
      achtungHideLoader();
    }
  }); 

  $('select[name="modul_id"]').change(function () {
      if ($(this).val()) {
          $.getJSON("<?php echo site_url('Templates/References/getMenuByModulId') ?>/" + $(this).val(), '', function (data) {
              $('#parent option').remove();
              $('<option value="">-Silahkan Pilih-</option>').appendTo($('#parent'));
              $.each(data, function (i, o) {
                  $('<option value="' + o.menu_id + '">' + o.name + '</option>').appendTo($('#parent'));
              });

          });
      } else {
          $('#parent option').remove()
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
      <form class="kt-form kt-form--label-right" method="post" id="form_Tmp_mst_menu" action="<?php echo site_url('setting/Tmp_mst_menu/process')?>" enctype="multipart/form-data">
        <br>

        <div class="form-group row">
          <label class="col-form-label col-md-3">ID</label>
          <div class="col-md-1">
            <input name="id" id="id" value="<?php echo isset($value)?$value->menu_id:0?>" placeholder="Auto" class="form-control" type="text" readonly>
          </div>
          
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Modul</label>
          <div class="col-md-3">
            <?php echo $this->master->custom_selection(array('table'=>'tmp_mst_modul', 'where'=>array('is_active'=>'Y'), 'id'=>'modul_id', 'name' => 'name'),isset($value)?$value->modul_id:'','modul_id','modul_id','chosen-slect form-control',($flag=='read')?'readonly':'','');?>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Menu Name</label>
          <div class="col-md-3">
            <input name="name" id="name" value="<?php echo isset($value)?$value->name:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Class</label>
          <div class="col-md-3">
            <input name="class" id="class" value="<?php echo isset($value)?$value->class:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
          <label class="col-form-label col-md-1">Link</label>
          <div class="col-md-4">
            <input name="link" id="link" value="<?php echo isset($value)?$value->link:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
        </div>
        <div class="form-group row">
          
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Icon</label>
          <div class="col-md-3">
            <input name="icon" id="icon" value="<?php echo isset($value)?$value->icon:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
        </div>
        <!-- <div class="form-group row">
          <label class="col-form-label col-md-3">Date</label>
          <div class="col-md-3">
            <div class="input-group">
              <input class="form-control date-picker" name="date" id="date" type="text" data-date-format="yyyy-mm-dd" <?php echo ($flag=='read')?'readonly':''?> value="<?php echo isset($value)?$value->date:''?>"/>
              <span class="input-group-addon">
                <i class="fa fa-calendar bigger-110"></i>
              </span>
            </div>
          </div>
        </div> -->

        <div class="form-group row">
          <label class="col-form-label col-md-3">Parent Menu</label>
          <div class="col-md-3">
            <?php echo $this->master->custom_selection(array('table'=>'tmp_mst_menu', 'where'=>array('is_active'=>'Y', 'level' => 0), 'id'=>'menu_id', 'name' => 'name'),isset($value)?$value->parent:'','parent','parent','chosen-slect form-control',($flag=='read')?'readonly':'','');?>
          </div>
          <label class="col-form-label col-md-1">Level</label>
          <div class="col-md-1">
            <input name="level" id="level" value="<?php echo isset($value)?$value->level:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Counter</label>
          <div class="col-md-1">
            <input name="counter" id="counter" value="<?php echo isset($value)?$value->counter:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Description</label>
          <div class="col-md-4">
          <textarea name="description" class="form-control" <?php echo ($flag=='read')?'readonly':''?> style="height:50px !important"><?php echo isset($value)?$value->description:''?></textarea>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Set Shorcut ?</label>
          <div class="col-md-3">
            <div class="radio">
                  <label>
                    <input name="set_shortcut" type="radio" class="ace" value="Y" <?php echo isset($value) ? ($value->set_shortcut == 'Y') ? 'checked="checked"' : '' : 'checked="checked"'; ?> <?php echo ($flag=='read')?'readonly':''?> />
                    <span class="lbl"> Ya</span>
                  </label>
                  <label>
                    <input name="set_shortcut" type="radio" class="ace" value="N" <?php echo isset($value) ? ($value->set_shortcut == 'N') ? 'checked="checked"' : '' : ''; ?> <?php echo ($flag=='read')?'readonly':''?>/>
                    <span class="lbl">Tidak</span>
                  </label>
            </div>
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
              <a onclick="getMenu('setting/Tmp_mst_menu')" href="#" class="btn btn-sm btn-success">
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


