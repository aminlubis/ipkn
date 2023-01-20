
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="<?php echo base_url()?>assets/landing/css/bootstrap.min.css" type="text/css">

<!-- Material Icon -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/landing/css/materialdesignicons.min.css" /><link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/landing/css/style.css" />

<style>

</style>
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

<style>
  .wrapper {
    border: 1px solid #ccc;
    background: #eee;
    /* width: 320px; */
    /* height: 800px; */
    overflow: auto;
    /* position: relative; */
    padding: 0px;
  }
  table {
    border-spacing: 0;
    /* white-space: nowrap; */
    /* table-layout: fixed; */
  }

  /* thead,
  tr>th {
    position: sticky;
    background: #eee;
  } */

  /* thead {
    top: 0;
    z-index: 2;
  }
  tr>th {
    left: 0;
    z-index: 1;
  }
  thead tr>th:first-child {
    z-index: 3;
  } */

  th,
  td {
    height: 50px;
    border: 1px solid #ccc;
    border-width: 0 0 1px 1px;
    text-align: left;
    padding: 5px;
    font-family: sans-serif;
    /* overflow-wrap: break-word !important; */
    /* word-break: break-all !important; */
    overflow: auto;
  }
  td {
    background: #fff;
  }
  th:first-child {
    border-right-width: 1px;
    border-left: 0;
  }
  th+td,
  th:first-child+th {
    border-left: 0;
  }
  tbody tr:last-child>* {
    border-bottom: 0;
  }
  tr>*:last-child {
    border-right: 0;
  }

  .rotated {
    writing-mode: tb-rl;
    white-space: pre-wrap;
    transform: rotate(0deg);
    font-size: 12px;
    height: 250px;
    width: 100px !important;
}

  </style>

