<span style="font-size: 16px">Travel & Tourism Competitiveness Index, 1–7 (best)</span>

<table class="table">
<thead>
    <tr class="table-bg-green">
        <th>Travel &amp; Tourism Competitiveness Edition</th>
        <th style="text-align: right">Year 2019</th>
        <th style="text-align: right">Year <?php echo $year_current; ?></th>
    </tr>
</thead>
<tbody>
    <tr>
        <td>Overall</td>
        <td style="text-align: right;"><?php echo $overall_score_last_year?></td>
        <td style="text-align: right; font-size: 16px; font-weight: bold"><?php echo $overall_score?> &nbsp; <?php echo $sign; ?> </td>
    </tr>
    <tr>
        <td>Ranking</td>
        <td style="text-align: right;">
            <!-- <?php echo $this->master->getRanking($overall_score_last_year);?> -->
            40/141
        </td>
        <td style="text-align: right; font-size: 16px; font-weight: bold">
            <?php echo $this->master->getRanking($overall_score)?> &nbsp; 
            <?php
                $sign_rank = $this->master->getSignScore($this->master->getRanking($overall_score), $this->master->getRanking($overall_score_last_year));
                echo $sign_rank;
            ?>
        </td>
    </tr>
    <tr>
        <td>Total Subpillar</td>
        <td style="text-align: right" colspan="2"> <?php echo $total_sekunder; ?> Components Secondary Data</td>
    </tr>
    <tr>
        <td>Current Progress Input Data</td>
        <td colspan="2" style="text-align: right; color: <?php echo $class_progress['color']?>; font-weight: bold"><?php echo $progress?> (%)  </td>
    </tr>
</tbody>
</table>

<table class="table fold-table">
    <thead>
        <tr class="table-bg-blue">
            <th style="width: 60px; text-align: center;">No</th>
            <th>Index Component</th>
            <th style="width: 165px; text-align: right">Score 2019</th>
            <th style="width: 165px; text-align: right">Score <?php echo $year_current?></th>
            <th style="width: 30px;">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <tr class="view">
            <td style="text-align: left; font-weight: bold; font-size: 16px" colspan="2"><span class="table-view-dropdown"></span> Travel & Tourism Competitiveness Index</td>
            <td style="width:165px; text-align: right"><?php echo $overall_score_last_year?></td>
            <td style="width:165px; text-align: right"><?php echo $overall_score?> &nbsp; <?php echo $sign; ?></td>
            <td style="width:30px; text-align: right"></td>
        </tr>
        <?php 
            $no=0; 
            foreach ($subpillar as $key_dt => $row_dt) : 
                $no++; 
                $is_last_score = (is_array($last_score_index[$key_dt]))?$last_score_index[$key_dt]:0;
                $last_score_index_dt = (array_sum($is_last_score) > 0) ? array_sum($is_last_score) / count($is_last_score) : 0;

                $is_current_score = (is_array($current_score_index[$key_dt]))?$current_score_index[$key_dt]:0;
                $current_score_index_dt = (array_sum($is_current_score) > 0)? array_sum($is_current_score) / count($is_current_score) : 0;
                $sign_index = $this->master->getSignScore($current_score_index, $last_score_index);
        ?>

        <tr class="view" style="background: #d5337c26">
            <td style="text-align: center"><?php echo $no?></td>
            <td style="text-align: left"><span class="table-view-dropdown"></span> <?php echo ucwords($key_dt); ?></td>
            <td style="width:165px; text-align: right"><?php echo number_format($last_score_index_dt, 2)?></td>
            <td style="width:165px; text-align: right"><?php echo number_format($current_score_index_dt, 2)?> <?php echo $sign_index; ?></td>
            <td style="width:30px; text-align: right"></td>
        </tr>

        <?php 
            foreach($row_dt as $key_row_dt => $val_row_dt) : 
                $last_score_pillar = array_sum($last_score[$key_row_dt]) / count($last_score[$key_row_dt]);
                $current_score_pillar = array_sum($current_score[$key_row_dt]) / count($current_score[$key_row_dt]);
                $sign = $this->master->getSignScore($current_score_pillar, $last_score_pillar);
        ?>
        
        <tr class="view" style="background: #1b79c254">
            <td style="text-align: center"></td>
            <td style="text-align: left">&nbsp;&nbsp;&nbsp; <span class="table-view-dropdown"></span> <?php echo ucwords($key_row_dt); ?></td>
            <td style="width:165px; text-align: right"><?php echo number_format($last_score_pillar, 2)?></td>
            <td style="width:165px; text-align: right"><?php echo number_format($current_score_pillar, 2)?> <?php echo $sign; ?></td>
            <td style="width:30px; text-align: right"></td>
        </tr>
        
        <?php 
            foreach ($val_row_dt as $key_ln => $row_ln) : 
                $sign_subpillar = $this->master->getSignScore($row_ln['current_score'], $row_ln['last_score']);
        ?>
            <tr class="view">
                <td style="width: 60px"></td>
                <td style="text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucwords($row_ln['subpillar_desc']); ?></td>
                <td style="width:165px; text-align: right"><?php echo number_format($row_ln['last_score'], 2)?></td>
                <td style="width:165px; text-align: right"><?php echo number_format($row_ln['current_score'], 2)?> <?php echo $sign_subpillar; ?></td>
                <th style="width:30px; text-align: right">&nbsp;</th>
            </tr>
        <?php endforeach; ?>
        <?php endforeach; ?>
        <?php endforeach; ?>
    </tbody>
</table>

<script src="<?php echo base_url()?>assets/landing/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url()?>assets/landing/js/jquery.easing.min.js"></script>
<script src="<?php echo base_url()?>assets/landing/js/scrollspy.min.js"></script>
<script src="<?php echo base_url()?>assets/landing/js/feather.min.js"></script>

<!-- app js -->
<script src="<?php echo base_url()?>assets/landing/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url()?>assets/landing/js/app.js"></script>
