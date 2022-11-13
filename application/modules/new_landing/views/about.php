
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VISIT - Visualisasi & Integrasi TTCI</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="NBS" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/new_landing/images/parekraf-logo-color.png') ?>">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/new_landing/css/bootstrap.min.css')?>" >

    <!-- Material Icon -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/new_landing/css/materialdesignicons.min.css')?>" />

    <!-- owl carousel -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/new_landing/css/owl.carousel.min.css')?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/new_landing/css/owl.theme.default.min.css')?>" />

    <!-- Custom  sCss -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/new_landing/css/style.css')?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/new-landing-custom.css')?>" />

</head>

<body>

<!--Navbar Start-->
<nav class="navbar navbar-expand-lg fixed-top navbar-custom sticky navbar-light sticky-dark">
    <div class="container">
        <!-- LOGO -->
        <a class="logo text-uppercase" href="<?= base_url('new_landing') ?>">
            <img src="<?php echo base_url()?>assets/new_landing/images/parekraf-logo-color.png" class="logo-light" alt="" height="60">
            <img src="<?php echo base_url()?>assets/new_landing/images/parekraf-logo-color.png" class="logo-dark" alt="" height="60">
            <span>Kementerian Pariwisata dan Ekonomi Kreatif/ Badan Pariwisata dan Ekonomi Kreatif, Republik Indonesia</span>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <i class="mdi mdi-menu"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto navbar-center" id="mySidenav">
                <li class="nav-item active">
                    <a href="#home" onclick="window.location = '<?= base_url() ?>'" class="nav-link">Beranda</a>
                </li>
                <li class="nav-item active">
                    <a href="#" onclick="window.location = '<?= base_url("about") ?>'" class="nav-link">Data TTCI</a>
                </li>
                <li class="nav-item active">
                    <a href="#download" onclick="window.location = '<?= base_url("new_landing/download") ?>'" class="nav-link">Download</a>
                </li>
            </ul>
            <button class="btn btn-success btn-rounded navbar-btn" onclick="window.location='<?= base_url('login')?>'">Login</button>

        </div>
    </div>
</nav>
<!-- Navbar End -->

