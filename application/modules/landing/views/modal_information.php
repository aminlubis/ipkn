<table class="table table-borderless">
    <tr>
        <td colspan="2"><span style="font-size: 14px; font-weight: bold"><?php echo ucwords($value->subpillar_desc)?></span></td>
    </tr>
    <tr>
        <td>Description</td>
        <td>: <?php echo ucwords($value->question)?></td>
    </tr>

    <tr>
        <td>Source</td>
        <td>: <?php echo ucwords($value->source)?></td>
    </tr>

    <tr>
        <td>Edition</td>
        <td>: <?php echo ucwords($year)?></td>
    </tr>

    <tr>
        <td>Note</td>
        <td>: <?php echo ucwords($value->note)?></td>
    </tr>
    <tr>
        <td>Type Data</td>
        <td>: <?php echo ($value->subpillar_desc=='E')?'Primary':'Secondary'; ?></td>
    </tr>
    <tr>
        <td>Last Value</td>
        <td>: <?php echo ($value->last_value != '')?$value->last_value:$value->data_value; ?></td>
    </tr>

    <tr>
        <td>Current Value</td>
        <td>: <?php echo ($value->current_value != '')?$value->current_value:0; ?></td>
    </tr>

    <tr>
        <td>Statistics</td>
        <td>Min <?php echo $value->min_value; ?>; Max <?php echo $value->max_value; ?>; Median <?php echo $value->med_value; ?></td>
    </tr>

    <tr>
        <td>Exclussion Filter</td>
        <td>: <?php echo ($value->is_exclusive=='Y')?'Yes':'No'; ?></td>
    </tr>

    <tr>
        <td>Outlayer</td>
        <td>: <?php echo ($value->is_outlayer=='Y')?'Yes':'No'; ?></td>
    </tr>

</table>