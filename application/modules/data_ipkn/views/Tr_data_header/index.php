<div class="kt-subheader   kt-grid__item" id="kt_subheader">
  <div class="kt-container  kt-container--fluid ">
    <div class="kt-subheader__main">
      <h1 class="kt-subheader__title">
      <?php echo $title?> </h1>
      <span class="kt-subheader__separator kt-hidden"></span>
      <i class="fa fa-angle-double-right"></i> &nbsp; 
      <?php echo isset($breadcrumbs)?$breadcrumbs:''?>
    </div>
  </div>
</div>

<form class="form-horizontal" method="post" id="form_search" action="#">

  <div class="kt-portlet kt-portlet--mobile">
    <div class="kt-portlet__head kt-portlet__head--lg">
      <div class="kt-portlet__head-toolbar">
        <div class="kt-portlet__head-wrapper">
          <div class="kt-portlet__head-actions">
            <?php echo $this->authuser->show_button('data_ipkn/Tr_data_header','C','',1)?>
            <?php echo $this->authuser->show_button('data_ipkn/Tr_data_header','D','',5)?>
            <?php echo $this->authuser->show_button('data_ipkn/Tr_data_header','EX','',1)?>
          </div>
        </div>
      </div>
    </div>
    <div class="kt-portlet__body">

      <!--begin: Datatable -->
      <table id="dynamic-table" base-url="<?php echo base_url()?>data_ipkn/Tr_data_header" url-detail="<?php echo base_url()?>data_ipkn/Tr_data_header/show_detail" class="table table-responsive-sm table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline">
        <thead>
          <tr class="table-bg-green">  
            <th width="30px" class="center"></th>
            <th width="30px" class="center"></th>
            <th width="30px" class="center"></th>
            <!-- <th width="50px">ID</th> -->
            <th style="color: white !important">Tahun</th>
            <th style="color: white !important">Provinsi</th>
            <th style="color: white !important">Deskripsi</th>
            <th style="color: white !important" width="120px">Action</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>

      <!--end: Datatable -->
    </div>
  </div>
  
</form>

<script src="<?php echo base_url().'assets/js/custom/als_datatable_with_detail_custom_url.js'?>"></script>

<script>
  function return_confirm(id){

    swal.fire({
      title: "Are you sure want to continue input Data TTCI For This Project?",
      text: "Please fill your data correctly",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#6cb42c",
      confirmButtonText: "Yes, continue!",
      closeOnConfirm: true,
      preConfirm: function () {
        return new Promise(function (resolve, reject) {
          resolve();
        })
      },
      allowOutsideClick: false
    }).then(function (response) {
        console.log(response);
        if(response.value == true){
          getMenu('data/Tr_input_dt/index?dh_id='+id+'');       
        }

    })
  }
</script>