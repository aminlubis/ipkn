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
        <td>Overall Score</td>
        <td style="text-align: right;"><?php echo $overall_score_last_year?></td>
        <td style="text-align: right; font-size: 16px; font-weight: bold"><?php echo $overall_score?> &nbsp; <?php echo $sign; ?> </td>
    </tr>
    <tr>
        <td>Country Ranking</td>
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
        <th style="width: 60px">No</th>
        <th>Index Component</th>
        <th style="width: 80px">Score 2019</th>
        <th style="width: 80px">Score (<?php echo $year_current?>)</th>
        <th></th>
    </tr>
</thead>
<tbody>
    <?php 
        $no=0; 
        foreach ($subpillar as $key_dt => $row_dt) : 
        $no++; 
        $last_score_pillar = array_sum($last_score[$key_dt]) / count($last_score[$key_dt]);
        $current_score_pillar = array_sum($current_score[$key_dt]) / count($current_score[$key_dt]);
        $sign = $this->master->getSignScore($current_score_pillar, $last_score_pillar);
    ?>
        <tr class="view">
            <td style="text-align: center"><?php echo $no?></td>
            <td style="text-align: left"><?php echo ucwords($key_dt); ?></td>
            <td style="width:80px; text-align: right"><?php echo number_format($last_score_pillar, 2)?></td>
            <td style="width:80px; text-align: right"><?php echo number_format($current_score_pillar, 2)?> <?php echo $sign; ?></td>
            <td style="width:80px; text-align: right"><span class="table-view-dropdown"></span></td>
        </tr>
        
        <tr class="fold">
            <td class="fold-area" colspan="5">
                <div class="fold-content">
                    <table class="table">
                        <tbody>
                        <?php 
                            foreach ($row_dt as $key_ln => $row_ln) : 
                            $sign_subpillar = $this->master->getSignScore($row_ln['current_score'], $row_ln['last_score']);
                        ?>
                            <tr>
                                <td style="width: 60px"></td>
                                <td style="text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ucwords($row_ln['subpillar_desc']).' ('.$row_ln['type_data'].')'; ?></td>
                                <td style="width:80px; text-align: right"><?php echo number_format($row_ln['last_score'], 2)?></td>
                                <td style="width:80px; text-align: right"><?php echo number_format($row_ln['current_score'], 2)?> <?php echo $sign_subpillar; ?></td>
                                <th style="width:80px; text-align: right">&nbsp;</th>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>
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
