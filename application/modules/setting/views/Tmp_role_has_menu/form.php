<script>
$(document).ready(function(){
  
    $('#form_Tmp_role_has_menu').ajaxForm({
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
          $('#page-area-content').load('<?php echo base_url()?>setting/Tmp_role_has_menu?_=' + (new Date()).getTime());
        }else{
          $.achtung({message: jsonResponse.message, timeout:5});
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
      <form class="kt-form kt-form--label-right" method="post" id="form_Tmp_role_has_menu" action="<?php echo site_url('setting/Tmp_role_has_menu/process')?>" enctype="multipart/form-data">
        <br>

        <div class="form-group row">
          <label class="col-form-label col-md-3">ID</label>
          <div class="col-md-1">
            <input name="id" id="id" value="<?php echo isset($value)?$value->role_id:0?>" placeholder="Auto" class="form-control" type="text" readonly>
          </div>
          
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Level</label>
          <div class="col-md-2">
            <?php echo $this->master->custom_selection(array('table'=>'tmp_mst_level', 'where'=>array('is_active'=>'Y'), 'id'=>'level_id', 'name' => 'name'),isset($value)?$value->level_id:'','level_id','level_id','chosen-slect form-control',($flag=='read')?'readonly':'','');?>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Role Name</label>
          <div class="col-md-2">
            <input name="name" id="name" value="<?php echo isset($value)?$value->name:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Description</label>
          <div class="col-md-4">
          <textarea name="description" class="form-control" <?php echo ($flag=='read')?'readonly':''?> style="height:50px !important"><?php echo isset($value)?$value->description:''?></textarea>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">&nbsp;</label>
          <div class="col-md-9">
            <table class="table table-striped table-bordered">
                  <thead>
                    <tr style="color:black">
                      <th class="center">Nama Menu</th>
                      <?php 
                        $no = 0;
                        foreach ($function as $key => $row_function) {
                      ?>
                      <th class="center"><?php echo strtoupper($row_function->name). '<br>[ '.$row_function->code.' ]'?></th>
                      <?php $no++; }?>
                    </tr>
                  </thead>

                  <tbody>
                    <?php
                      foreach ($menus as $key2 => $row_menus) {
                    ?>
                    <tr>
                      <td>
                        <?php echo ucfirst($row_menus['name']).' <b>('.$row_menus['modul_name'].')</b> '?>
                        <input type="hidden" name="menu_id[]" value="<?php echo $row_menus['menu_id']?>">
                      </td>

                        <?php 
                        $no = 0;
                        foreach ($function as $key3 => $func_row) {
                      ?>

                      <td class="center">
                        <label class="pos-rel">
                          <?php if($row_menus['link'] != '#'){?>
                            <input type="checkbox" name="<?php echo $row_menus['menu_id']; ?>[]" value="<?php echo $func_row->code?>" class="ace" <?php echo $this->Tmp_role_has_menu->get_checked_form($row_menus['menu_id'], $value->role_id, $func_row->code)?>/>
                            <span class="lbl"></span>
                          <?php }?>
                        </label>
                      </td>

                      <?php $no++; }?>

                    </tr>
                    <?php foreach ($row_menus['submenu'] as $rowsubmenu) {?>
                        <tr>
                        <td>&nbsp;&nbsp;&nbsp;<i class="fa fa-circle-o"></i> <?php echo ucfirst($rowsubmenu['name'])?>
                        <input type="hidden" name="menu_id[]" value="<?php echo $rowsubmenu['menu_id']?>">
                        </td>

                          <?php 
                          $no = 0;
                          foreach ($function as $key3 => $func_row) {
                        ?>

                        <td class="center">
                          <label class="pos-rel">
                            <input type="checkbox" name="<?php echo $rowsubmenu['menu_id']; ?>[]" value="<?php echo $func_row->code?>" class="ace" <?php echo $this->Tmp_role_has_menu->get_checked_form($rowsubmenu['menu_id'], $value->role_id, $func_row->code)?>/>
                            <span class="lbl"></span>
                          </label>
                        </td>

                        <?php $no++; }?>

                      </tr>

                      <?php }?>
                    
                    <?php }?>
                </tbody>
            </table>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Is active?</label>
          <div class="col-md-2">
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
              <a onclick="getMenu('setting/Tmp_role_has_menu')" href="#" class="btn btn-sm btn-success">
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


