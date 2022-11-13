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
            <a onclick="getMenu('data/Tr_data_header')" href="#" class="btn btn-sm btn-success">
              <i class="ace-icon fa fa-arrow-left icon-on-right bigger-110"></i>
              Back previous
            </a>
            <a onclick="getMenu('data/Tr_input_dt/form?dh_id=<?php echo $dh_id?>')" href="#" class="btn btn-sm btn-primary">
              Input Data
            </a>
            <?php echo $this->authuser->show_button('data/Tr_input_dt','D','',5)?>
            <?php echo $this->authuser->show_button('data/Tr_input_dt','EX','',1)?>
          </div>
        </div>
      </div>
    </div>
    <div class="kt-portlet__body">

      <!--begin: Datatable -->
      <table id="dynamic-table" base-url="<?php echo base_url()?>data/Tr_input_dt" class="table table-responsive-sm table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline">
      <thead>
        <tr>  
          <th width="30px" style="text-align: center; valign: top"></th>
          <th width="80px">Action</th>
          <th width="50px">ID</th>
          <th>K/L</th>
          <th>Subpillar</th>
          <th width="60px">Year</th>
          <th width="60px">Value</th>
          <th width="60px">Score</th>
          <th width="100px">Last Update</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
      </table>

      <!--end: Datatable -->
    </div>
  </div>
  
</form>

<script>
  $(document).ready(function() {
    
  //initiate dataTables plugin
    oTable = $('#dynamic-table').DataTable({ 
          
      "processing": true, //Feature control the processing indicator.
      "serverSide": true, //Feature control DataTables' server-side processing mode.
      "scrollX": false,
      "ordering": false,
      // Load data for the table's content from an Ajax source
      "ajax": {
          "url": "<?php echo base_url()?>data/Tr_input_dt/get_data?dh_id=<?php echo $dh_id?>",
          "type": "POST"
      },

    });

    $('#dynamic-table tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            oTable.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );
      
});

</script>
