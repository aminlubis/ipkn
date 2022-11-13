<script>
$(document).ready(function(){
  
    $('#form_Tmp_user').ajaxForm({
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
          $('#page-area-content').load('<?php echo base_url()?>setting/Tmp_user?_=' + (new Date()).getTime());
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
      <form class="kt-form kt-form--label-right" method="post" id="form_Tmp_user" action="<?php echo site_url('setting/Tmp_user/process')?>" enctype="multipart/form-data">
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
            <input name="fullname" id="fullname" value="<?php echo isset($value)?$value->fullname:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Email</label>
          <div class="col-md-3">
            <input name="email" id="email" value="<?php echo isset($value)?$value->email:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Username</label>
          <div class="col-md-3">
            <input name="username" id="username" value="<?php echo isset($value)?$value->username:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Password</label>
          <div class="col-md-3">
            <input name="password" id="password" value="<?php echo isset($value)?$value->password:''?>" placeholder="" class="form-control" type="password" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Password Confirmation</label>
          <div class="col-md-3">
            <input name="confirm" id="confirm" value="" placeholder="" class="form-control" type="password" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
        </div>
        <?php if($this->session->userdata('user')->flag_user == null) : ?>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Flag User</label>
          <div class="col-md-3">
            <select class="form-control" name="flag_user">
              <option value="">-Pilih-</option>
              <option value="0">Admin System</option>
              <option value="ttdi">TTDI</option>
              <option value="ipkn">IPKN</option>
            </select>
          </div>
        </div>
        <?php else :?>
          <input type="hidden" name="flag_user" value="<?php echo $this->session->userdata('user')->flag_user?>">
        <?php endif; ?>

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
              <a onclick="getMenu('setting/Tmp_user')" href="#" class="btn btn-sm btn-success">
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


