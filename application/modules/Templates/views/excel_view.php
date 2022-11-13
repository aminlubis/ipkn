<?php 

  header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
  header("Content-Disposition: attachment; filename=".'export_perjanjian_'.date('Ymd').".xls");  //File name extension was wrong
  header("Expires: 0");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("Cache-Control: private",false);
  

?>

<html>
<head>
  <title><?php echo $title?></title>
  <link rel="stylesheet" href="<?php echo base_url()?>assets/css/bootstrap.css" />
  <link rel="stylesheet" href="<?php echo base_url()?>assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />
</head>
<body>
  <div class="row">
    <div class="col-xs-12">

      <center><h4><?php echo $title?></h4></center>
      <table class="table">
        <thead>
          <tr>
            <th>NO</th>
            <?php 
              foreach($fields as $field){
                echo '<th>'.strtoupper($field).'</th>';
            }?>
          </tr>
        </thead>
        <tbody>
          <?php $no = 0; foreach($data as $row_data) : $no++; ?>
            <tr>
              <td align="center"><?php echo $no;?></td>
              <?php 
              foreach($fields as $row_field){
                  echo '<td>'.strtoupper($row_data->$row_field).'</td>';
              }?>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

    </div><!-- /.col -->
  </div><!-- /.row -->
</body>
</html>






