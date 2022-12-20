<script src="<?php echo base_url()?>assets/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url()?>assets/ckeditor/samples/js/sample.js"></script>

<script>
initSample();
  var editor = CKEDITOR.replace('content_description', {
    height: 400,
    removeButtons: 'PasteFromWord'
  });

  // config.stylesSet = 'custom_style';
  editor.on( 'change', function( evt ) {
  // getData() returns CKEditor's HTML content.
      document.getElementById('editorcontent_description').innerHTML = editor.getData();
  });

</script>

<script>
$(document).ready(function(){

  $('#form_cms_content_section').on('submit', function(){
        
    //put the editor's html content inside the hidden input to be sent to server
    
    pf_file = new Array();
    var formData = new FormData($('#form_cms_content_section')[0]);
    
    i=0;

    formData.append('content_description', $('#editorcontent_description').html() );
    // formData.append('document_name', pf_file);

    url = $('#form_cms_content_section').attr('action');

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
            $('#page-area-content').load('<?php echo base_url()?>cms/Cms_content_section?section='+$('#section_id').val()+'&class='+$('#class').val()+'');
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
      <form class="kt-form kt-form--label-right" method="post" id="form_cms_content_section" action="<?php echo site_url('cms/Cms_content_section/process?section='.$section.'&class='.$class.'')?>" enctype="multipart/form-data">
        <br>
        <input type="hidden" name="section_id" id="section_id" value="<?php echo $section?>">
        <input type="hidden" name="class" id="class" value="<?php echo $class?>">

        <div class="form-group row">
          <label class="col-form-label col-md-3">ID</label>
          <div class="col-md-1">
            <input name="id" id="id" value="<?php echo isset($value)?$value->content_id:0?>" placeholder="Auto" class="form-control" type="text" readonly>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Judul</label>
          <div class="col-md-6">
            <input name="content_title" id="content_title" value="<?php echo isset($value)?$value->content_title:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
        </div>
        <?php if(in_array($_GET['section'], array(1,3,5,10,16) )) : ?>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Sub Judul</label>
          <div class="col-md-6">
            <input name="content_subtitle" id="content_subtitle" value="<?php echo isset($value)?$value->content_subtitle:''?>" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
        </div>
        <?php endif; ?>
        
        <?php if(in_array($_GET['section'], array(2,3,5,9,15) )) : ?>
        <div class="form-group row">
          <label class="col-form-label col-md-3">Deskripsi</label>
          <div class="col-md-8">
          <textarea name="content_description" id="content_description" class="form-control"  <?php echo ($flag=='read')?'readonly':''?> style="height:120px !important"><?php echo isset($value)?$value->content_description:''?></textarea>
          <div id="editorcontent_description" style="display: none"><?php echo isset($value->letter_content)?$value->letter_content:''?></div>
          </div>
        </div>
        <?php endif;?>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Gambar Utama</label>
          <div class="col-md-3">
            <input name="content_cover" id="content_cover" value="" placeholder="" class="form-control" type="file" <?php echo ($flag=='read')?'readonly':''?>>
            <span class="form-text text-muted">Maximum file size 4 MB</span>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-form-label col-md-3">&nbsp;</label>
          <div class="col-md-3">
            <img src="data:image/jpeg;base64,<?php echo isset($value)?base64_encode($value->content_cover):''?>" style="max-width: 200px !important"/>
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
        
        <?php if(in_array($_GET['section'], array(2,3,9,10,15,16) )) : ?>
        <div class="kt-portlet__head">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
              File Attachment
            </h3>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-form-label col-md-3">Nama File</label>
          <div class="col-md-3">
            <input name="document_name[]" id="document_name" value="" placeholder="" class="form-control" type="text" <?php echo ($flag=='read')?'readonly':''?> >
          </div>
          <div class="col-md-3">
            <input name="file_upload[]" id="file_upload" value="" placeholder="" class="form-control" type="file" <?php echo ($flag=='read')?'readonly':''?>>
          </div>
          <div class ="col-md-1" style="margin-left:-2.5%">
            <input onClick="tambah_file()" value="+ Add" type="button" class="btn btn-sm btn-info" />
          </div>
        </div>

        <div id="input_file<?php echo $j;?>"></div>

        <div class="col-md-12">
          <?php echo $attachment?>
        </div>
        <?php endif; ?>

        <div class="kt-portlet__foot">
          <div class="kt-form__actions">
            <div class="row">
              <div class="col-2">
              </div>
              <div class="col-10">
              <a onclick="getMenu('cms/Cms_content_section?section=<?php echo $section?>&class=<?php echo $class?>')" href="#" class="btn btn-sm btn-success">
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
$('.datepicker').datepicker({
    locale: {
        format: 'YYYY-MM-DD',
    },
    orientation: "bottom left"
});
</script>