<!-- Features start -->
<section class="section mt-5" id="report">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <h5 class="text-primary text-uppercase small-title">Report</h5>
                    <h4 class="mb-3">Travel & Tourism Competitiveness Index</h4>
                </div>
            </div>

            <div class="col-xl-12 mb-5">
                <div id="zoomable_radar_chart"></div>
                <div style="text-align: center;">
                    <span style="font-size: 11px">Note : Skenario dibuat berdasarkan data yang dikirim oleh masing-maing K/L dengan asumsi<br>data primer (EOS) tetap, serta data sekunder yang belum tersedia diasumsikan tetap</span>
                </div>
            </div>

            <div class="col-xl-12 my-2">
                <!-- <h4 class="font-weight-bold mb-3 text-center">Progres Input Data Kementerian/Lembaga</h4>
                <div class="row justify-content-lg-center">
                    <?php
                    $logo_urutan = -1;
                    foreach ($kementerian as $k_dt => $v_dt) :
                        $logo_kementerian = ['kementerian-perhubungan.png', 'kementerian-kesehatan.png', 'kementerian-komunikasi.png'];
                        if (in_array($v_dt->kl_id, array(11, 10, 16))) :
                            $progress_kl = $this->master->getProgressCurrent($v_dt->kl_id, $year_current);
                            $logo_urutan = $logo_urutan + 1;
                            ?>
                            <div class="col-lg-3 col-md-4 col-6 my-2">
                                <div class="list-ministry">
                                    <div class="list-ministry__image">
                                        <img src="<?php echo base_url('assets/landing/images/kementerian/'.$logo_kementerian[$logo_urutan]);?>" alt="<?php echo $v_dt->kl_name?>">
                                    </div>
                                    <div class="list-ministry__title"><?php echo $v_dt->kl_name?></div>
                                    <div class="list-ministry__progress">
                                        <div class="list-ministry__progress-count">
                                            <div class="list-ministry__progress-count-number"
                                                 style="width: <?php echo number_format($progress_kl, 2)?>%"></div>
                                        </div>
                                        <span><?php echo number_format($progress_kl, 2)?>%</span>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endif;
                    endforeach;
                    ?>
                </div> -->
                <!-- <form action="" class="filter-search">
                    <div class="form-group">
                        <label for="formKementrian">Kementrian</label>
                        <select name="kementrian" id="formKementrian" class="select-type">
                            <option value="">Pariwisata dan Ekonomi Kreatif</option>
                            <option value="">Agraria, Tata Ruang, dan Kehutanan</option>
                            <option value="">Perdagangan</option>
                            <option value="">Pendidikan dan Kebudayaan</option>
                            <option value="">Kesehatan</option>
                            <option value="">Komunikasi dan Informatika</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="formPillar">Pillar</label>
                        <select name="pillar" id="formPillar" class="select-type">
                            <option value="">Cultural resources and business travel</option>
                            <option value="">Natural resources</option>
                            <option value="">Tourist service infrastructure</option>
                            <option value="">Ground and port infrastructure</option>
                            <option value="">Air transport infrastructure</option>
                            <option value="">Environmental sustainability</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="formTahun">Tahun</label>
                        <select name="tahun" id="formTahun" class="select-type">
                            <option value="">2020</option>
                            <option value="">2019</option>
                            <option value="">2018</option>
                            <option value="">2017</option>
                            <option value="">2016</option>
                            <option value="">2015</option>
                        </select>
                    </div>
                    <button class="btn btn-primary">Filter</button>
                </form> -->
            </div>

            <div class="col-xl-12 mb-5">
                <table class="table">
                    <thead>
                    <tr class="table-bg-blue">
                        <th>Summary Travel &amp; Tourism Competitiveness Edition</th>
                        <th style="text-align: right">Year 2019</th>
                        <th style="text-align: right">Year <?php echo $year_current; ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td style="font-size: 16px; font-weight:bold">Overall</td>
                        <td style="text-align: right;"><?php echo $overall_score_last_year?></td>
                        <td style="text-align: right; font-size: 16px; font-weight: bold"><?php echo $overall_score?> &nbsp; <?php echo $sign; ?> </td>
                    </tr>
                    <tr>
                        <td>Ranking</td>
                        <td style="text-align: right;">
                        40/141 
                        <!-- <?php echo $this->master->getRanking($overall_score_last_year);?></td> -->
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
                        <td colspan="2" style="text-align: right"><span style="text-align: right; color: <?php echo $class_progress['color']?>; font-weight: bold;font-size: 18px"><?php echo number_format($progress['persentase_progress'], 2); ?> % </span> (<?php echo $progress['total_dt'].'/'.$total_sekunder?>) </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <!-- <div class="col-xl-12 mb-5">
                <div class="information-bg">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="ministryTable" class="information-label">Informasi</label>
                            <div id="ministryTable" class="information-content">Total progress pengisian data semua kementrian</div>
                        </div>
                        <div class="col-lg-6">
                            <label for="progressTable" class="information-label">Progress Pengisian Data</label>
                            <div id="progressTable" class="information-content d-flex align-items-center">
                                <div class="information-progress">
                                    <div class="progress-count"
                                        style="width: 80%">
                                    </div>
                                </div>
                                <span>
                                80%
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <div class="col-xl-12">
                <span style="font-size: 16px; font-weight: bold; color: #333; margin-bottom: 12px; display: block;">Detail Summary of Visit TTCI</span>

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
                        <td style="text-align: center"></td>
                        <td style="text-align: left; font-weight: bold; font-size: 16px">Travel & Tourism Competitiveness Index</td>
                        <td style="width:165px; text-align: right"><?php echo $overall_score_last_year?></td>
                        <td style="width:165px; text-align: right"><?php echo $overall_score?> &nbsp; <?php echo $sign; ?></td>
                        <td style="width:30px; text-align: right"><span class="table-view-dropdown"></span></td>
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

                        <tr class="view" style="background: #122b5254">
                            <td style="text-align: center"><?php echo $no?></td>
                            <td style="text-align: left"><?php echo ucwords($key_dt); ?></td>
                            <td style="width:165px; text-align: right"><?php echo number_format($last_score_index_dt, 2)?></td>
                            <td style="width:165px; text-align: right"><?php echo number_format($current_score_index_dt, 2)?> <?php echo $sign_index; ?></td>
                            <td style="width:30px; text-align: right"><span class="table-view-dropdown"></span></td>
                        </tr>

                        <?php
                        foreach($row_dt as $key_row_dt => $val_row_dt) :
                            $last_score_pillar = array_sum($last_score[$key_row_dt]) / count($last_score[$key_row_dt]);
                            $current_score_pillar = array_sum($current_score[$key_row_dt]) / count($current_score[$key_row_dt]);
                            $sign = $this->master->getSignScore($current_score_pillar, $last_score_pillar);
                            ?>

                            <tr class="view">
                                <td style="text-align: center"></td>
                                <td style="text-align: left">
                                    <span class="table-view-dropdown"></span>
                                    <?php $icon = (!empty($val_row_dt[0]['icon']))?'<img src="'.base_url().'uploaded/images/'.$val_row_dt[0]['icon'].'" width="40px">':''; echo $icon;?>
                                    <?php echo ucwords($key_row_dt); ?></td>
                                <td style="width:165px; text-align: right"><?php echo number_format($last_score_pillar, 2)?></td>
                                <td style="width:165px; text-align: right"><?php echo number_format($current_score_pillar, 2)?> <?php echo $sign; ?></td>
                                <td style="width:30px; text-align: right"><span class="table-view-dropdown"></span></td>
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
                                                    <td style="width: 60px"><a class="info" style="cursor:pointer !important" onclick="show_modal('<?php echo base_url()?>landing/Landing/modal_information/subpillar/<?php echo $row_ln['subpillar_id']?>', 'Information')" >
                                                            <i class="fa fa-info"></i>
                                                        </a></td>
                                                    <td style="text-align: left;"><?php echo ucwords($row_ln['subpillar_desc']); ?></td>
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
            </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</section>
