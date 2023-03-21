<script src="<?php echo base_url()?>assets/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url()?>assets/ckeditor/samples/js/sample.js"></script>

<script>
initSample();
  var editor = CKEDITOR.replace('description', {
    height: 400,
    removeButtons: 'PasteFromWord'
  });

  // config.stylesSet = 'custom_style';
  editor.on( 'change', function( evt ) {
  // getData() returns CKEditor's HTML content.
      document.getElementById('editordescription').innerHTML = editor.getData();
  });

</script>

<script>

$(document).ready(function(){

  $('#form_cms_report').on('submit', function(){
        
    //put the editor's html content inside the hidden input to be sent to server
    
    pf_file = new Array();
    var formData = new FormData($('#form_cms_report')[0]);
    
    i=0;

    formData.append('description', $('#editordescription').html() );
    // formData.append('document_name', pf_file);

    url = $('#form_cms_report').attr('action');

    // ajax adding data to database
      $.ajax({
        url : url,
        type: "POST",
        data: formData,
        dataType: "JSON",
        contentType: false,
        processData: false,
        
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
            $('#page-area-content').load('<?php echo base_url()?>cms/Cms_report_data?_=' + (new Date()).getTime());
          }else{
            $.achtung({message: jsonResponse.message, timeout:5, className:'achtungFail'});
          }
          achtungHideLoader();
        }
      });

    return false;
    
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
      <form class="kt-form kt-form--label-right" method="post" id="form_cms_report" action="<?php echo site_url('cms/Cms_report_data/process')?>" enctype="multipart/form-data">
        <br>

        <div class="form-group row">
          <label class="col-form-label col-md-3">ID</label>
          <div class="col-md-1">
            <input name="id" id="id" value="<?php echo isset($value)?$value->id:0?>" placeholder="Auto" class="form-control" type="text" readonly>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Judul</label>
          <div class="col-md-6">
            <input name="title" id="title" value="<?php echo isset($value)?$value->title:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Author</label>
          <div class="col-md-3">
            <input name="owner" id="owner" value="<?php echo isset($value)?$value->owner:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
        </div>

        <!-- <div class="form-group row">
          <label class="col-form-label col-md-3">Jumlah Viewer</label>
          <div class="col-md-3">
            <input name="count_view" id="count_view" value="<?php echo isset($value)?$value->count_view:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
        </div> -->

        <div class="form-group row">
          <label class="col-form-label col-lg-3 col-sm-12">Tanggal Publish</label>
          <div class="col-lg-4 col-md-8 col-sm-12">
            <div class="input-daterange input-group" id="kt_datepicker_5">
              <input type="text" class="form-control" data-date-format="yyyy-mm-dd" name="publish_date" id="publish_date" value="<?php echo isset($value)?$value->publish_date:''?>">
              <div class="input-group-append">
                <span class="input-group-text"><i class="la la-calendar"></i></span>
              </div>
            </div>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Kategori Data</label>
          <div class="col-md-6">
            <?php echo $this->master->custom_selection(array('table'=>'global_parameter', 'where'=>array('is_active'=>'Y', 'flag' => 'kategori_data'), 'id'=>'value', 'name' => 'label'),isset($value)?$value->report_type:'','report_type','report_type','chosen-slect form-control',($flag=='read')?'readonly':'','');?>
          </div>
        </div>
        
        <!-- <div class="form-group row">
          <label class="col-form-label col-md-3">Deskripsi</label>
          <div class="col-md-8">
          <textarea name="description" class="form-control"  <?php echo ($flag=='read')?'readonly':''?> style="height:120px !important"><?php echo isset($value)?$value->description:''?></textarea>
          </div>
        </div> -->

        <div class="form-group row">
          <label class="col-form-label col-md-3">Deskripsi</label>
          <div class="col-md-8">
          <textarea name="description" id="description" class="form-control"  <?php echo ($flag=='read')?'readonly':''?> style="height:120px !important"><?php echo isset($value)?$value->description:''?></textarea>
          <div id="editordescription" style="display: none"><?php echo isset($value->description)?$value->description:''?></div>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Image Cover</label>
          <div class="col-md-3">
            <input name="report_cover" id="report_cover" value="" placeholder="" class="form-control" type="file" <?php echo ($flag=='read')?'readonly':''?>>
          </div>
          <span class="form-text text-muted"><i>Maximum file size 4 MB & Resolusi terbaik ukuran 180px x 240px</i></span>
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">&nbsp;</label>
          <div class="col-md-3">
          <img style="max-width: 100px" src="data:image/jpeg;base64,<?php echo isset($value)?base64_encode($value->report_cover):''?>"/>
          </div>
        </div>

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

        <div class="kt-portlet__head">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
              File Attachment
            </h3>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Nama Dokumen</label>
          <div class="col-md-3">
            <input name="document_name[]" id="document_name" value="" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
          <div class="col-md-3">
            <input name="file_upload[]" id="file_upload" value="" placeholder="" class="form-control" type="file" <?php echo ($flag=='read')?'readonly':''?>>
          </div>
          <!-- <div class ="col-md-1" style="margin-left:-2.5%">
            <input onClick="tambah_file()" value="+ Add" type="button" class="btn btn-sm btn-info" />
          </div> -->
        </div>

        <div id="input_file<?php echo $j;?>"></div>

        <div class="col-md-12">
          <?php echo $attachment?>
        </div>

        <div class="kt-portlet__foot">
          <div class="kt-form__actions">
            <div class="row">
              <div class="col-2">
              </div>
              <div class="col-10">
              <a onclick="getMenu('cms/Cms_report_data')" href="#" class="btn btn-sm btn-success">
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


