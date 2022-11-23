<!--begin::Page Custom Styles(used by this page) -->
<link href="<?php echo base_url()?>assets/css/pages/wizard/wizard-2.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url()?>assets/css/pages/wizard/wizard-3.css" rel="stylesheet" type="text/css" />

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
    
    <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
      <div class="kt-portlet">
        <div class="kt-portlet__head">
          <div class="kt-portlet__head-label">
            <a onclick="getMenu('data/Tr_data_header')" href="#" class="btn btn-sm btn-success">
              <i class="ace-icon fa fa-arrow-left icon-on-right bigger-110"></i>
              Back previous
            </a>
          </div>
        </div>

        <div class="kt-portlet__body">
          <table class="table" style="padding: 10px">
            <tr style="background: #646c9a; color: white;">
                <th><?php echo ucwords($dh_dt->dh_title); ?></th>
                <th style="text-align: right">Year (<?php echo ucwords($dh_dt->dh_year); ?> )</th>
            </tr>
              <tbody>
                  <tr>
                      <td>K/L</td>
                      <td style="text-align: right"><?php echo ucwords($dh_dt->kl_name); ?></td>
                  </tr>
                  <tr>
                      <td>Total Subpillar</td>
                      <td style="text-align: right"><?php echo $total_sekunder; ?> Components Secondary Data</td>
                  </tr>
                  <tr>
                      <td>Last Score</td>
                      <td style="text-align: right; font-weight: bold"><?php echo $overall_score_last_year;?></td>
                  </tr>
                  <tr>
                      <td>Progress</td>
                      <td style="text-align: right;"> <span style="font-weight: bold; color: <?php echo $class_progress['color'];?>"><?php echo $progress;?> %  </span>, score <span style="font-weight: bold"> <?php echo $overall_score;?> <?php echo $sign?> </span> </td>
                  </tr>
                  
              </tbody>
          </table>
        </div>
        
        <span style="font-size: 18px; padding-left: 16px">
          Index Component
        </span>
        <div class="kt-portlet__body kt-portlet__body--fit">

            <!-- NEW FORM WIZARD -->
            <div class="kt-grid  kt-wizard-v2 kt-wizard-v2--white" id="kt_wizard_v2" data-ktwizard-state="step-first">
                <div class="kt-grid__item kt-wizard-v2__aside">

                    <!--begin: Form Wizard Nav -->
                    <div class="kt-wizard-v2__nav">

                        <!--doc: Remove "kt-wizard-v2__nav-items--clickable" class and also set 'clickableSteps: false' in the JS init to disable manually clicking step titles -->
                        <div class="kt-wizard-v2__nav-items kt-wizard-v2__nav-items--clickable">

                            <?php $no_pillar = 0; foreach($pillar as $key=>$subpillar ) : $no_pillar++; ?>
                                <?php if($no_pillar == 1) :?>
                                    <div class="kt-wizard-v2__nav-item" data-ktwizard-type="step" data-ktwizard-state="current">
                                        <div class="kt-wizard-v2__nav-body">
                                            <div class="kt-wizard-v2__nav-icon">
                                                <span><?php echo $no_pillar; ?></span>
                                            </div>
                                            <div class="kt-wizard-v2__nav-label">
                                                <div class="kt-wizard-v2__nav-label-title">
                                                    <?php echo $key?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="kt-wizard-v2__nav-item" data-ktwizard-type="step">
                                        <div class="kt-wizard-v2__nav-body">
                                            <div class="kt-wizard-v2__nav-icon">
                                                <span><?php echo $no_pillar; ?></span>
                                            </div>
                                            <div class="kt-wizard-v2__nav-label">
                                                <div class="kt-wizard-v2__nav-label-title">
                                                    <?php echo $key?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif;?>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!--end: Form Wizard Nav -->
                </div>
                <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v2__wrapper">

                    <!--begin: Form Wizard Form-->
                    <form class="kt-form" id="kt_form" method="post" action="<?php echo site_url('data/Tr_input_dt/process')?>" enctype="multipart/form-data">
                        <!-- hidden form -->
                        <input type="hidden" name="dh_id" value="<?php echo $dh_id?>">
                        <input type="hidden" name="dh_year" value="<?php echo $dh_dt->dh_year?>">
                        <input type="hidden" name="kl_id" value="<?php echo $dh_dt->kl_id?>">
                        <?php
                        $no_pillar = 0;
                        foreach($pillar as $key=>$subpillar ) :
                            $no_pillar++;
                            ?>
                            <!--begin: Form Wizard Step 1-->
                            <div class="kt-wizard-v2__content" data-ktwizard-type="step-content" data-ktwizard-state="current">
                                <div class="kt-form__section kt-form__section--first">
                                    <div class="kt-wizard-v2__form">
                                        <?php
                                        $no=0;
                                        foreach($subpillar as $row_subpillar) :
                                            $no++;
                                            $last_data_inputed = isset($last_data[$row_subpillar->pillar_id][$row_subpillar->subpillar_id])?$last_data[$row_subpillar->pillar_id][$row_subpillar->subpillar_id]:array();
                                            $txt_label = ($row_subpillar->type_data=='E')?'Question':'Description';
                                            ?>
                                            <div class="kt-portlet">
                                                <!-- <div class="kt-portlet__head">
                                                        <div class="kt-portlet__head-label">
                                                          <h3 class="kt-portlet__head-title">
                                                          <?php echo $no.'. '.$row_subpillar->subpillar_desc; ?>
                                                          </h3>
                                                        </div>
                                                      </div> -->
                                                <!-- hidden form -->
                                                <input type="hidden" name="rasio[<?php echo $row_subpillar->subpillar_id?>]" id="rasio<?php echo $row_subpillar->subpillar_id?>" value="<?php echo $row_subpillar->ratio?>" class="rasio">

                                                <input type="hidden" name="pillar_id[<?php echo $row_subpillar->subpillar_id?>]" id="pillar_id_<?php echo $row_subpillar->subpillar_id?>" value="<?php echo $row_subpillar->pillar_id?>" class="pillar_id">

                                                <input type="hidden" name="subpillar_id[]" id="subpillar_id_<?php echo $row_subpillar->subpillar_id?>" value="<?php echo $row_subpillar->subpillar_id?>" class="subpillar_id">

                                                <input name="data_type[<?php echo $row_subpillar->subpillar_id?>]" id="data_type_<?php echo $row_subpillar->subpillar_id?>" type="hidden" value="<?php echo $row_subpillar->type_data; ?>">

                                                <input name="filename[<?php echo $row_subpillar->subpillar_id?>]" id="filename_<?php echo $row_subpillar->subpillar_id?>" type="hidden" value="<?php echo isset($last_data_inputed[0]->attachment) ? $last_data_inputed[0]->attachment : '-'; ?>">
                                                <!-- end hidden form -->
                                                <!--begin::Form-->
                                                <div class="kt-portlet__body">
                                                    <div class="form-group row mb-4">
                                                        <div class="col-lg-12">
                                                            <span class="form-text text-muted" style="font-size: 16px; font-weight: 540; color: #0b274f !important;"><?php echo $no.'. '.$row_subpillar->subpillar_desc; ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb-4">
                                                        <div class="col-lg-6">
                                                            <label style="font-weight: bold"><?php echo $txt_label; ?> :</label>
                                                            <span class="form-text text-muted" style="font-size: 13px; font-weight: 300"><?php echo ($row_subpillar->question)?$row_subpillar->question.'&nbsp; <span>'.$row_subpillar->note.'</span>':'-'; ?></span>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label style="font-weight: bold">Source :</label>
                                                            <span class="form-text text-muted" style="font-size: 13px; font-weight: 300"><?php echo ($row_subpillar->source)?$row_subpillar->source:'-'; ?></span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row mb-4">
                                                        <div class="col-lg-12">
                                                          <?php
                                                              $rasio = ($row_subpillar->ratio > 0) ? $row_subpillar->ratio : 1;
                                                              $data_inputed = isset($last_data_inputed[0]->current_value) ? $last_data_inputed[0]->current_value : 0;
                                                              $kali_rasio = ($data_inputed != 0) ? $data_inputed * $rasio : $data_inputed;
                                                            ?>
                                                            <span class="form-text text-muted" style="font-size: 13px; font-weight: 300">Statistic : Min <?php echo ($row_subpillar->min_value)?number_format($row_subpillar->min_value, 2):0; ?>, Max <?php echo ($row_subpillar->max_value)?number_format($row_subpillar->max_value, 2):0; ?>, Median <?php echo ($row_subpillar->med_value)?number_format($row_subpillar->med_value, 2):0; ?> |
                                                            | Ratio : <?php echo ($row_subpillar->ratio)?number_format($row_subpillar->ratio, 2):0; ?> | 
                                                             Data type <?php echo($row_subpillar->type_data=='S')?'<span class="kt-badge kt-badge--primary  kt-badge--inline kt-badge--pill">Secondary Data</span>':'<span class="kt-badge kt-badge--success  kt-badge--inline kt-badge--pill">Primary Data</span>'?> </span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row mb-4">
                                                        <div class="col-lg-6">
                                                            <label style="font-weight: bold">Last Value:</label>
                                                            <div class="kt-input-icon">
                                                                <input type="text" class="form-control" value="<?php echo $row_subpillar->data_value; ?>" name="last_value[<?php echo $row_subpillar->subpillar_id?>]" id="last_value_<?php echo $row_subpillar->subpillar_id?>">
                                                            </div>
                                                            <span class="form-text text-muted">Value data last year</span>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label class="">Current Value :</label>
                                                            <div class="kt-input-icon">
                                                                <!-- jika ada rasio maka dikalikan rasio -->
                                                                <?php
                                                                  $rasio = ($row_subpillar->ratio > 0) ? $row_subpillar->ratio : 1;
                                                                  $data_inputed = isset($last_data_inputed[0]->current_value) ? $last_data_inputed[0]->current_value : 0;
                                                                  $kali_rasio = ($data_inputed != 0) ? $data_inputed * $rasio : $data_inputed;
                                                                ?>
                                                                <input type="text" class="form-control" value="<?php echo $kali_rasio; ?>" name="current_value[<?php echo $row_subpillar->subpillar_id?>]" id="current_value_<?php echo $row_subpillar->subpillar_id?>" onchange="getScore(<?php echo $row_subpillar->subpillar_id?>)" <?php echo ($row_subpillar->type_data=='E')?'disabled':''?>>
                                                                <span class="kt-input-icon__icon kt-input-icon__icon--right"><span></span></span>
                                                            </div>
                                                            <span class="form-text text-muted">Use separator (<b>.</b>) for decimal format</span>
                                                        </div>

                                                    </div>

                                                    <div class="form-group row">

                                                        <div class="col-lg-6">
                                                            <label>Data Year:</label>
                                                            <?php echo $this->master->get_tahun(isset($last_data_inputed[0]->data_year) ? $last_data_inputed[0]->data_year : $dh_dt->dh_year , 'data_year['.$row_subpillar->subpillar_id.']"', 'data_year['.$row_subpillar->subpillar_id.']"', 'form-control', '', '') ?>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <?php if($row_subpillar->type_data == 'S') :?>
                                                                <label class="">&nbsp;</label>
                                                                <div class="kt-input-icon" style="font-size: 14px; margin-top: 9px; color: red">
                                                                    <span id="text_score_message_<?php echo $row_subpillar->subpillar_id?>">
                                                                      <span>
                                                                        <i class="fa fa-exclamation-triangle bigger-150"></i> Please enter your current value
                                                                      </span>
                                                                    </span>
                                                                </div>
                                                            <?php endif;?>
                                                            <?php if($row_subpillar->type_data == 'E') :?>
                                                                <div class="alert alert-secondary" role="alert">
                                                                    <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
                                                                    <div class="alert-text">
                                                                        <b>Primary Data</b> is not allowed to be filled in
                                                                    </div>
                                                                </div>
                                                            <?php endif;?>

                                                        </div>

                                                    </div>

                                                    <div class="form-group row mb-4">
                                                        <div class="col-lg-12">
                                                            <label style="font-weight: bold">Data Type:</label>
                                                            <div class="kt-radio-inline">
                                                                <label class="kt-radio kt-radio--solid">
                                                                    <?php 
                                                                      $dt_type = isset($last_data_inputed[0]->data_type) ? $last_data_inputed[0]->data_type : '';

                                                                      $disabled_draft = (in_array($dt_type, array('national','international') )) ? 'disabled':'';
                                                                      
                                                                    ?>
                                                                    <input type="radio" name="type_data[<?php echo $row_subpillar->subpillar_id?>]" id="type_data_<?php echo $row_subpillar->subpillar_id?>" <?php echo isset($last_data_inputed[0]->data_type) ? ($last_data_inputed[0]->data_type == 'draft') ? 'checked' : 'checked' : 'checked'; ?>  value="draft" onclick="changeDataType(<?php echo $row_subpillar->subpillar_id?>)" <?php echo $disabled_draft; ?> > Draft
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-radio kt-radio--solid">
                                                                    <input type="radio" name="type_data[<?php echo $row_subpillar->subpillar_id?>]" <?php echo isset($last_data_inputed[0]->data_type) ? ($last_data_inputed[0]->data_type == 'national') ? 'checked' : '' : 0; ?> value="national" onclick="changeDataType(<?php echo $row_subpillar->subpillar_id?>)"> National Publication
                                                                    <span></span>
                                                                </label>
                                                                <label class="kt-radio kt-radio--solid">
                                                                    <input type="radio" name="type_data[<?php echo $row_subpillar->subpillar_id?>]" <?php echo isset($last_data_inputed[0]->data_type) ? ($last_data_inputed[0]->data_type == 'international') ? 'checked' : '' : 0; ?> value="international" onclick="changeDataType(<?php echo $row_subpillar->subpillar_id?>)"> International Publication
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                            <span class="form-text text-muted">Please select data type</span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row mb-4" id="form_upload_<?php echo $row_subpillar->subpillar_id?>" <?php echo isset($last_data_inputed[0]->data_type) ? ($last_data_inputed[0]->data_type == 'draft') ? '' : 'style="display: none"' : ''; ?>>
                                                        <div class="col-lg-6">
                                                            <label style="font-weight: bold">Upload File :</label>
                                                            <div class="col-sm-12">
                                                                <div class="dropzone dropzone-default dropzone-success" id="kt_dropzone_<?php echo $row_subpillar->subpillar_id?>">
                                                                    <div class="dropzone-msg dz-message needsclick">
                                                                        <h3 class="dropzone-msg-title">Drop files or click to upload.</h3>
                                                                        <span class="dropzone-msg-desc">Only pdf files and max file 1MB</span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- <input type="file" class="form-control" name="attachment_<?php echo $row_subpillar->subpillar_id?>"> -->
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <label style="font-weight: bold">Attachment :</label>
                                                            <span><?php $files = isset($last_data_inputed[0]->attachment) ? $last_data_inputed[0]->attachment : '-'; echo '<a href="'.base_url().'uploaded/files/'.$files.'" target="_blank">'.$files.'</a>'; ?></span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row mb-4" id="form_link_<?php echo $row_subpillar->subpillar_id?>" <?php echo isset($last_data_inputed[0]->data_type) ? ($last_data_inputed[0]->data_type != 'draft') ? '' : 'style="display: none"' : 'style="display: none"'; ?> >
                                                        <div class="col-lg-6">
                                                            <label style="font-weight: bold">Link URL :</label>
                                                            <input type="text" class="form-control" name="link_url[<?php echo $row_subpillar->subpillar_id?>]" value="<?php echo isset($last_data_inputed[0]->data_type) ? $last_data_inputed[0]->link_url : ''; ?>">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group row mb-4">
                                                        <div class="col-lg-12">
                                                            <label class="">Note : </label>
                                                            <div class="kt-input-icon">
                                                                <textarea type="text" class="form-control" name="note[<?php echo $row_subpillar->subpillar_id?>]" id="note_<?php echo $row_subpillar->subpillar_id?>" style="width: 100% !important; height: 100px !important" ><?php echo isset($last_data_inputed[0]->footnote) ? $last_data_inputed[0]->footnote : ''; ?></textarea>
                                                                <span class="kt-input-icon__icon kt-input-icon__icon--right"><span></span></span>
                                                            </div>
                                                            <!-- <span class="form-text text-muted">Use separator (<b>.</b>) for decimal format</span> -->
                                                        </div>

                                                    </div>

                                                </div>

                                                <!--end::Form-->
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <!--end: Form Wizard Step 1-->

                        <!--begin: Form Actions -->
                        <div class="kt-form__actions">
                            <button class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev">
                                Previous
                            </button>
                            <button class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit">
                                Submit
                            </button>
                            <button class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next">
                                Next Pillar
                            </button>
                        </div>

                        <!--end: Form Actions -->
                    </form>

                    <!--end: Form Wizard Form-->
                </div>
            </div>
            <!-- END NEW FORM WIZARD -->
        </div>
      </div>
    </div>
    
    <!-- PAGE CONTENT ENDS -->
  </div><!-- /.col -->