<!-- Features end -->

<!-- Cta start -->
<!-- Cta end -->

<!-- Footer start -->
<footer id="footer">
    <div class="footer-main">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="logo">
                        <img src="<?= base_url('assets/new_landing/images/logo-footer.png') ?>" alt="TTCI">
                    </div>
                    <p>Kementerian Pariwisata dan Ekonomi Kreatif/Badan Pariwisata dan Ekonomi Kreatif merupakan Lembaga Pemerintah yang memiliki tugas menyelenggarakan urusan pemerintahan di bidang kepariwisataan  dan di bidang ekonomi kreatif untuk membantu Presiden dalam menyelenggarakan pemerintahan negara.</p>
                </div>
                <div class="offset-3">
                </div>
                <div class="col-md-5">
                    <h4 class="footer-header">Hubungi Kami</h4>
                    <div class="footer-title">Alamat</div>
                    <p>Sapta Pesona building, Jl. Medan Merdeka Barat No.17, RT.2/RW.3, Gambir, Kecamatan Gambir, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10110</p>
                    <ul class="footer-social">
                        <li>
                            <a href="https://www.instagram.com/kemenparekraf.ri" class="footer-social-instagram"><i class="fab fa-instagram"></i></a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/ParekrafRI/" class="footer-social-facebook"><i class="fab fa-facebook-f"></i></a>
                        </li>
                        <li>
                            <a href="https://twitter.com/Kemenparekraf" class="footer-social-twitter"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/channel/UClm8VHUZQnhFmIndX6oLgJA" class="footer-social-youtube"><i class="fab fa-youtube"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>

<button id="backToTop" class="backToTop-hidden"><span class="mdi mdi-chevron-up"></span></button>
<!-- Footer alt start -->
<!-- Footer alt start -->

<!-- Javascript -->
<script src="<?= base_url('assets/new_landing/js/jquery.min.js') ?>"></script>
<!---->

<!-- arm chart -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<script src="<?php echo base_url('assets/js/chart/highcharts.js')?>"></script>
<script src="<?php echo base_url('assets/js/chart/highcharts-more.js')?>"></script>
<script src="<?php echo base_url('assets/js/chart/modules/exporting.js')?>"></script>

<script src="<?= base_url('assets/new_landing/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/new_landing/js/jquery.easing.min.js') ?>"></script>
<script src="<?= base_url('assets/new_landing/js/scrollspy.min.js') ?>"></script>
<script src="<?= base_url('assets/new_landing/js/feather.min.js') ?>"></script>
<!---->
<!-- owl carousel -->
<script src="<?= base_url('assets/new_landing/js/owl.carousel.min.js') ?>"></script>
<script src="<?php echo base_url('assets/landing/js/select2.min.js')?>"></script>
<script src="<?php echo base_url('assets/landing/js/scrollspy.min.js')?>"></script>

<script>
    $(document).ready(function() {
        $('#zoomable_radar_chart').load('<?php echo base_url()?>landing/Landing/zoomable_radar_chart?_=' + (new Date()).getTime());
    });
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

<script src="<?= base_url('assets/new_landing/js/app.js') ?>"></script>

</body>

</html>