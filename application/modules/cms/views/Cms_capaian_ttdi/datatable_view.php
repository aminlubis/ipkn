<script>
$(document).ready(function(){

    $('#form_cms_capaian_ttdi').ajaxForm({
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
          $('#page-area-content').load('<?php echo base_url()?>cms/Cms_capaian_ttdi?_=' + (new Date()).getTime());
          reload_notification();
        }else{
          $.achtung({message: jsonResponse.message, timeout:5, className:'achtungFail'});
        }
        achtungHideLoader();
      }
    }); 
    

    $('select[name="tahun"]').change(function () {
      $('#content_datatable').load('<?php echo base_url()?>cms/Cms_capaian_ttdi/load_datatable?year='+$(this).val()+'');
    });
})

</script>

<form class="kt-form kt-form--label-right" method="post" id="form_cms_capaian_ttdi" action="<?php echo site_url('cms/Cms_capaian_ttdi/process')?>" enctype="multipart/form-data">

  <div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
      <div class="kt-portlet__head-toolbar">
        <div class="kt-portlet__head-wrapper">
          <div class="kt-portlet__head-actions">
            <?php echo $this->master->get_tahun(isset($_GET['year'])?$_GET['year']:date('Y'),'tahun','tahun','form-control','','');?>
          </div>
        </div>
      </div>
    </div>
    <div class="kt-portlet__body">

      <!--begin: Datatable -->
      <table id="datatable" base-url="<?php echo base_url()?>cms/Cms_capaian_ttdi" class="table table-responsive-sm table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline">
        <thead>
          <tr class="table-bg-green">  
            <th width="30px" style="text-align: center; valign: top">No</th>
            <th width="30px" style="text-align: center; valign: top"></th>
            <th style="color: white">Nama Negara</th>
            <th style="color: white; width: 100px; text-align: center">Ranking</th>
            <th style="color: white; width: 100px; text-align: center">Skor TTDI</th>
            <?php foreach($index as $row_index) :?>
              <th style="color: white; width: 100px; text-align: center" ><?php echo $row_index->index_desc; ?></th>
              <?php endforeach; ?>
          </tr>
        </thead>
        <tbody>
          <?php 
            $no = 0;
            if($value->num_rows() > 0) :
              $no=0; foreach ($value->result() as $k => $v) : $no++;
          ?>
            <tr>
              <td align="center"><?php echo $no?></td>
              <td align="center"><input type="checkbox" name="is_active[]" <?php echo ($v->is_active == 'Y')?'checked':''?>></td>
              <td><input type="text" name="country[]" value="<?php echo $v->country_name; ?>" style="text-align: left" class="form-control"></td>
              <td align="center"><input type="text" name="rank[]" value="<?php echo $v->rank; ?>" style="text-align: center; width: 100px" class="form-control"></td>
              <td align="center"><input type="text" name="score_ttdi[]" value="<?php echo $v->score_ttdi; ?>" style="text-align: center; width: 100px" class="form-control"></td>
              <td style="color: white; width: 100px"><input type="text" name="score_index_1[]" value="<?php echo $v->index_1; ?>" class="form-control" style="text-align: center" value=""></td>
              <td style="color: white; width: 100px"><input type="text" name="score_index_2[]" value="<?php echo $v->index_2; ?>" class="form-control" style="text-align: center" value=""></td>
              <td style="color: white; width: 100px"><input type="text" name="score_index_3[]" value="<?php echo $v->index_3; ?>" class="form-control" style="text-align: center" value=""></td>
              <td style="color: white; width: 100px"><input type="text" name="score_index_4[]" value="<?php echo $v->index_4; ?>" class="form-control" style="text-align: center" value=""></td>
              <td style="color: white; width: 100px"><input type="text" name="score_index_5[]" value="<?php echo $v->index_5; ?>" class="form-control" style="text-align: center" value=""></td>
            </tr>
          <?php endforeach;?>
          <?php endif;?>
          <?php for($i=$no+1; $i<12; $i++) :?>
            <tr>
              <td align="center"><?php echo $i; ?></td>
              <td align="center"><input type="checkbox" name="is_active[]"></td>
              <td><input type="text" name="country[]" style="text-align: left" class="form-control"></td>
              <td align="center"><input type="text" name="rank[]" style="text-align: center; width: 100px" class="form-control"></td>
              <td align="center"><input type="text" name="score_ttdi[]" style="text-align: center; width: 100px" class="form-control"></td>
              <?php foreach($index as $row_index) :?>
              <td style="color: white; width: 100px"><input type="text" name="score_index_<?php echo $row_index->index_id?>[]" class="form-control" style="text-align: center"></td>
            <?php endforeach; ?>
            </tr>
          <?php endfor; ?>

        </tbody>
      </table>

      <div class="kt-portlet__foot">
        <div class="kt-form__actions">
          <div class="row">
            <div class="col-10">
            <button type="submit" id="btnSave" name="submit" class="btn btn-sm btn-info">
              <i class="ace-icon fa fa-check-circle icon-on-right bigger-110"></i>
              Submit
            </button>
            </div>
          </div>
        </div>
      </div>
    

      <!--end: Datatable -->
    </div>
  </div>

</form>