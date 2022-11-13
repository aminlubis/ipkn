<table id="summary-dt-table" class="table table-responsive-sm table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline">
  <thead>
    <tr>  
      <th style="width: 110px">Min</th>
      <th style="width: 110px">Med</th>
      <th style="width: 110px">Max</th>
      <th style="width: 110px">Last Value</th>
      <th style="width: 110px">Score</th>
      <th style="width: 110px">Current Value</th>
      <th style="width: 110px">Estimated Score</th>
      <th></th>
    </tr>
  </thead>
    <tbody>
      <tr>
        <td style="text-align: center"><?php echo number_format($value->min_value, 2); ?></td>
        <td style="text-align: center"><?php echo number_format($value->med_value, 2); ?></td>
        <td style="text-align: center"><?php echo number_format($value->max_value, 2); ?></td>
        <td style="text-align: center"><?php echo number_format($value->last_value, 2); ?></td>
        <td style="text-align: center">
          <?php 
            // get score last value
            $config = array(
              'type' => $value->type_data,
              'formula' => $value->formula,
              'weighted' => $value->weighted,
              'min' => $value->min_value,
              'max' => $value->max_value,
              'value' => $value->last_value,
            );
            $score_last_value = $this->master->FormulaScore($config);
            echo number_format($score_last_value, 2);
          ?>
        </td>
        <td style="text-align: center"><?php echo $value->current_value; ?></td>
        <td style="text-align: center">
          <?php 
            // get score last value
            $config = array(
              'type' => $value->type_data,
              'formula' => $value->formula,
              'weighted' => $value->weighted,
              'min' => $value->min_value,
              'max' => $value->max_value,
              'value' => $value->current_value,
            );
            $score_current_value = $this->master->FormulaScore($config);
            echo number_format($score_current_value, 2);
          ?>
        </td>
        <td style="text-align: center; width: 120px">
          <?php
            $result = $score_current_value - $score_last_value;
            if($score_last_value > $score_current_value){
              $text_message = '<span style="color: red"> <i class="fa fa-exclamation-triangle bigger-150"></i> decreased '.number_format($result, 2).'</span>';
            }else if($score_last_value == $score_current_value){
              $text_message = '<span style="color: #ffb822"> <i class="fa fa-exclamation-triangle bigger-150"></i> balanced</span>';
            }else{
              $text_message = '<span style="color: green"> <i class="fa fa-check-circle"></i> increased '.number_format($result, 2).'</span> ';
            }
            echo $text_message;
          ?>
        </td>
      </tr>
    </tbody>
  </table>