<script>
$(document).ready(function(){

    $('#form_cms_section').ajaxForm({
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
          $('#page-area-content').load('<?php echo base_url()?>cms/cms_layout_section?_=' + (new Date()).getTime());
          reload_notification();
        }else{
          $.achtung({message: jsonResponse.message, timeout:5, className:'achtungFail'});
        }
        achtungHideLoader();
      }
    }); 
})

function hapus_file(a, b)

{

  if(b != 0){
    $.getJSON("<?php echo base_url('posting/delete_file') ?>/" + b, '', function(data) {
        document.getElementById("file"+a).innerHTML = "";
        greatComplate(data);
    });
  }else{
    y = a ;
    document.getElementById("file"+a).innerHTML = "";
  }

}

counterfile = <?php $j=1;echo $j.";";?>

function tambah_file()

{

  counternextfile = counterfile + 1;

  counterIdfile = counterfile + 1;

  html = "";
  html += "<div id=\"file"+counternextfile+"\">";
  html += "<div class='form-group row'>\
          <label class='col-form-label col-md-3'>Nama Dokumen</label>\
          <div class='col-md-3'>\
            <input name='document_name[]' id='document_name' class='form-control' type='text'>\
          </div>\
          <div class='col-md-3'>\
            <input name='file_upload[]' id='file_upload' class='form-control' type='file'>\
          </div>\
          <div class ='col-md-1' style='margin-left:-2.5%'>\
          <input type='button' onclick='hapus_file("+counternextfile+",0)' value='x Del ' class='btn btn-sm btn-danger'/>\
          </div>\
        </div>";
  html += "</div>";
  html += "<div id=\"input_file"+counternextfile+"\"></div>";

  document.getElementById("input_file"+counterfile).innerHTML = html;

  counterfile++;

}

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
      <form class="kt-form kt-form--label-right" method="post" id="form_cms_section" action="<?php echo site_url('cms/cms_layout_section/process')?>" enctype="multipart/form-data">
        <br>

        <div class="form-group row">
          <label class="col-form-label col-md-3">ID</label>
          <div class="col-md-1">
            <input name="id" id="id" value="<?php echo isset($value)?$value->section_id:0?>" placeholder="Auto" class="form-control" type="text" readonly>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Judul</label>
          <div class="col-md-6">
            <input name="section_title" id="section_title" value="<?php echo isset($value)?$value->section_title:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Sub Judul</label>
          <div class="col-md-6">
            <input name="section_subtitle" id="section_subtitle" value="<?php echo isset($value)?$value->section_subtitle:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
        </div>

        <!-- <div class="form-group row">
          <label class="col-form-label col-md-3">Class</label>
          <div class="col-md-3">
            <input name="section_class" id="section_class" value="<?php echo isset($value)?$value->section_class:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
        </div> -->

        <div class="form-group row">
          <label class="col-form-label col-md-3">Section Class</label>
          <div class="col-md-2">
            <?php echo $this->master->custom_selection(array('table'=>'global_parameter', 'where'=>array('is_active'=>'Y', 'flag' => 'class_layout'), 'id'=>'value', 'name' => 'label'),isset($value)?$value->section_class:'','section_class','section_class','chosen-slect form-control',($flag=='read')?'readonly':'','');?>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Page</label>
          <div class="col-md-3">
            <input name="section_view_name" id="section_view_name" value="<?php echo isset($value)?$value->section_view_name:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Tipe Layout</label>
          <div class="col-md-3">
            <input name="section_layout_type" id="section_layout_type" value="<?php echo isset($value)?$value->section_layout_type:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Urutan</label>
          <div class="col-md-3">
            <input name="section_count" id="section_count" value="<?php echo isset($value)?$value->section_count:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
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
              <a onclick="getMenu('cms/cms_layout_section')" href="#" class="btn btn-sm btn-success">
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
<script src="<?php echo base_url()?>assets/plugins/custom/ckeditor/ckeditor-inline.bundle.js" type="text/javascript"></script>

<!--end::Page Vendors -->

<script>
$('#publish_date, #info_end_date').datepicker({
    locale: {
        format: 'YYYY-MM-DD',
    },
    orientation: "bottom left"
});
</script>


