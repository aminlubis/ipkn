<script>
$(document).ready(function(){
  
    $('#form_Tr_input_dt').ajaxForm({
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
          $('#page-area-content').load('<?php echo base_url()?>data/Tr_input_dt?dh_id=<?php echo isset($dt_header)?$dt_header->dh_id:0?>');
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
    <form class="kt-form kt-form--label-right" method="post" id="form_Tr_input_dt" action="<?php echo site_url('data/Tr_input_dt/process')?>" enctype="multipart/form-data">
    
      <div class="kt-portlet ">
        <div class="kt-portlet__head">
          <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
            <a onclick="getMenu('data/Tr_data_header')" href="#" class="btn btn-sm btn-success">
                <i class="ace-icon fa fa-arrow-left icon-on-right bigger-110"></i>
                Back previous
              </a> Travel & Tourism Competitiveness Index
            </h3>
          </div>
        </div>
        <div class="kt-portlet__body">

          <!--begin::Accordion-->
          <div class="accordion accordion-light  accordion-toggle-arrow" id="accordionExample2">
            <?php $no_pillar = 0; foreach($pillar as $key=>$subpillar ) : $no_pillar++; ?>
            <div class="card">
              <div class="card-header" id="heading<?php echo $no_pillar?>" style="background-color: #0b274f2e;padding: 0px 14px">
                <div class="card-title" data-toggle="collapse" data-target="#CollapseAccordion<?php echo $no_pillar?>" aria-expanded="false" aria-controls="CollapseAccordion<?php echo $no_pillar?>">
                  <span style="color: black"><?php echo $no_pillar.'. '.$key?></span>
                </div>
              </div>
              <div id="CollapseAccordion<?php echo $no_pillar?>" class="collapse <?php echo ($no_pillar==1)?'show':''?>" aria-labelledby="heading<?php echo $no_pillar?>" data-parent="#accordionExample2" style="">
                <div class="card-body">
                  <?php $no=0; foreach($subpillar as $row_subpillar) :$no++; ?>
                    <div class="kt-portlet">
                      <!-- <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                          <h3 class="kt-portlet__head-title">
                          <?php echo $no.'. '.$row_subpillar->subpillar_desc; ?>
                          </h3>
                        </div>
                      </div> -->

                      <!--begin::Form-->
                      <form class="kt-form kt-form--label-right">
                        <div class="kt-portlet__body">
                        <div class="form-group row">
                            <div class="col-lg-12">
                              <span class="form-text text-muted" style="font-size: 16px; font-weight: 540; color: #0b274f !important;"><?php echo $no.'. '.$row_subpillar->subpillar_desc; ?></span>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-lg-6">
                              <label style="font-weight: bold">Question :</label>
                              <span class="form-text text-muted" style="font-size: 13px; font-weight: 300"><?php echo $row_subpillar->question; ?></span>
                            </div>
                            <div class="col-lg-6">
                              <label style="font-weight: bold">Source :</label>
                              <span class="form-text text-muted" style="font-size: 13px; font-weight: 300"><?php echo $row_subpillar->source; ?></span>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-lg-3">
                              <label style="font-weight: bold">Last Value:</label>
                              <div class="kt-input-icon">
                                <input type="text" class="form-control" value="<?php echo $row_subpillar->data_value; ?>" readonly>
                              </div>
                              <span class="form-text text-muted">Value data last year</span>
                            </div>
                            <div class="col-lg-3">
                              <label class="">Current Value :</label>
                              <div class="kt-input-icon">
                                <input type="text" class="form-control" value="0">
                                <span class="kt-input-icon__icon kt-input-icon__icon--right"><span></span></span>
                              </div>
                              <span class="form-text text-muted">Please enter value data current</span>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-lg-12">
                              <label style="font-weight: bold">Data Type:</label>
                              <div class="kt-radio-inline">
                                <label class="kt-radio kt-radio--solid">
                                  <input type="radio" name="type_data" checked="" value="1"> Temporary
                                  <span></span>
                                </label>
                                <label class="kt-radio kt-radio--solid">
                                  <input type="radio" name="type_data" value="2"> National Publication
                                  <span></span>
                                </label>
                                <label class="kt-radio kt-radio--solid">
                                  <input type="radio" name="type_data" value="3"> International Publication
                                  <span></span>
                                </label>
                              </div>
                              <span class="form-text text-muted">Please select data type</span>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="col-lg-6">
                              <label style="font-weight: bold">Upload File :</label>
                              <input type="file" class="form-control">
                            </div>
                          </div>

                          <div class="form-group row">
                            <div class="col-lg-6">
                              <label style="font-weight: bold">Link URL :</label>
                              <input type="text" class="form-control">
                            </div>
                          </div>

                        </div>
                        <div class="kt-portlet__foot">
                          <div class="kt-form__actions">
                            <div class="row">
                              <div class="col-lg-6">
                                <button type="reset" class="btn btn-primary">Previous</button>
                                <button type="reset" class="btn btn-warning">Next</button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>

                      <!--end::Form-->
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
            
          </div>

          <!--end::Accordion-->
        </div>
      </div>
    
    </form>
    <!-- PAGE CONTENT ENDS -->
  </div><!-- /.col -->
</div><!-- /.row -->


