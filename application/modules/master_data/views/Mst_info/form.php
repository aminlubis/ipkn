<script>
$(document).ready(function(){

    $('#btnSave').on('click', function(e) {
			e.preventDefault();
      
			swal.fire({
          title: "Are you sure want to continue?",
          text: "your data will be processed immediately.",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#6cb42c",
          confirmButtonText: "Yes, continue!",
          closeOnConfirm: true,
          preConfirm: function () {
            return new Promise(function (resolve, reject) {
              $('#form_Mst_info').ajaxSubmit({
                complete: function(xhr) {     
                  var data=xhr.responseText;
                  var jsonResponse = JSON.parse(data);
                  if(jsonResponse.status === 200){
                    $.achtung({message: jsonResponse.message, timeout:5});
                    resolve(jsonResponse);
                  }else{
                    $.achtung({message: jsonResponse.message, timeout:5});
                    reject("error message")
                  }
                  achtungHideLoader();
                },
              });
            })
          },
          allowOutsideClick: false
      }).then(function (response) {
          console.log(response);
          if(response.dismiss == 'cancel'){
            text = 'You cancel the process';
            return false;
          }else{
            text = 'Your data has been successfully submitted!';
            swal.fire({
              title: 'Thank you!',
              type: 'success',
              html: '<p>'+text+'</p>',
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Close!',
              allowOutsideClick: false
            }).then(function () {
              getMenu('master_data/Mst_info');
            })
          } 
      })

    });
    
    // $('#form_Mst_info').ajaxForm({
    //   beforeSend: function() {
    //     achtungShowLoader();  
    //   },
    //   uploadProgress: function(event, position, total, percentComplete) {
    //   },
    //   complete: function(xhr) {     
    //     var data=xhr.responseText;
    //     var jsonResponse = JSON.parse(data);

    //     if(jsonResponse.status === 200){
    //       $.achtung({message: jsonResponse.message, timeout:5});
    //       $('#page-area-content').load('<?php echo base_url()?>master_data/Mst_info?_=' + (new Date()).getTime());
    //       reload_notification();
    //     }else{
    //       $.achtung({message: jsonResponse.message, timeout:5});
    //     }
    //     achtungHideLoader();
    //   }
    // }); 
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
      <form class="kt-form kt-form--label-right" method="post" id="form_Mst_info" action="<?php echo site_url('master_data/Mst_info/process')?>" enctype="multipart/form-data">
        <br>

        <div class="form-group row">
          <label class="col-form-label col-md-3">ID</label>
          <div class="col-md-1">
            <input name="id" id="id" value="<?php echo isset($value)?$value->info_id:0?>" placeholder="Auto" class="form-control" type="text" readonly>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Judul</label>
          <div class="col-md-6">
            <input name="info_title" id="info_title" value="<?php echo isset($value)?$value->info_title:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label col-lg-3 col-sm-12">Tanggal s.d</label>
          <div class="col-lg-4 col-md-8 col-sm-12">
            <div class="input-daterange input-group" id="kt_datepicker_5">
              <input type="text" class="form-control" data-date-format="yyyy-mm-dd" name="info_start_date" id="info_start_date" value="<?php echo isset($value)?$value->info_start_date:''?>">
              <div class="input-group-append">
                <span class="input-group-text"><i class="la la-calendar"></i></span>
              </div>
              
              <input type="text" class="form-control" data-date-format="yyyy-mm-dd" name="info_end_date" id="info_end_date" value="<?php echo isset($value)?$value->info_end_date:''?>">
            </div>
          </div>
        </div>
        
        <div class="form-group row">
          <label class="col-form-label col-md-3">Isi Pengumuman</label>
          <div class="col-md-8">
          <!-- <div name="kt-ckeditor-1" id="kt-ckeditor-1" style="font-familiy: sans-serif; border: 1px solid #dbdbde"><?php echo isset($value)?$value->info_content:''?></div> -->
          <textarea name="info_content" class="form-control"  <?php echo ($flag=='read')?'readonly':''?> style="height:120px !important"><?php echo isset($value)?$value->info_content:''?></textarea>
          </div>
        </div>
        <!-- <div class="form-group row">
          <label class="col-form-label col-md-3">Keterangan</label>
          <div class="col-md-4">
          <textarea name="info_description" class="form-control" <?php echo ($flag=='read')?'readonly':''?> style="height:70px !important"><?php echo isset($value)?$value->info_description:''?></textarea>
          </div>
        </div> -->
        <div class="form-group row">
          <label class="col-form-label col-md-3">Attachment</label>
          <div class="col-md-3">
            <input name="info_attachment" id="info_attachment" value="<?php echo isset($value)?$value->info_attachment:''?>" placeholder="" class="form-control" type="file" <?php echo ($flag=='read')?'readonly':''?>>
            <span class="form-text text-muted">Maximum file size 4 MB</span>
          </div>
        </div>
        <?php if( isset($value->info_attachment) ) : ?>
          <div class="form-group row">
            <label class="col-form-label col-md-3">&nbsp;</label>
            <div class="col-md-4">
              Download file attachment <a href="<?php echo base_url().PATH_FILES.$value->info_attachment?>" target="_blank">Disini</a>
            </div>
          </div>
        <?php endif;?>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Is active?</label>
          <div class="col-md-2">
            <div class="kt-radio-inline">
              <label class="kt-radio">
                <input name="is_active" type="radio" value="Y" <?php echo isset($value) ? ($value->is_active == 'Y') ? 'checked="checked"' : '' : ''; ?> <?php echo ($flag=='read')?'readonly':''?> /> Ya <span></span>
              </label>
              <label class="kt-radio">
                <input name="is_active" type="radio" value="N" <?php echo isset($value) ? ($value->is_active == 'N') ? 'checked="checked"' : '' : 'checked="checked"'; ?> <?php echo ($flag=='read')?'readonly':''?>/> Tidak <span></span>
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
              <a onclick="getMenu('master_data/Mst_info')" href="#" class="btn btn-sm btn-success">
                <i class="ace-icon fa fa-arrow-left icon-on-right bigger-110"></i>
                Back previous
              </a>
              <?php if($flag != 'read'):?>
              <button type="reset" id="btnReset" class="btn btn-sm btn-danger">
                <i class="ace-icon fa fa-close icon-on-right bigger-110"></i>
                Reset
              </button>
              <button type="button" id="btnSave" name="submit" class="btn btn-sm btn-info">
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
<script src="<?php echo base_url()?>assets/plugins/custom/ckeditor/ckeditor-inline.bundle.js" type="text/javascript"></script>

<!--end::Page Vendors -->

<script>
$('#info_start_date, #info_end_date').datepicker({
    locale: {
        format: 'YYYY-MM-DD',
    },
    orientation: "bottom left"
});
</script>


