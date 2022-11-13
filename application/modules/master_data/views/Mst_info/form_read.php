<script>
$(document).ready(function(){
  
    $('#form_Mst_info').ajaxForm({
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
          $('#page-area-content').load('<?php echo base_url()?>master_data/Mst_info?_=' + (new Date()).getTime());
          reload_notification();
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
            Form View Data
          </h3>
        </div>
      </div>

      <!--begin::Form-->
      <form class="kt-form kt-form--label-right" method="post" id="form_Mst_info" action="<?php echo site_url('master_data/Mst_info/process')?>" enctype="multipart/form-data">
        <br>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Judul</label>
          <div class="col-md-6" style="padding-top:8px;">
            <?php echo isset($value)?$value->info_title:''?>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label col-lg-3 col-sm-12">Tanggal</label>
          <div class="col-md-6" style="padding-top:8px">
            <?php echo isset($value)?$value->info_start_date:''?>
          </div>
        </div>
        
        <div class="form-group row">
          <label class="col-form-label col-md-3">Isi Pengumuman</label>
          <div class="col-md-8" style="padding-top:8px">
            <?php echo isset($value)?$value->info_content:''?>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Keterangan</label>
          <div class="col-md-6" style="padding-top:8px">
            <?php echo isset($value)?$value->info_description:''?>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Attachment</label>
          <div class="col-md-4" style="padding-top:8px">
            <?php 
              $file = isset($value)?$value->info_attachment:'0';
              if ( file_exists(PATH_FILES.$file) ) :?>
                <a href="<?php echo base_url().PATH_FILES.$file;?>" target="_blank">Download Attachment</a>
            <?php endif; ?>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Is active?</label>
          <div class="col-md-2" style="padding-top:8px">
            Status
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Last update</label>
          <div class="col-md-8" style="padding-top:8px;">
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
              <a onclick="getMenu('master_data/Mst_info')" href="#" class="btn btn-sm btn-success">
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
<!--begin::Page Vendors(used by this page) -->
<script src="<?php echo base_url()?>assets/plugins/custom/tinymce/tinymce.bundle.js" type="text/javascript"></script>

<!--end::Page Vendors -->

<!--begin::Page Scripts(used by this page) -->
<script src="<?php echo base_url()?>assets/js/pages/crud/forms/editors/tinymce.js" type="text/javascript"></script>

<script src="<?php echo base_url()?>assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js" type="text/javascript"></script>

<script>
$('#info_start_date, #info_end_date').datepicker({
    locale: {
        format: 'YYYY-MM-DD' // --------Here
    },
});
</script>


