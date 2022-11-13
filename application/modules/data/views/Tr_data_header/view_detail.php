<?php if(count($result) > 0) :?>
  <div style="margin-left: 35px">
    <b>Detail Data Input </b><br>
    <?php echo ($value->dh_description != NULL)?'Keterangan : '.$value->dh_description.'':''; ?><br>(secondary data)</div>
<table class="table table-bordered" style="width: 95%; margin-left: 35px;font-size: 10px !important">
    <tr style="background: #cbe4ee">  
      <th>No</th>
      <th>Subpillar</th>
      <th width="110px">Published</th>
      <th width="110px">Last Value</th>
      <th width="110px">Last Score</th>
      <th width="110px">Current Value</th>
      <th width="110px">Current Score</th>
      <th>Source</th>
      <th>Note</th>
    </tr>
    <?php 
      $no = 0; 
      foreach ($result as $key => $value) : 
        if($value->type_data == 'S') :
      $no++; 
      $sign = $this->master->getSignScore($value->score, $value->last_score); 
      $color_type_data = $this->master->getColorOfTypeData($value->data_type);
    ?>
    <tr>
      <td style="text-align: center"><?php echo $no; ?></td>
      <td><?php echo $value->subpillar_desc; ?> <?php echo($value->type_data=='S')?'(secondary)':'(primary)'?></td>
      <td style="text-align: center">
        <span class="kt-badge <?php echo $color_type_data?>  kt-badge--inline kt-badge--pill"><?php echo ucwords($value->data_type); ?></span>
      </td>
      <td style="text-align: right"><?php echo number_format($value->last_value, 2); ?></td>
      <td style="text-align: right"><?php echo $value->last_score; ?></td>
      <td style="text-align: right; background: #0d8bba36;font-size: 16px; font-weight: bold"><?php echo ($value->current_value != 0.00) ? number_format($value->current_value, 2) : '-'; ?></td>
      <td style="text-align: right"><?php echo $value->score.' '.$sign; ?></td>
      <td style="text-align: left; word-break: break-all;">
        <?php 
          $source = ($value->data_type == 'draft') ? ($value->attachment != '-')?'<a href="'.base_url().PATH_FILES.$value->attachment.'" target="_blank" alt="download">'.$value->attachment.'</a>': '-' : '<a href="'.$value->link_url.'" target="_blank">'.$value->link_url.'</a>';
          echo $source; ?>
      </td>
      <td style="text-align: right"><?php echo $value->footnote; ?></td>
    </tr>
    <?php endif; endforeach; ?>
</table>
<?php else: ?>
<span style="color: red">No Data Available</span>
<?php endif; ?>