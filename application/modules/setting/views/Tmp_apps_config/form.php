<script>
$(document).ready(function(){
  
    $('#form_Tmp_apps_config').ajaxForm({
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
          $('#page-area-content').load('<?php echo base_url()?>setting/Tmp_apps_config?_=' + (new Date()).getTime());
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
      <form class="kt-form kt-form--label-right" method="post" id="form_Tmp_apps_config" action="<?php echo site_url('setting/Tmp_apps_config/process')?>" enctype="multipart/form-data">
        <br>

        <div class="form-group row">
          <label class="col-form-label col-md-3">ID</label>
          <div class="col-md-1">
            <input name="id" id="id" value="<?php echo isset($value)?$value->id:0?>" placeholder="Auto" class="form-control" type="text" readonly>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Nama Aplikasi</label>
          <div class="col-md-3">
            <input name="app_name" id="app_name" value="<?php echo isset($value)?$value->app_name:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Judul Header Aplikasi</label>
          <div class="col-md-3">
            <input name="header_title" id="header_title" value="<?php echo isset($value)?$value->header_title:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Teks Footer</label>
          <div class="col-md-4">
            <input name="footer" id="footer" value="<?php echo isset($value)?$value->footer:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Teks Berjalan</label>
          <div class="col-md-6">
            <input name="running_text" id="running_text" value="<?php echo isset($value)?$value->running_text:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Author</label>
          <div class="col-md-3">
            <input name="author" id="author" value="<?php echo isset($value)?$value->author:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Developer Name</label>
          <div class="col-md-3">
            <input name="developer_name" id="developer_name" value="<?php echo isset($value)?$value->developer_name:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">DB Name</label>
          <div class="col-md-3">
            <input name="db_name" id="db_name" value="<?php echo isset($value)?$value->db_name:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Logo App</label>
          <div class="col-md-4">
            <input type="file" name="icon" class="form-control" id="icon">
          </div>
        </div>
        <?php if(isset($value->app_logo)) :?>
            <div class="form-group row">
              <label class="col-form-label col-md-3">&nbsp;</label>
              <div class="col-md-4">
                <img style="max-width:150px" class="editable img-responsive" alt="Logo App" id="avatar2" src="<?php echo base_url().PATH_IMG_DEFAULT.$value->app_logo?>" />
              </div>
            </div>
        <?php endif;?>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Cover Login Page</label>
          <div class="col-md-4">
            <input type="file" name="cover_login" class="form-control" id="cover_login">
          </div>
        </div>
        <?php if(isset($value->cover_login)) :?>
            <div class="form-group row">
              <label class="col-form-label col-md-3">&nbsp;</label>
              <div class="col-md-4">
                <img style="max-width:150px" class="editable img-responsive" alt="Cover Login Page" id="avatar2" src="<?php echo base_url().PATH_IMG_DEFAULT.$value->cover_login?>" />
              </div>
            </div>
        <?php endif;?>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Footer Text Form Login</label>
          <div class="col-md-4">
          <textarea name="footer_text_form_login" class="form-control" <?php echo ($flag=='read')?'readonly':''?> style="height:100px !important"><?php echo isset($value)?$value->footer_text_form_login:''?></textarea>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Icon</label>
          <div class="col-md-3">
            <input name="icon" id="icon" value="<?php echo isset($value)?$value->icon:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Nama Perusahaan</label>
          <div class="col-md-3">
            <input name="company_name" id="company_name" value="<?php echo isset($value)?$value->company_name:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
        </div>


        <div class="form-group row">
          <label class="col-form-label col-md-3">Warna Header</label>
          <div class="col-md-3">
            <select name="style_header_color" class="form-control">
              <option value="">-Silahkan Pilih-</option>
              <option value="default" <?php echo isset($value)?($value->style_header_color=='default')?'selected':'':'' ?> >Default</option>
              <option value="blue" <?php echo isset($value)?($value->style_header_color=='blue')?'selected':'':'' ?>>Biru</option>
              <option value="red" <?php echo isset($value)?($value->style_header_color=='red')?'selected':'':'' ?>>Merah</option>
              <option value="dark" <?php echo isset($value)?($value->style_header_color=='dark')?'selected':'':'' ?>>Hitam</option>
              <option value="orange" <?php echo isset($value)?($value->style_header_color=='orange')?'selected':'':'' ?>>Orange</option>
              <option value="yellow" <?php echo isset($value)?($value->style_header_color=='yellow')?'selected':'':'' ?>>Kuning</option>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Description</label>
          <div class="col-md-4">
          <textarea name="app_description" class="form-control" <?php echo ($flag=='read')?'readonly':''?> style="height:100px !important"><?php echo isset($value)?$value->app_description:''?></textarea>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Last update</label>
          <div class="col-md-8" style="padding-top:8px">
              <i class="fa fa-calendar"></i> <?php echo isset($value->updated_date)?$this->tanggal->formatDateTime($value->updated_date):isset($value)?$this->tanggal->formatDateTime($value->created_date):date('d-M-Y H:i:s')?> - 
              by : <i class="fa fa-user"></i> <?php echo isset($value->updated_by)?$value->updated_by:isset($value->created_by)?$value->created_by:$this->session->userdata('user')->username?>
          </div>
        </div>

        <div class="kt-portlet__foot">
          <div class="kt-form__actions">
            <div class="row">
              <div class="col-2">
              </div>
              <div class="col-10">
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