<form class="form-horizontal" method="post" id="form_search" action="#">

  <div class="kt-portlet">
    <div class="kt-portlet__head">
      <div class="kt-portlet__head-label">
        <h3 class="kt-portlet__head-title">
          Hasil Perhitungan Data Indikator
        </h3>
      </div>
    </div>

    <!--begin::Form-->
      <div class="kt-portlet__body">
        <div class="kt-section kt-section--first">
          
        <div class="form-group row">
          <label class="col-lg-1 col-form-label">Tahun</label>
          <div class="col-lg-3">
            <?php echo $this->master->get_tahun(date('Y') , 'tahun', 'tahun', 'form-control', '', '') ?>
          </div>
          <!-- <div class="col-lg-4">
            <a href="#" id="btn_search_data" class="btn btn-xs btn-primary">
              Search
            </a>
            <a href="#" id="btn_reset_data" class="btn btn-xs btn-warning">
              Reset
            </a>
          </div> -->
        </div>

        <div class="card card-primary card-tabs">
          <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
              <li class="nav-item">
              <a class="nav-link active" id="pengisian_data" data-toggle="pill" href="#pengisian_data_tab" role="tab" aria-controls="pengisian_data_tab" aria-selected="true">Pengisian Data</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="formulasi_1" data-toggle="pill" href="#tab_formulasi_1" role="tab" aria-controls="tab_formulasi_1" aria-selected="false">Formulasi 1</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="formulasi_2" data-toggle="pill" href="#tab_formulasi_2" role="tab" aria-controls="tab_formulasi_2" aria-selected="false">Formulasi 2</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="formulasi_3" data-toggle="pill" href="#tab_formulasi_3" role="tab" aria-controls="tab_formulasi_3" aria-selected="false">Formulasi 3</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="formulasi_4" data-toggle="pill" href="#tab_formulasi_4" role="tab" aria-controls="tab_formulasi_4" aria-selected="false">Formulasi 4</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="skor_akhir" data-toggle="pill" href="#tab_skor_akhir" role="tab" aria-controls="tab_skor_akhir" aria-selected="false">Skor Pilar</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="ranking" data-toggle="pill" href="#tab_ranking" role="tab" aria-controls="tab_ranking" aria-selected="false">Skor Index</a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content" id="custom-tabs-one-tabContent">
              <div class="tab-pane fade active show" id="pengisian_data_tab" role="tabpanel" aria-labelledby="pengisian_data">
                <p style="font-weight: bold">PENGISIAN DATA</p>
                <div class="wrapper">
                  <table>
                    <thead>
                      <tr style="color: black !important; ">
                        <th rowspan="2" style="width: 20px !important; background-color: goldenrod">No</th>
                        <th rowspan="2" style="background-color: goldenrod;width: 150px">Provinsi</th>
                        <?php 
                          foreach ($header as $key_subindex => $row_subindex) {
                            foreach($row_subindex as $key_pillar => $row_pillar){
                              $colspan = count($row_pillar) * 2;
                              echo '<th colspan="'.$colspan.'" style="background-color: #17345d; text-align: center; color: white" align="center">'.$key_pillar.'</th>';
                            }
                        }?>
                      </tr>
                      <tr style="color: black !important">
                        <?php 
                          foreach ($header as $key_subindex => $row_subindex) {
                            foreach($row_subindex as $key_pillar => $row_pillar){
                              foreach ($row_pillar as $key_indicator => $row_indicator) {
                                # code...
                                echo '<th colspan="2" class="rotated" style="background-color: #17345d; text-align: right; color: white">'.$row_indicator->indicator_code.'<br>'.$row_indicator->indicator_name.'</th>';
                              }
                            }
                        }?>
                      </tr>
                      <tr style="color: black !important; background-color: goldenrod">
                        <th colspan="2"></th>
                        <?php 
                          foreach ($header as $key_subindex => $row_subindex) {
                            foreach($row_subindex as $key_pillar => $row_pillar){
                              foreach ($row_pillar as $key_indicator => $row_indicator) {
                                # code...
                                echo '<th style="width: 50px !important; text-align: center">Nilai</th>';
                                echo '<th style="width: 50px !important; text-align: center">Skor</th>';
                              }
                            }
                        }?>
                      <tr>
                    </thead>
                    <tbody>
                      <?php $no=0; foreach ($provinces as $key => $value_prov) : $no++?>
                        <tr>
                          <th scope="row"  style="background-color: goldenrod;text-align: center"><?php echo $no?></th>
                          <th scope="row"  style="background-color: goldenrod;"><?php echo $value_prov->name?></th>
                          <?php 
                          foreach ($header as $key_subindex => $row_subindex) {
                            foreach($row_subindex as $key_pillar => $row_pillar){
                              foreach ($row_pillar as $key_indicator => $row_indicator) {
                                # code...
                                $getrow = isset($summary[$value_prov->id][$row_indicator->indicator_id])?$summary[$value_prov->id][$row_indicator->indicator_id]:'';
                                $value_dt = isset($getrow->data1)?$getrow->data1:0;
                                $score_dt = isset($getrow->score1)?$getrow->score1:0;
                                $count[$row_indicator->indicator_id][round($score_dt)][] = 1;
                                $color_code = $this->template->color_parameter(round($score_dt));
                                echo '<td style="text-align: center; background: '.$color_code.'; font-weight: bold">'.number_format($value_dt, 2).'</td>';
                                echo '<td style="text-align: center; background: '.$color_code.'; font-weight: bold">'.number_format($score_dt, 2).'</td>';
                                
                              }
                            }
                        }?>
                        </tr>
                      <?php endforeach;?>
                      <?php
                      // echo '<pre>';print_r($count);
                        for ($i=1; $i < 8; $i++) { 
                          echo '<tr>';
                          echo '<td colspan="2" style="text-align: center; font-weight: bold">'.$i.'</td>';
                          foreach ($header as $key_subindex => $row_subindex) {
                              foreach($row_subindex as $key_pillar => $row_pillar){
                                foreach ($row_pillar as $key_indicator => $row_indicator) {
                                  # code...
                                  $getrow = isset($summary[$value_prov->id][$row_indicator->indicator_id])?$summary[$value_prov->id][$row_indicator->indicator_id]:'';
                                  $score_dt = isset($getrow->data1)?$getrow->data1:0;
                                  $count_num = isset($count[$row_indicator->indicator_id][$i])?count($count[$row_indicator->indicator_id][$i]):0;
                                  $color_code = $this->template->color_parameter($count_num);
                                  echo '<td colspan="2" style="text-align: center; background: '.$color_code.'; font-weight: bold">'.$count_num.'</td>';
                                }
                              }
                          }
                          echo '</tr>';
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
                
              </div>
              <div class="tab-pane fade" id="tab_formulasi_1" role="tabpanel" aria-labelledby="formulasi_1">
                <p style="font-weight: bold">FORMULASI 1</p>
                <div class="wrapper">
                  <table>
                    <thead>
                      <tr style="color: black !important">
                        <th rowspan="2" style="width: 20px !important; background-color: goldenrod">No</th>
                        <th rowspan="2" style="background-color: goldenrod;width: 150px">Provinsi</th>
                        <?php 
                          foreach ($header as $key_subindex => $row_subindex) {
                            foreach($row_subindex as $key_pillar => $row_pillar){
                              $colspan = count($row_pillar) * 2;
                              echo '<th colspan="'.$colspan.'" style="background-color: #17345d; text-align: center; color: white" align="center">'.$key_pillar.'</th>';
                            }
                        }?>
                      </tr>
                      <tr style="color: black !important">
                        <?php 
                          foreach ($header as $key_subindex => $row_subindex) {
                            foreach($row_subindex as $key_pillar => $row_pillar){
                              foreach ($row_pillar as $key_indicator => $row_indicator) {
                                # code...
                                echo '<th colspan="2" class="rotated" style="background-color: #17345d; text-align: right; color: white">'.$row_indicator->indicator_code.'<br>'.$row_indicator->indicator_name.'</th>';
                              }
                            }
                        }?>
                      </tr>
                      <tr style="color: black !important; background-color: goldenrod">
                        <th colspan="2"></th>
                        <?php 
                          foreach ($header as $key_subindex => $row_subindex) {
                            foreach($row_subindex as $key_pillar => $row_pillar){
                              foreach ($row_pillar as $key_indicator => $row_indicator) {
                                # code...
                                echo '<th style="width: 50px !important; text-align: center">Nilai</th>';
                                echo '<th style="width: 50px !important; text-align: center">Skor</th>';
                              }
                            }
                        }?>
                      <tr>
                    </thead>
                    <tbody>
                      <?php $no=0; foreach ($provinces as $key => $value_prov) : $no++?>
                        <tr>
                          <th scope="row"  style="background-color: goldenrod;text-align: center"><?php echo $no?></th>
                          <th scope="row"  style="background-color: goldenrod;"><?php echo $value_prov->name?></th>
                          <?php 
                          foreach ($header as $key_subindex => $row_subindex) {
                            foreach($row_subindex as $key_pillar => $row_pillar){
                              foreach ($row_pillar as $key_indicator => $row_indicator) {
                                # code...
                                // $getrow = isset($summary[$value_prov->id][$row_indicator->indicator_id])?$summary[$value_prov->id][$row_indicator->indicator_id]:'';
                                // $score_dt = isset($getrow->score)?$getrow->score:0;
                                // $color_code = $this->template->color_parameter(round($score_dt));
                                // echo '<td style="text-align: center; background: '.$color_code.'; font-weight: bold">'.round($score_dt).'</td>';
                                

                                # code...
                                $getrow = isset($summary[$value_prov->id][$row_indicator->indicator_id])?$summary[$value_prov->id][$row_indicator->indicator_id]:'';
                                $value_dt2 = isset($getrow->data2)?$getrow->data2:0;
                                $score_dt2 = isset($getrow->score2)?$getrow->score2:0;
                                $color_code2 = $this->template->color_parameter(round($score_dt2));
                                $count2[$row_indicator->indicator_id][round($score_dt2)][] = 1;
                                echo '<td style="text-align: center; background: '.$color_code2.'; font-weight: bold">'.number_format($value_dt2, 2).'</td>';
                                echo '<td style="text-align: center; background: '.$color_code2.'; font-weight: bold">'.number_format($score_dt2, 2).'</td>';
                                
                              }
                            }
                        }?>
                        </tr>
                      <?php endforeach;?>
                      <?php
                      // echo '<pre>';print_r($count);
                        for ($i=1; $i < 8; $i++) { 
                          echo '<tr>';
                          echo '<td colspan="2" style="text-align: center; font-weight: bold">'.$i.'</td>';
                          foreach ($header as $key_subindex => $row_subindex) {
                              foreach($row_subindex as $key_pillar => $row_pillar){
                                foreach ($row_pillar as $key_indicator => $row_indicator) {
                                  # code...
                                  $getrow = isset($summary[$value_prov->id][$row_indicator->indicator_id])?$summary[$value_prov->id][$row_indicator->indicator_id]:'';
                                  $score_dt2 = isset($getrow->score2)?$getrow->score2:0;
                                  $count_num2 = isset($count2[$row_indicator->indicator_id][$i])?count($count2[$row_indicator->indicator_id][$i]):0;
                                  $color_code2 = $this->template->color_parameter($count_num2);
                                  echo '<td colspan="2" style="text-align: center; background: '.$color_code2.'; font-weight: bold">'.$count_num2.'</td>';
                                }
                              }
                          }
                          echo '</tr>';
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane fade" id="tab_formulasi_2" role="tabpanel" aria-labelledby="formulasi_2">
                <p style="font-weight: bold">FORMULASI 2</p>
                <div class="wrapper">
                  <table>
                    <thead>
                      <tr style="color: black !important; ">
                        <th rowspan="2" style="width: 20px !important; background-color: goldenrod">No</th>
                        <th rowspan="2" style="background-color: goldenrod;width: 150px">Provinsi</th>
                        <?php 
                          foreach ($header as $key_subindex => $row_subindex) {
                            foreach($row_subindex as $key_pillar => $row_pillar){
                              $colspan = count($row_pillar) * 2;
                              echo '<th colspan="'.$colspan.'" style="background-color: #17345d; text-align: center; color: white" align="center">'.$key_pillar.'</th>';
                            }
                        }?>
                      </tr>
                      <tr style="color: black !important">
                        <?php 
                          foreach ($header as $key_subindex => $row_subindex) {
                            foreach($row_subindex as $key_pillar => $row_pillar){
                              foreach ($row_pillar as $key_indicator => $row_indicator) {
                                # code...
                                echo '<th colspan="2" class="rotated" style="background-color: #17345d; text-align: right; color: white">'.$row_indicator->indicator_code.'<br>'.$row_indicator->indicator_name.'</th>';
                              }
                            }
                        }?>
                      </tr>
                      <tr style="color: black !important; background-color: goldenrod">
                        <th colspan="2"></th>
                        <?php 
                          foreach ($header as $key_subindex => $row_subindex) {
                            foreach($row_subindex as $key_pillar => $row_pillar){
                              foreach ($row_pillar as $key_indicator => $row_indicator) {
                                # code...
                                echo '<th style="width: 50px !important; text-align: center">Nilai</th>';
                                echo '<th style="width: 50px !important; text-align: center">Skor</th>';
                              }
                            }
                        }?>
                      <tr>
                    </thead>
                    <tbody>
                      <?php $no=0; foreach ($provinces as $key => $value_prov) : $no++?>
                        <tr>
                          <th scope="row"  style="background-color: goldenrod;text-align: center"><?php echo $no?></th>
                          <th scope="row"  style="background-color: goldenrod;"><?php echo $value_prov->name?></th>
                          <?php 
                          foreach ($header as $key_subindex => $row_subindex) {
                            foreach($row_subindex as $key_pillar => $row_pillar){
                              foreach ($row_pillar as $key_indicator => $row_indicator) {
                                # code...
                                // $getrow = isset($summary[$value_prov->id][$row_indicator->indicator_id])?$summary[$value_prov->id][$row_indicator->indicator_id]:'';
                                // $score_dt = isset($getrow->score)?$getrow->score:0;
                                // $color_code = $this->template->color_parameter(round($score_dt));
                                // echo '<td style="text-align: center; background: '.$color_code.'; font-weight: bold">'.round($score_dt).'</td>';
                                

                                # code...
                                $getrow = isset($summary[$value_prov->id][$row_indicator->indicator_id])?$summary[$value_prov->id][$row_indicator->indicator_id]:'';
                                $value_dt3 = isset($getrow->data3)?$getrow->data3:0;
                                $score_dt3 = isset($getrow->score3)?$getrow->score3:0;
                                $color_code3 = $this->template->color_parameter(round($score_dt3));
                                $count3[$row_indicator->indicator_id][round($score_dt3)][] = 1;
                                echo '<td style="text-align: center; background: '.$color_code3.'; font-weight: bold">'.number_format($value_dt3, 2).'</td>';
                                echo '<td style="text-align: center; background: '.$color_code3.'; font-weight: bold">'.number_format($score_dt3, 2).'</td>';
                                
                              }
                            }
                        }?>
                        </tr>
                      <?php endforeach;?>
                      <?php
                      // echo '<pre>';print_r($count);
                        for ($i=1; $i < 8; $i++) { 
                          echo '<tr>';
                          echo '<td colspan="2" style="text-align: center; font-weight: bold">'.$i.'</td>';
                          foreach ($header as $key_subindex => $row_subindex) {
                              foreach($row_subindex as $key_pillar => $row_pillar){
                                foreach ($row_pillar as $key_indicator => $row_indicator) {
                                  # code...
                                  $getrow = isset($summary[$value_prov->id][$row_indicator->indicator_id])?$summary[$value_prov->id][$row_indicator->indicator_id]:'';
                                  $score_dt3 = isset($getrow->score3)?$getrow->score3:0;
                                  $count_num3 = isset($count3[$row_indicator->indicator_id][$i])?count($count3[$row_indicator->indicator_id][$i]):0;
                                  $color_code3 = $this->template->color_parameter($count_num3);
                                  echo '<td colspan="2" style="text-align: center; background: '.$color_code3.'; font-weight: bold">'.$count_num3.'</td>';
                                }
                              }
                          }
                          echo '</tr>';
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="tab-pane fade" id="tab_formulasi_3" role="tabpanel" aria-labelledby="formulasi_3">
                <p style="font-weight: bold">FORMULASI 3</p>
                <div class="wrapper">
                  <table>
                    <thead>
                      <tr style="color: black !important; ">
                        <th rowspan="2" style="width: 20px !important; background-color: goldenrod">No</th>
                        <th rowspan="2" style="background-color: goldenrod;width: 150px">Provinsi</th>
                        <?php 
                          foreach ($header as $key_subindex => $row_subindex) {
                            foreach($row_subindex as $key_pillar => $row_pillar){
                              $colspan = count($row_pillar) * 2;
                              echo '<th colspan="'.$colspan.'" style="background-color: #17345d; text-align: center; color: white" align="center">'.$key_pillar.'</th>';
                            }
                        }?>
                      </tr>
                      <tr style="color: black !important">
                        <?php 
                          foreach ($header as $key_subindex => $row_subindex) {
                            foreach($row_subindex as $key_pillar => $row_pillar){
                              foreach ($row_pillar as $key_indicator => $row_indicator) {
                                # code...
                                echo '<th colspan="2" class="rotated" style="background-color: #17345d; text-align: right; color: white">'.$row_indicator->indicator_code.'<br>'.$row_indicator->indicator_name.'</th>';
                              }
                            }
                        }?>
                      </tr>
                      <tr style="color: black !important; background-color: goldenrod">
                        <th colspan="2"></th>
                        <?php 
                          foreach ($header as $key_subindex => $row_subindex) {
                            foreach($row_subindex as $key_pillar => $row_pillar){
                              foreach ($row_pillar as $key_indicator => $row_indicator) {
                                # code...
                                echo '<th style="width: 50px !important; text-align: center">Nilai</th>';
                                echo '<th style="width: 50px !important; text-align: center">Skor</th>';
                              }
                            }
                        }?>
                      <tr>
                    </thead>
                    <tbody>
                      <?php $no=0; foreach ($provinces as $key => $value_prov) : $no++?>
                        <tr>
                          <th scope="row"  style="background-color: goldenrod;text-align: center"><?php echo $no?></th>
                          <th scope="row"  style="background-color: goldenrod;"><?php echo $value_prov->name?></th>
                          <?php 
                          foreach ($header as $key_subindex => $row_subindex) {
                            foreach($row_subindex as $key_pillar => $row_pillar){
                              foreach ($row_pillar as $key_indicator => $row_indicator) {

                                # code...
                                $getrow = isset($summary[$value_prov->id][$row_indicator->indicator_id])?$summary[$value_prov->id][$row_indicator->indicator_id]:'';
                                $value_dt4 = isset($getrow->data4)?$getrow->data4:0;
                                $score_dt4 = isset($getrow->score4)?$getrow->score4:0;
                                $color_code4 = $this->template->color_parameter(round($score_dt4));
                                $count4[$row_indicator->indicator_id][round($score_dt4)][] = 1;
                                echo '<td style="text-align: center; background: '.$color_code4.'; font-weight: bold">'.number_format($value_dt4, 2).'</td>';
                                echo '<td style="text-align: center; background: '.$color_code4.'; font-weight: bold">'.number_format($score_dt4, 2).'</td>';
                                
                              }
                            }
                        }?>
                        </tr>
                      <?php endforeach;?>
                      <?php
                      // echo '<pre>';print_r($count);
                        for ($i=1; $i < 8; $i++) { 
                          echo '<tr>';
                          echo '<td colspan="2" style="text-align: center; font-weight: bold">'.$i.'</td>';
                          foreach ($header as $key_subindex => $row_subindex) {
                              foreach($row_subindex as $key_pillar => $row_pillar){
                                foreach ($row_pillar as $key_indicator => $row_indicator) {
                                  # code...
                                  $getrow = isset($summary[$value_prov->id][$row_indicator->indicator_id])?$summary[$value_prov->id][$row_indicator->indicator_id]:'';
                                  $score_dt4 = isset($getrow->score4)?$getrow->score4:0;
                                  $count_num4 = isset($count4[$row_indicator->indicator_id][$i])?count($count4[$row_indicator->indicator_id][$i]):0;
                                  $color_code4 = $this->template->color_parameter($count_num4);
                                  echo '<td colspan="2" style="text-align: center; background: '.$color_code4.'; font-weight: bold">'.$count_num4.'</td>';
                                }
                              }
                          }
                          echo '</tr>';
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="tab-pane fade" id="tab_formulasi_4" role="tabpanel" aria-labelledby="formulasi_4">
                <p style="font-weight: bold">FORMULASI 4</p>
                <div class="wrapper">
                  <table>
                    <thead>
                      <tr style="color: black !important">
                        <th rowspan="2" style="width: 20px !important; background-color: goldenrod">No</th>
                        <th rowspan="2" style="background-color: goldenrod;width: 150px">Provinsi</th>
                        <?php 
                          foreach ($header as $key_subindex => $row_subindex) {
                            foreach($row_subindex as $key_pillar => $row_pillar){
                              $colspan = count($row_pillar) * 2;
                              echo '<th colspan="'.$colspan.'" style="background-color: #17345d; text-align: center; color: white" align="center">'.$key_pillar.'</th>';
                            }
                        }?>
                      </tr>
                      <tr style="color: black !important">
                        <?php 
                          foreach ($header as $key_subindex => $row_subindex) {
                            foreach($row_subindex as $key_pillar => $row_pillar){
                              foreach ($row_pillar as $key_indicator => $row_indicator) {
                                # code...
                                echo '<th colspan="2" class="rotated" style="background-color: #17345d; text-align: right; color: white">'.$row_indicator->indicator_code.'<br>'.$row_indicator->indicator_name.'</th>';
                              }
                            }
                        }?>
                      </tr>
                      <tr style="color: black !important; background-color: goldenrod">
                        <th colspan="2"></th>
                        <?php 
                          foreach ($header as $key_subindex => $row_subindex) {
                            foreach($row_subindex as $key_pillar => $row_pillar){
                              foreach ($row_pillar as $key_indicator => $row_indicator) {
                                # code...
                                echo '<th>Nilai</th>';
                                echo '<th>Skor</th>';
                              }
                            }
                        }?>
                      <tr>
                    </thead>
                    <tbody>
                      <?php $no=0; foreach ($provinces as $key => $value_prov) : $no++?>
                        <tr>
                          <th scope="row"  style="background-color: goldenrod;text-align: center"><?php echo $no?></th>
                          <th scope="row"  style="background-color: goldenrod;"><?php echo $value_prov->name?></th>
                          <?php 
                          foreach ($header as $key_subindex => $row_subindex) {
                            foreach($row_subindex as $key_pillar => $row_pillar){
                              foreach ($row_pillar as $key_indicator => $row_indicator) {

                                # code...
                                $getrow = isset($summary[$value_prov->id][$row_indicator->indicator_id])?$summary[$value_prov->id][$row_indicator->indicator_id]:'';
                                $value_dt5 = isset($getrow->data5)?$getrow->data5:0;
                                $score_dt5 = isset($getrow->score5)?$getrow->score5:0;
                                $color_code5 = $this->template->color_parameter(round($score_dt5));
                                $count5[$row_indicator->indicator_id][round($score_dt5)][] = 1;
                                echo '<td style="text-align: center; background: '.$color_code5.'; font-weight: bold">'.number_format($value_dt5, 2).'</td>';
                                echo '<td style="text-align: center; background: '.$color_code5.'; font-weight: bold">'.number_format($score_dt5, 2).'</td>';
                                
                              }
                            }
                        }?>
                        </tr>
                      <?php endforeach;?>
                      <?php
                      // echo '<pre>';print_r($count);
                        for ($i=1; $i < 8; $i++) { 
                          echo '<tr>';
                          echo '<td colspan="2" style="text-align: center; font-weight: bold">'.$i.'</td>';
                          foreach ($header as $key_subindex => $row_subindex) {
                              foreach($row_subindex as $key_pillar => $row_pillar){
                                foreach ($row_pillar as $key_indicator => $row_indicator) {
                                  # code...
                                  $getrow = isset($summary[$value_prov->id][$row_indicator->indicator_id])?$summary[$value_prov->id][$row_indicator->indicator_id]:'';
                                  $score_dt5 = isset($getrow->score5)?$getrow->score5:0;
                                  $count_num5 = isset($count5[$row_indicator->indicator_id][$i])?count($count5[$row_indicator->indicator_id][$i]):0;
                                  $color_code5 = $this->template->color_parameter($count_num5);
                                  echo '<td colspan="2" style="text-align: center; background: '.$color_code5.'; font-weight: bold">'.$count_num5.'</td>';
                                }
                              }
                          }
                          echo '</tr>';
                        }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>


              <div class="tab-pane fade" id="tab_skor_akhir" role="tabpanel" aria-labelledby="skor_akhir">
                <p style="font-weight: bold">SKOR PILAR</p>
                <div class="wrapper">
                  <table>
                    <thead>
                      <tr style="color: black !important">
                        <th rowspan="2" style="width: 20px !important">No</th>
                        <th rowspan="2">Provinsi</th>
                        <?php 
                          foreach ($header as $key_subindex => $row_subindex) {
                            $colspan = count($row_subindex);
                            echo '<th colspan="'.$colspan.'" style="background-color: #17345d; text-align: right; color: white">'.$key_subindex.'</th>';
                          }?>
                        <th rowspan="2" style="width: 120px">INDEX</th>
                      </tr>

                      <tr style="color: black !important">
                        <?php 
                          foreach ($header as $key_subindex => $row_subindex) {
                            foreach($row_subindex as $key_pillar => $row_pillar){
                              $colspan = count($row_pillar) * 1;
                              echo '<th align="center" class="rotated" style="background-color: #17345d; text-align: right; color: white">'.$key_pillar.'</th>';
                            }
                        }?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=0; foreach ($provinces as $key => $value_prov) : $no++?>
                        <tr>
                          <th scope="row"  style="background-color: goldenrod;text-align: center"><?php echo $no?></th>
                          <th scope="row"  style="background-color: goldenrod;"><?php echo $value_prov->name?></th>
                          <?php 
                          foreach ($header as $key_subindex => $row_subindex) {
                            foreach($row_subindex as $key_pillar => $row_pillar){
                              foreach ($row_pillar as $key_indicator => $row_indicator) {

                                # code...
                                $getrow = isset($summary[$value_prov->id][$row_indicator->indicator_id])?$summary[$value_prov->id][$row_indicator->indicator_id]:'';
                                $value_dt6 = isset($getrow->value)?$getrow->value:0;
                                $score_dt6 = isset($getrow->score)?$getrow->score:0;
                                
                                $count6[$row_indicator->indicator_id][round($score_dt6)][] = 1;
                                $arr_avg[$value_prov->id][] = $score_dt6;
                                $count_pillar[$value_prov->id][$key_pillar][] = $score_dt6;

                              }
                              $avg_pillar = array_sum($count_pillar[$value_prov->id][$key_pillar])/count($count_pillar[$value_prov->id][$key_pillar]);
                              $color_code6 = $this->template->color_parameter(round($avg_pillar));
                              echo '<td style="text-align: center; background: '.$color_code6.'; font-weight: bold">'.number_format($avg_pillar, 2).' </td>';
                            }
                          }
                          $avg = array_sum($arr_avg[$value_prov->id])/count($arr_avg[$value_prov->id]);
                          echo '<td style="text-align: center; font-weight: bold">'.number_format($avg, 2).'</td>';
                        
                        ?>
                        </tr>
                      <?php endforeach;?>
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="tab-pane fade" id="tab_ranking" role="tabpanel" aria-labelledby="ranking">
                <p style="font-weight: bold">SKOR INDEX</p>
                <div class="wrapper">
                  <table>
                    <thead>
                      <tr style="color: black !important">
                        <th style="width: 20px !important">NO</th>
                        <th>PROVINSI</th>
                        <?php 
                          foreach ($header as $key_subindex => $row_subindex) {
                            $colspan = count($row_subindex);
                            echo '<th style="max-width: 170px !important; text-align: center">'.strtoupper($key_subindex).'</th>';
                        }?>
                        <th style="width: 120px; text-align: center">INDEX</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no=0; foreach ($provinces as $key => $value_prov) : $no++?>
                        <tr>
                          <th scope="row"  style="background-color: goldenrod;text-align: center"><?php echo $no?></th>
                          <th scope="row"  style="background-color: goldenrod;"><?php echo $value_prov->name?></th>
                          <?php 
                          foreach ($header as $key_subindex => $row_subindex) {
                            foreach($row_subindex as $key_pillar => $row_pillar){
                              foreach ($row_pillar as $key_indicator => $row_indicator) {

                                # code...
                                $getrow = isset($summary[$value_prov->id][$row_indicator->indicator_id])?$summary[$value_prov->id][$row_indicator->indicator_id]:'';
                                $value_dt7 = isset($getrow->value)?$getrow->value:0;
                                $score_dt7 = isset($getrow->score)?$getrow->score:0;
                                
                                $count7[$row_indicator->indicator_id][round($score_dt7)][] = 1;
                                $arr_avg[$value_prov->id][] = $score_dt7;
                                $count_pillar[$key_pillar][] = $score_dt7;
                                $count_subindex[$value_prov->id][$key_subindex][$key_pillar][] = $score_dt7;
                                
                              }
                              $avg_subindex[$key_subindex][] = array_sum($count_subindex[$value_prov->id][$key_subindex][$key_pillar])/count($count_subindex[$value_prov->id][$key_subindex][$key_pillar]);
                            }
                            $avg_sub = array_sum($avg_subindex[$key_subindex])/count($avg_subindex[$key_subindex]);
                            $arr_avg_sub[$value_prov->id][] = $avg_sub;
                            $color_code7 = $this->template->color_parameter(round($avg_sub));
                            echo '<td style="text-align: center; background: '.$color_code7.'; font-weight: bold">'.number_format($avg_sub, 2).'</td>';

                          }
                          $avg = array_sum($arr_avg_sub[$value_prov->id])/count($arr_avg_sub[$value_prov->id]);
                          echo '<td style="text-align: center; font-weight: bold">'.number_format($avg, 2).'</td>';
                        
                        ?>
                        </tr>
                      <?php endforeach;?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

        </div>

        
        
        </div>
      </div>
      
    <!--end::Form-->
  </div>

  
</form>


<script src="<?php echo base_url()?>assets/landing/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url()?>assets/landing/js/jquery.easing.min.js"></script>
<script src="<?php echo base_url()?>assets/landing/js/scrollspy.min.js"></script>
<script src="<?php echo base_url()?>assets/landing/js/feather.min.js"></script>

<!-- app js -->
<script src="<?php echo base_url()?>assets/landing/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url()?>assets/landing/js/app.js"></script>

<script>
  $(document).ready(function() {
    $('#kt_pie_chart').load('<?php echo base_url()?>data/Tr_summary_dt/summary_pie_chart?_=' + (new Date()).getTime());
  });
</script>
