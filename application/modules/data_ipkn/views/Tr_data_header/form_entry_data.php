<script>
$(document).ready(function(){
  
    $('#form_tr_entry_data').ajaxForm({
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
          $.achtung({message: jsonResponse.message, timeout:5, className:'achtungFail'});
        }
        achtungHideLoader();
      }
    }); 
})

function getScore(key){

  var current_value = $('#value_'+key+'').val();
  var indicator_id = $('#indicator_id_'+key+'').val();
  var data_id = $('#data_id_'+key+'').val();

  var post_data = {
    dh_id : $('#id').val(),
    data_id : data_id,
    year : $('#year').val(),
    indicator_id : key,
    value : current_value
  };

  // update data
  preventDefault();
  $.ajax({
    url: '<?php echo base_url()?>data_ipkn/Tr_input_dt/save_row_dt',
    type: "post",
    data: post_data,
    dataType: "json",
    beforeSend: function() {
      // achtungShowLoader();  
    },
    success: function(response) {
      // achtungHideLoader();
      console.log(response);
      $('#score_'+key+'').val(response.score);
    }
  });

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
      <form class="kt-form kt-form--label-right" method="post" id="form_tr_entry_data" action="<?php echo site_url('data_ipkn/Tr_data_header/process')?>" enctype="multipart/form-data">
        <br>

        
        <input name="id" id="id" value="<?php echo isset($value)?$value->dh_id:0?>" placeholder="Auto" class="form-control" type="hidden" readonly>
        <input name="year" id="year" value="<?php echo isset($value)?$value->dh_year:0?>" placeholder="Auto" class="form-control" type="hidden" readonly>

        <div class="form-group row">
          <div class="col-md-12">
            <a style="margin-left: 25px !important; margin-bottom: 10px" onclick="getMenu('data_ipkn/Tr_data_header')" href="#" class="btn btn-sm btn-success">
              <i class="ace-icon fa fa-arrow-left icon-on-right bigger-110"></i>
              Back previous
            </a>
            <br>
            
            <table class="table table-bordered" style="margin-left: 25px !important; width: 90%">
                <tr style="background: #cbe4ee">  
                  <th width="30px">No</th>
                  <th width="50px">Tahun</th>
                  <th>Provinsi</th>
                  <th>Deskripsi</th>
                </tr>
                <tr>
                  <td style="text-align: center">1</td>
                  <td><?php echo $value->dh_year; ?></td>
                  <td><?php echo $value->province_name; ?></td>
                  <td><?php echo $value->dh_title; ?></td>
                </tr>
            </table>
          </div>
        </div>

        <div class="kt-portlet__head">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
              Entry Nilai Indikator
            </h3>
          </div>
        </div>
        
        <?php if(count($result) > 0) :?>
          <div class="form-group row">
            <div class="col-md-12 padding-20">
              <table class="table table-bordered" style="margin-left: 25px !important; width: 90%">
                  <tr style="background: #cbe4ee">  
                    <th>No</th>
                    <th>Kode</th>
                    <th>Indikator</th>
                    <th style="text-align: center">Value</th>
                    <th style="text-align: center">Skor</th>
                  </tr>
                  <?php 
                    $no = 0; 
                    foreach ($result as $key => $row) : 
                    $no++; 
                  ?>
                  <tr>
                    <td style="text-align: center"><?php echo $no; ?></td>
                    <td><?php echo $row->indicator_code; ?></td>
                    <td><a href="#" onclick="show_modal('ipkn_master_data/Mst_indicator/show_detail/<?php echo $row->indicator_id?>', '<?php echo $row->indicator_name?>')"><?php echo $row->indicator_name; ?></a></td>
                    <td style="text-align: center">
                      <input type="hidden" class="form-control" name="indicator_id_<?php echo $row->indicator_id?>" id="indicator_id_<?php echo $row->indicator_id?>" style="text-align: right; width: 100px" value="<?php echo $row->indicator_id; ?>">

                      <input type="hidden" class="form-control" name="data_id_<?php echo $row->indicator_id?>" id="data_id_<?php echo $row->indicator_id?>" style="text-align: right; width: 100px" value="<?php echo $row->data_id; ?>">

                      <input type="text" class="form-control" name="value_<?php echo $row->indicator_id?>" id="value_<?php echo $row->indicator_id?>" style="text-align: right; width: 100px" value="<?php echo $row->value; ?>" onchange="getScore(<?php echo $row->indicator_id?>)">
                    </td>
                    <td style="text-align: center">
                      <input type="text" class="form-control" name="score_<?php echo $row->indicator_id?>" id="score_<?php echo $row->indicator_id?>" style="text-align: right; width: 100px" value="<?php echo $row->score; ?>" readonly>
                    </td>
                  </tr>
                  <?php endforeach; ?>
              </table>
            </div>
          </div>
          
        
        <?php else: ?>
        <span style="color: red">No Data Available</span>
        <?php endif; ?>

      </form>

    </div>
    <!-- PAGE CONTENT ENDS -->
  </div><!-- /.col -->
</div><!-- /.row -->


