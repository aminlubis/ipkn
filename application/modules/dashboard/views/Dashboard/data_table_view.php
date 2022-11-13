<style>
    .info {
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 25px;
        height: 25px;
        background-color: #d3e0e9;
    }
</style>
<?php if($kl=='') :?>
<table width="100%">
    <tr>
        <td width="50%" style="font-size: 28px;"><b>Indonesia</b> <small style="font-size: 12px !important">Ranking TTCI <?php echo $year_current?></small></td>
        <td width="50%" style="text-align: right">
            <?php 
                $ranking_indo = $this->master->getRankingArray($overall_score);
                echo '<span style="font-size: 28px"><b>'.$ranking_indo['rank'].'</b></span>/<span style="font-size: 14px">'.$ranking_indo['total_country'].'</span>';
            ?>
        </td>
    </tr>
</table>
<?php endif; ?>

<!-- <span style="font-size: 16px">Travel & Tourism Competitiveness Index, 1–7 (best)</span> -->

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
            <td style="text-align: right;"><?php echo number_format($overall_score_last_year, 2)?></td>
            <td style="text-align: right; font-size: 16px; font-weight: bold"><?php echo number_format($overall_score, 2)?> &nbsp; <?php echo $sign; ?> </td>
        </tr>
        <?php if($kl=='') :?>
        <tr>
            <td>Country Ranking</td>
            <td style="text-align: right;">
            40/141
                <!-- <?php echo $this->master->getRanking($overall_score_last_year);?> -->
            </td>
            <td style="text-align: right; font-size: 16px; font-weight: bold">
                <?php
                        echo $this->master->getRanking($overall_score);
                        $sign_rank = $this->master->getSignScore($this->master->getRanking($overall_score), $this->master->getRanking($overall_score_last_year));
                        echo '&nbsp; '.$sign_rank;
                ?>
                    
            </td>
        </tr>

        <?php endif; ?>
        <tr>
            <td>Total Subpillar</td>
            <td style="text-align: right" colspan="2"> <?php echo $total_sekunder; ?> Components Secondary Data</td>
        </tr>
        <tr>
            <td>Current Progress Input Data</td>
            <td colspan="2" style="text-align: right"><span style="text-align: right; color: <?php echo $class_progress['color']?>; font-weight: bold;font-size: 18px"><?php echo number_format($progress['persentase_progress'], 2); ?> % </span> (<?php echo $progress['total_dt'].'/'.$total_sekunder?>) </td>
        </tr>
    </tbody>
</table>
<table class="table fold-table">
    <thead>
        <tr class="table-bg-blue">
            <th style="width: 30px; text-align: center;">No</th>
            <th>Index Component</th>
            <th style="width: 165px; text-align: right">Score 2019</th>
            <th style="width: 165px; text-align: right">Score <?php echo $year_current?></th>
            <th style="width: 30px;">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <tr class="view">
            <td style="text-align: center"></td>
            <td style="text-align: left; font-weight: bold; font-size: 16px">Travel & Tourism Competitiveness Index</td>
            <td style="width:165px; text-align: right"><?php echo number_format($overall_score_last_year, 2)?></td>
            <td style="width:165px; text-align: right"><?php echo number_format($overall_score, 2)?> &nbsp; <?php echo $sign; ?></td>
            <td style="width:30px; text-align: right"></span></td>
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
                // echo '<pre>';print_r($val_row_dt);die;
                $last_score_pillar = $last_score[$key_row_dt];
                $current_score_pillar = $current_score[$key_row_dt];

                $sign = $this->master->getSignScore($current_score_pillar, $last_score_pillar);
        ?>
        
        <tr class="view">
            <td style="text-align: center"></td>
            <td style="text-align: left">
            <span class="table-view-dropdown"></span>
            <?php $icon = (!empty($val_row_dt[0]['icon']))?'<img src="'.base_url().'uploaded/images/'.$val_row_dt[0]['icon'].'" width="40px">':''; echo $icon;?>
            <b><?php echo ucwords($key_row_dt); ?></b> <small><?php echo $val_row_dt[0]['pillar_note']?></small></td>
            <td style="width:165px; text-align: right"><?php echo number_format($last_score_pillar, 2)?></td>
            <td style="width:165px; text-align: right"><?php echo number_format($current_score_pillar, 2)?> <?php echo $sign; ?></td>
            <td style="width:30px; text-align: right"></td>
        </tr>
        
        <tr class="fold">
            <td class="fold-area" colspan="5">
                <div class="fold-content">
                    <table class="table">
                        <tbody>
                        <?php 
                        foreach ($val_row_dt as $key_ln => $row_ln) : 
                            $sign_subpillar = $this->master->getSignScore($row_ln['current_score'], $row_ln['last_score']);
                        ?>
                        <tr>
                            <td style="width: 60px">
                                <a class="info" style="cursor:pointer !important" onclick="show_modal('<?php echo base_url()?>landing/Landing/modal_information/subpillar/<?php echo $row_ln['subpillar_id']?>', 'Information')" >
                                    <i class="fa fa-info"></i>
                                </a>
                            </td>
                            <td style="text-align: left;">&nbsp;&nbsp;&nbsp;<?php echo ucwords($row_ln['subpillar_desc']); ?></td>
                            <td style="width:165px; text-align: right"><?php echo number_format($row_ln['last_score'], 2)?></td>
                            <td style="width:165px; text-align: right"><?php echo number_format($row_ln['current_score'], 2)?> <?php echo $sign_subpillar; ?></td>
                            <th style="width:30px; text-align: right">&nbsp;</th>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </td>
        </tr>

        <?php endforeach; ?>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- modal-->
<div class="modal fade" id="modal-content-view" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="text-title-modal">Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- modal information-->
            <div class="modal-body">
                <div id="modal-content-body-load-page"></div>
            </div>
            <!--    modal information-->
        </div>
    </div>
</div>
<!--modal-->

<script src="<?php echo base_url()?>assets/landing/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url()?>assets/landing/js/jquery.easing.min.js"></script>
<script src="<?php echo base_url()?>assets/landing/js/scrollspy.min.js"></script>
<script src="<?php echo base_url()?>assets/landing/js/feather.min.js"></script>

<!-- app js -->
<script src="<?php echo base_url()?>assets/landing/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url()?>assets/landing/js/app.js"></script>

<script>
    function preventDefault(e) {
        e = e || window.event;
        if (e.preventDefault)
            e.preventDefault();
        e.returnValue = false;  
    }

    function show_modal(url, title){  

        preventDefault();
        $('#text-title-modal').text(title);
        $('#modal-content-body-load-page').load(url); 
        $("#modal-content-view").modal();

    }
</script>