</div><!-- /.row -->

<!--begin::Page Scripts(used by this page) -->
<script>

// Class definition
var KTWizard3 = function () {
	// Base elements
	var wizardEl;
	var formEl;
	var validator;
	var wizard;

	// Private functions
	var initWizard = function () {
		// Initialize form wizard
		wizard = new KTWizard('kt_wizard_v2', {
			startStep: 1, // initial active step number
			clickableSteps: true  // allow step clicking
		});

		// Validation before going to next page
		wizard.on('beforeNext', function(wizardObj) {
			if (validator.form() !== true) {
				wizardObj.stop();  // don't go to the next step
			}
		});

		wizard.on('beforePrev', function(wizardObj) {
			if (validator.form() !== true) {
				wizardObj.stop();  // don't go to the next step
			}
		});

		// Change event
		wizard.on('change', function(wizard) {
      KTUtil.scrollTop();
      var formData = $('#kt_form').serialize(); // Gets the data from the form fields
      $.post($('#kt_form').attr('action'), formData)
		});
	}

	var initValidation = function() {
		validator = formEl.validate({
			// Validate only visible fields
			ignore: ":hidden",

			// Validation rules
      rules: {
				//= Step 1
				address1: {
					required: true
				},
				postcode: {
					required: true
				},
				city: {
					required: true
				},
				state: {
					required: true
				},
				country: {
					required: true
				},

				//= Step 2
				package: {
					required: true
				},
				weight: {
					required: true
				},
				width: {
					required: true
				},
				height: {
					required: true
				},
				length: {
					required: true
				},

				//= Step 3
				delivery: {
					required: true
				},
				packaging: {
					required: true
				},
				preferreddelivery: {
					required: true
				},

				//= Step 4
				locaddress1: {
					required: true
				},
				locpostcode: {
					required: true
				},
				loccity: {
					required: true
				},
				locstate: {
					required: true
				},
				loccountry: {
					required: true
				},
			},

			// Display error
			invalidHandler: function(event, validator) {
				KTUtil.scrollTop();

				swal.fire({
					"title": "",
					"text": "There are some errors in your submission. Please correct them.",
					"type": "error",
					"confirmButtonClass": "btn btn-secondary"
				});
			},

			// Submit valid form
			submitHandler: function (form) {
        
			}
		});
	}

  var formData = new FormData($('#kt_form')[0]);
  jQuery('.subpillar_id').each(function() {
    var currentElement = $(this);
    var value = currentElement.val(); 
    formData.append('filename['+value+']', $('#filename_'+value+'').val());
  });

	var initSubmit = function() {
		var btn = formEl.find('[data-ktwizard-type="action-submit"]');

		btn.on('click', function(e) {
			e.preventDefault();
      
			if (validator.form()) {
        
        KTApp.progress(btn);

        swal.fire({
          title: "Are you sure want to finishing input Data TTCI?",
          text: "your data will be processed immediately.",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#6cb42c",
          confirmButtonText: "Yes, continue!",
          closeOnConfirm: true,
          preConfirm: function () {
            return new Promise(function (resolve, reject) {
              formEl.ajaxSubmit({
                complete: function(xhr) {     
                  var data=xhr.responseText;
                  var jsonResponse = JSON.parse(data);
                  if(jsonResponse.status === 200){
                    $.achtung({message: jsonResponse.message, timeout:5});
                    resolve(jsonResponse);
                    // getMenu('data/Tr_data_header');
                    // swal.fire({
                    //   "title": "",
                    //   "text": "The application has been successfully submitted!",
                    //   "type": "success",
                    //   "confirmButtonClass": "btn btn-secondary"
                    // });
                  }else{
                    $.achtung({message: jsonResponse.message, timeout:5});
                    reject("error message")
                    // swal.fire({
                    //   "title": "",
                    //   "text": "There are some errors in your submission. Please correct them.",
                    //   "type": "error",
                    //   "confirmButtonClass": "btn btn-secondary"
                    // });
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
              KTApp.unprogress(btn);
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
                getMenu('data/Tr_data_header');
              })
            }
            

        })

			}
		});
	}

	return {
		// public functions
		init: function() {
			wizardEl = KTUtil.get('kt_wizard_v2');
			formEl = $('#kt_form');

			initWizard();
			initValidation();
			initSubmit();
		}
	};
}();

jQuery(document).ready(function() {
	KTWizard3.init();
});

$('input:radio[name="myRadios"]').change(function() {
    if ($(this).val() == '1') {
        alert("You selected the first option and deselected the second one");
    } else {
        alert("You selected the second option and deselected the first one");
    }
});

function getScore(key){
  var last_value = $('#last_value_'+key+'').val();
  var current_value = $('#current_value_'+key+'').val();
  var score = current_value - last_value;
  if(last_value > current_value){
    text_message = '<span style="color: red"> <i class="fa fa-exclamation-triangle bigger-150"></i> value has decreased '+score.toFixed(2)+'</span>';
  }else if(last_value == current_value){
    text_message = '<span style="color: red"> <i class="fa fa-exclamation-triangle bigger-150"></i>value is not increasing</span>';
  }else{
    text_message = '<span style="color: green"> <i class="fa fa-check-circle"></i> value has increased '+score.toFixed(2)+'</span> ';
  }
  $('#text_score_message_'+key+'').html(text_message);

  // save data row
  
  $.ajax({
    url: '<?php echo base_url()?>data/Tr_input_dt/save_row_dt',
    type: "post",
    data: $('#form_search').serialize(),
    dataType: "json",
    beforeSend: function() {
      achtungShowLoader();  
    },
    success: function(data) {
      achtungHideLoader();
      find_data_reload(data,base_url);
    }
  });
  

}

function changeDataType(key){
  var value_dt = $('input[name="type_data['+key+']"]:checked').val();
  if(value_dt == 'draft'){
    $('#form_upload_'+key+'').show();
    $('#form_link_'+key+'').hide();
  }else{
    if(confirm('if you select this data, then you cannot change back to draft')){
      $('#form_upload_'+key+'').hide();
      $('#form_link_'+key+'').show();
    }
    
  }

}

jQuery('.subpillar_id').each(function() {
    var currentElement = $(this);
    var value = currentElement.val(); 
    $('#kt_dropzone_'+value+'').dropzone({
      url: "<?php echo base_url()?>Templates/Attachment/upload_attachment", // Set the url for your upload script location
      paramName: "file", // The name that will be used to transfer the file
      maxFiles: 1,
      maxFilesize: 1, // MB
      addRemoveLinks: true,
      acceptedFiles: "application/pdf",
      init: function() {
          this.on("success", function(file, response) {
              var obj = jQuery.parseJSON(response);
              console.log(obj.filename);
              console.log(value);
              $('#filename_'+value+'').val(obj.filename);
          })
      }
  });

});

</script>


