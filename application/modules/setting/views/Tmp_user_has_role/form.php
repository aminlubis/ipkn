<script>
$(document).ready(function(){
  
    $('#form_Tmp_user_has_role').ajaxForm({
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
          $('#page-area-content').load('<?php echo base_url()?>setting/Tmp_user_has_role?_=' + (new Date()).getTime());
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
      <form class="kt-form kt-form--label-right" method="post" id="form_Tmp_user_has_role" action="<?php echo site_url('setting/Tmp_user_has_role/process')?>" enctype="multipart/form-data">
        <br>

        <div class="form-group row">
          <label class="col-form-label col-md-3">ID</label>
          <div class="col-md-1">
            <input name="id" id="id" value="<?php echo isset($value)?$value->user_id:0?>" placeholder="Auto" class="form-control" type="text" readonly>
          </div>
          
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Fullname</label>
          <div class="col-md-3">
            <input name="fullname" id="fullname" value="<?php echo isset($value)?$value->fullname:''?>" placeholder="" class="form-control" type="text" readonly >
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Email</label>
          <div class="col-md-3">
            <input name="email" id="email" value="<?php echo isset($value)?$value->email:''?>" placeholder="" class="form-control" type="text" readonly >
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Username</label>
          <div class="col-md-3">
            <input name="username" id="username" value="<?php echo isset($value)?$value->username:''?>" placeholder="" class="form-control" type="text" readonly >
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3" for="role_id">User Group</label>
          <div class="col-9">
            <div class="kt-checkbox-inline">
              <?php 
                foreach($role as $row) :
                  $check_selected = $this->Tmp_user_has_role->check_selected($row->role_id, $value->user_id); 
                  $selected = ($check_selected != false)?'checked':'';
                
              ?>
              
              <label class="kt-checkbox">
                <input type="checkbox" multiple="multiple" name="user_role[]" value="<?php echo $row->role_id; ?>" <?php echo $selected; ?>> &nbsp; <?php echo $row->name; ?>
                <span></span>
              </label>

              <?php endforeach; ?>
            </div>
            <span class="form-text text-muted">Silahkan pilih salah satu atau pilih beberapa untuk multiple role </span>
          </div>
        </div>
        
        <div class="form-group row">
          <label class="col-form-label col-md-3">Kementerian/Lembaga (KL)</label>
          <div class="col-md-6">
            <?php echo $this->master->custom_selection($params = array('table' => 'mst_kl', 'id' => 'kl_id', 'name' => 'kl_name', 'where' => array() ), isset($value)?$value->kl_id:'' , 'kl_id', 'kl_id', 'form-control', '', '') ?>
          </div>
        </div>
        
        <div class="form-group row">
          <label class="col-form-label col-md-3">Provinsi</label>
          <div class="col-md-6">
            <?php echo $this->master->custom_selection($params = array('table' => 'mst_provinces', 'id' => 'id', 'name' => 'name', 'where' => array() ), isset($value)?$value->province_id:'' , 'province_id', 'province_id', 'form-control', '', '') ?>
          </div>
        </div>
        
        <div class="kt-portlet__foot">
          <div class="kt-form__actions">
            <div class="row">
              <div class="col-2">
              </div>
              <div class="col-10">
              <a onclick="getMenu('setting/Tmp_user_has_role')" href="#" class="btn btn-sm btn-success">
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


