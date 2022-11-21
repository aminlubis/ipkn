<?php if(count($result) > 0) :?>
  <div style="margin-left: 35px">
    <div style="padding: 10px">
      <a href="#" onclick="getMenu('data_ipkn/Tr_data_header/entry_data/<?php echo $value->dh_id?>')" class="btn btn-sm btn-success">Update Data</a>
    </div>
    <?php echo ($value->dh_description != NULL)?'Keterangan : '.$value->dh_description.'':''; ?></div>
    <table class="table table-bordered" style="width: 90%; margin-left: 35px;font-size: 10px !important">
        <tr style="background: #cbe4ee">  
          <th>No</th>
          <th>Kode</th>
          <th>Indikator</th>
          <th>Value</th>
          <th>Skor</th>
        </tr>
        <?php 
          $no = 0; 
          foreach ($result as $key => $value) : 
          $no++; 
        ?>
        <tr>
          <td style="text-align: center"><?php echo $no; ?></td>
          <td><?php echo $value->indicator_code; ?></td>
          <td><?php echo $value->indicator_name; ?></td>
          <td style="text-align: right"><?php echo number_format($value->value, 2); ?></td>
          <td style="text-align: right"><?php echo number_format($value->score, 2); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
  </div>
<?php else: ?>
<span style="color: red">No Data Available</span>
<?php endif; ?>