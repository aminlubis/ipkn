<script>
$(document).ready(function(){
  
    $('#form_Tr_data_header').ajaxForm({
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
          $('#page-area-content').load('<?php echo base_url()?>data_ipkn/Tr_data_header?_=' + (new Date()).getTime());
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
      <form class="kt-form kt-form--label-right" method="post" id="form_Tr_data_header" action="<?php echo site_url('data_ipkn/Tr_data_header/process')?>" enctype="multipart/form-data">
        <br>

        <div class="form-group row">
          <label class="col-form-label col-md-3">ID</label>
          <div class="col-md-1">
            <input name="id" id="id" value="<?php echo isset($value)?$value->dh_id:0?>" placeholder="Auto" class="form-control" type="text" readonly>
          </div>
          
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Proyeksi Tahun</label>
          <div class="col-md-2">
            <?php echo $this->master->get_tahun(isset($value)?$value->dh_year:date('Y') , 'dh_year', 'dh_year', 'form-control', '', '') ?>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Kementerian/Lembaga (KL)</label>
          <div class="col-md-6">
            <?php echo $this->master->custom_selection($params = array('table' => 'mst_kl', 'id' => 'kl_id', 'name' => 'kl_name', 'where' => ($this->session->userdata('user')->role != 1) ? array('kl_id' => $this->session->userdata('user')->kl_id ,'is_active' => 'Y') : array('is_active' => 'Y') ), isset($value) ? $value->kl_id : $this->session->userdata('user')->kl_id , 'kl_id', 'kl_id', 'form-control', '', '') ?>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Judul Proyek</label>
          <div class="col-md-6">
            <input name="dh_title" id="dh_title" value="<?php echo isset($value)?$value->dh_title:''?>"  class="form-control" type="text">
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Keterangan</label>
          <div class="col-md-6">
          <textarea name="dh_description" class="form-control" <?php echo ($flag=='read')?'readonly':''?> style="height:70px !important"><?php echo isset($value)?$value->dh_description:''?></textarea>
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
              <a onclick="getMenu('data_ipkn/Tr_data_header')" href="#" class="btn btn-sm btn-success">
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


