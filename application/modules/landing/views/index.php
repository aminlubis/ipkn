
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
        <link rel="shortcut icon" href="<?php echo base_url()?>assets/landing/images/favicon.ico">

        <link href="<?php echo base_url()?>assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
        <!--begin::Global Theme Styles(used by all pages) -->
		<link href="<?php echo base_url()?>assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url()?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="<?php echo base_url()?>assets/landing/css/bootstrap.min.css" type="text/css">

        <!-- Material Icon -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/landing/css/materialdesignicons.min.css" />

        <!-- Plugin -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/landing/css/owl.carousel.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/landing/css/owl.theme.default.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/landing/css/select2.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/landing/css/select2-bootstrap4.min.css">

        <!-- Custom  sCss -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/landing/css/style.css" />

        <style>
            #chartdiv {
                width: 100%;
                height: 500px;
                overflow: hidden;
            }
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

    </head>

    <body>

        <!--Navbar Start-->
        <nav class="navbar navbar-expand-lg fixed-top navbar-custom sticky sticky-dark">
            <div class="container">
                <!-- LOGO -->
                <a class="logo text-uppercase" href="#">
                    <img src="<?php echo base_url()?>assets/landing/images/logo-light.png" class="logo-dark" alt="" height="60">
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ml-auto navbar-center" id="mySidenav">
                        <li class="nav-item active">
                            <a href="#home" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="#about" class="nav-link">About</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="#faq" class="nav-link">FAQ</a>
                        </li> -->
                        <li class="nav-item">
                            <a href="#download" class="nav-link" onclick="window.location='<?php echo base_url().'download'?>'">Download</a>
                        </li>
                    </ul>
                    <button class="btn btn-success btn-rounded navbar-btn" onclick="window.location='<?php echo base_url().'login'?>'">Login</button>
                </div>
            </div>
        </nav>
        <!-- Navbar End -->

        
        <!-- Hero section Start -->
        <section class="hero-section-5" id="home"  style="background-image: url(<?php echo base_url()?>assets/new_landing/images/image-banner.jpg);">
            <div class="container">
                <div class="row justify-content-start">
                    <div class="col-lg-8">
                        <div class="hero-wrapper  mb-4">
                            <p class="font-16 text-uppercase text-white">VISIT TTCI </p>
                            <h1 class="hero-title text-white mb-4">Visualization and Integration</h1>
                            <p class="text-white">Travel and Tourism Competitiveness Index</p>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
        </section>
        <!-- Hero section End -->

        <!-- Features start -->
        <section class="section" id="report">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center mb-5">
                            <h5 class="text-primary text-uppercase small-title">Report</h5>
                            <h4 class="mb-3">Travel & Tourism Competitiveness Index</h4>
                        </div>
                    </div>

                    <div class="col-xl-12 mb-5">
                        <!-- <div id="chartdiv"></div> -->
                        <div id="zoomable_radar_chart"></div>
                        <div style="text-align: center;">
                            <span style="font-size: 11px">Note : Skenario dibuat berdasarkan data yang dikirim oleh masing-maing K/L dengan asumsi<br>data primer (EOS) tetap, serta data sekunder yang belum tersedia diasumsikan tetap</span>
                        </div>
                    </div>

                    <div class="col-xl-12 my-2">
                        <h4 class="font-weight-bold mb-3 text-center">Progres Input Data Kementerian/Lembaga</h4>
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
                        </div>
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
                    <?php
                        $sign_rank = $this->master->getSignScore($this->master->getRanking($overall_score), $this->master->getRanking($overall_score_last_year));
                        
                    ?>
                    <div class="col-xl-12 mb-5">  
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
                                    <td style="text-align: right;"><?php echo number_format($score_rank, 2)?></td>
                                    <td style="text-align: right; font-size: 16px; font-weight: bold"><?php echo number_format($score_rank_current, 2)?> &nbsp; <?php echo $sign; ?> </td>
                                </tr>
                                <tr>
                                    <td>Country Ranking</td>
                                    <td style="text-align: right;">
                                        <?php echo $this->master->getRanking($score_rank);?>
                                    </td>
                                    <td style="text-align: right; font-size: 16px; font-weight: bold">
                                        <?php 
                                            // if($kl==''){
                                                echo $this->master->getRanking($score_rank_current);
                                                $sign_rank = $this->master->getSignScore($this->master->getRanking($score_rank_current), $this->master->getRanking($score_rank));
                                                echo '&nbsp; '.$sign_rank;
                                            // }
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
                                    <td style="width:165px; text-align: right"><?php echo number_format($score_rank, 2)?></td>
                                    <td style="width:165px; text-align: right"><?php echo number_format($score_rank_current, 2)?> &nbsp; <?php echo $sign; ?></td>
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
                                    <td style="text-align: center">
                                        <!-- <a class="info" data-toggle="modal" data-target="#exampleModal">
                                            <i class="fa fa-info"></i>
                                        </a> -->
                                    </td>
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
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
        <!-- Features end -->

        <!-- About start -->
        <section class="section bg-primary-gradient" id="about">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center mb-5">
                            <!-- <h5 class="text-white text-uppercase small-title">About VISIT TTCI?</h5> -->
                            <h4 class="mb-3">About VISIT TTCI?</h4>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-lg-12">
                        <p><strong>VISIT TTCI merupakan singkatan dari &ldquo;Visualisasi dan Integrasi&rdquo; TTCI (Travel and Tourism Competitiveness Index).</strong></p>
                        <p>Visualisasi menurut Kamus Besar Bahasa Indonesia adalah pengungkapan suatu gagasan atau perasaan dengan menggunakan bentuk gambar, tulisan (kata dan angka), peta, grafik, dan sebagainya. Integrasi menurut Kamus Besar Bahasa Indonesia adalah pembauran hingga menjadi kesatuan yang utuh atau bulat, pembauran dengan pihak atau badan yang sederajat, penyesuaian perbedaan tingkah laku warga suatu kelompok bersangkutan.</p>
                        <p>TTCI (Travel and Tourism Competitiveness Index) adalah Indeks Daya Saing Pariwisata yang dirilis oleh World Economic Forum (WEF). Penilaian TTCI dikeluarkan oleh WEF dua tahun sekali kepada 140 negara di dunia. Penilaian TTCI dilakukan dengan menggunakan data 19 Kementerian/Lembaga di Indonesia sehingga sangat penting untuk diintegrasikan dan tersistem dengan baik.</p>
                        <p>VISIT TTCI adalah mekanisme pengelolaan TTCI yang terintegrasi dan tersistem yang diwadahi dalam bentuk Gugus Tugas lintas Kementerian/Lembaga yang dilembagakan melalui Peraturan Menteri Pariwisata dan Ekonomi Kreatif/ Kepala Badan Pariwisata dan Ekonomi Kreatif.&nbsp; Gugus Tugas TTCI difasilitasi dengan Dashboard TTCI sebagai sarana untuk memvisualisasikan data, selain juga memonitor dan mengevaluasi data penanganan TTCI dari berbagai K/L sehingga progress akan lebih terkendali/terkontrol. Gugus tugas tersebut terdiri dari 19 kementerian/lembaga yang terkait dengan indikator TTCI, sedangkan Dashboard TTCI adalah sarana kerja gugus tugas secara online untuk memfasilitasi penyampaian/input dan visualisasi data/informasi. </p>
                        <p>Visit TTCI sangat penting untuk dibangun sebagai solusi pengelolaan TTCI di Kemenparekraf/Baparekraf yang tanggungjawab penanganannya berada dibawah Direktorat Manajemen Strategis Deputi Kebijakan Strategis. Melalui Gugus Tugas dan Dashboard TTCI, nantinya koordinasi TTCI akan terintegrasi&nbsp; dan tersistem&nbsp; karena tanggung jawab pengelolaannya akan terdistribusi ke 19 Kementerian/Lembaga terkait sesuai tugas dan kewenangan masing-masing sehingga penanganan untuk meningkatkan peringkat Indonesia akan lebih maksimal.</p>
                        <p>Hal yang akan dilakukan dalam VISIT TTCI ini adalah mengintegrasikan pengelolaan dan penanganan TTCI kedalam gugus tugas lintas K/L, serta memperbaiki cara pengumpulan data lintas K/L melalui teknologi informasi. VISIT TTCI menjadi sangat strategis karena didalamnya merupakan bentuk kolaborasi dan integrasi lintas K/L dengan tujuan bersama yaitu meningkatkan peringkat TTCI Indonesia.</p>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
        <!-- About end -->

        <!-- FAQ start -->
        <!-- <section class="section" id="faq">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center mb-5">
                            <h5 class="text-primary text-uppercase small-title">FAQ</h5>
                            <h4 class="mb-3">Pertanyaan umum seputar VISIT</h4>
                        </div>
                    </div>

                    <div class="col-xl-8 col-lg-10">
                        <div class="accordion" id="accordionFAQ">
                            <div class="card">
                                <div class="card-header" id="heading-1">
                                    <h2 class="mb-0">
                                        <button style="padding: 10px" class="btn btn-accordion btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                                            Apa itu VISI?
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapse-1" class="collapse show" aria-labelledby="heading-1" data-parent="#accordionFAQ">
                                    <div class="card-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="heading-2">
                                    <h2 class="mb-0">
                                        <button style="padding: 10px" class="btn btn-accordion btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-2" aria-expanded="false" aria-controls="collapse-2">
                                            Tujuan VISIT?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapse-2" class="collapse" aria-labelledby="heading-2" data-parent="#accordionFAQ">
                                    <div class="card-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header" id="heading-3">
                                    <h2 class="mb-0">
                                        <button style="padding: 10px" class="btn btn-accordion btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
                                            Apa yang ditampilkan di VISIT?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapse-3" class="collapse" aria-labelledby="heading-3" data-parent="#accordionFAQ">
                                    <div class="card-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header" id="heading-4">
                                    <h2 class="mb-0">
                                        <button style="padding: 10px" class="btn btn-accordion btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                                            Siapa pengguna data VISIT?
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapse-4" class="collapse" aria-labelledby="heading-4" data-parent="#accordionPengguna">
                                    <div class="card-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- FAQ end -->

        <!-- Download start -->
<!--        <section class="section bg-light" id="download">-->
<!--            <div class="container">-->
<!--                <div class="row justify-content-center">-->
<!--                    <div class="col-lg-12">-->
<!--                        <div class="mb-5">-->
<!--                            <h5 class="text-uppercase small-title">Download</h5>-->
<!--                            <h4 class="mb-3">Lampiran Dokumen</h4>-->
<!--                        </div>-->
<!--                        <div class="row">-->
<!--                            <div class="col-lg-3 col-md-6 col-12">-->
<!--                                <a class="list-download" target="_blank" href="--><?php //echo base_url()?><!--uploaded/files/TTCR_2015.pdf" title="TTCR_2015.pdf">Dokumen TTCR 2015</a>-->
<!--                            </div>-->
<!--                            <div class="col-lg-3 col-md-6 col-12">-->
<!--                                <a class="list-download" target="_blank" href="--><?php //echo base_url()?><!--uploaded/files/TTCR_2017.pdf" title="TTCR_2017.pdf">Dokumen TTCR 2017</a>-->
<!--                            </div>-->
<!--                            <div class="col-lg-3 col-md-6 col-12">-->
<!--                                <a class="list-download" target="_blank" href="--><?php //echo base_url()?><!--uploaded/files/TTCR_2019.pdf" title="TTCR_2019.pdf">Dokumen TTCR 2019</a>-->
<!--                            </div>-->
<!--                            <div class="col-lg-3 col-md-6 col-12">-->
<!--                                <a class="list-download" target="_blank" href="--><?php //echo base_url()?><!--uploaded/files/TTCR-METHODOLOGY.pdf" title="TTCR-METHODOLOGY.pdf">TTCR METHODOLOGY</a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--                end row -->
<!--            </div>-->
<!--            end container -->
<!--        </section>-->
        <!-- Download end -->


        <!-- Footer alt start -->
        <section class="ttci-footer" id="download">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8 text-left">
                        <p class="copyright-desc mb-0">2020 © VISIT - Visualisasi & Integrasi TTCI</p>
                        <p class="ttci-footer-desc">Situs ini dikelola oleh Kementerian Pariwisata dan Ekonomi Kreatif/Badan Pariwisata dan Ekonomi Kreatif Republik Indonesia. Semua data yang tercantum di dalam situs ini bertujuan untuk memberikan informasi Indeks Daya Saing Pariwisata Indonesia yang dirilis oleh World Economic Forum (WEF)</p>
                    </div>
                    <div class="col-lg-4">
                        <div class="ttci-footer__sosmed">
                            <ul>
                                <li>
                                    <a href="https://www.facebook.com/ParekrafRI/" target="_blank"><span class="mdi mdi-facebook"></span></a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/Kemenparekraf" target="_blank"><span class="mdi mdi-twitter"></span></a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/kemenparekraf.ri/" target="_blank"><span class="mdi mdi-instagram"></span></a>
                                </li>
                                <li>
                                    <a href="https://www.youtube.com/channel/UClm8VHUZQnhFmIndX6oLgJA" target="_blank"><span class="mdi mdi-youtube"></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
        <!-- Footer alt start -->

        <!-- BACK TO TOP -->
        <button id="backToTop" class="backToTop-hidden"><span class="mdi mdi-chevron-up"></span></button>
        <!-- BACK TO TOP END -->

        <!-- Javascript -->
        <script src="<?php echo base_url()?>assets/landing/js/jquery.min.js"></script>
        
        <!-- arm chart -->
        <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
        <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
        <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>


        <script src="<?php echo base_url()?>assets/js/chart/highcharts.js"></script>
        <script src="<?php echo base_url()?>assets/js/chart/highcharts-more.js"></script>
        <script src="<?php echo base_url()?>assets/js/chart/modules/exporting.js"></script>
        
        <script src="<?php echo base_url()?>assets/landing/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url()?>assets/landing/js/jquery.easing.min.js"></script>
        <script src="<?php echo base_url()?>assets/landing/js/scrollspy.min.js"></script>
        <script src="<?php echo base_url()?>assets/landing/js/feather.min.js"></script>

        <!-- Plugin -->
        <script src="<?php echo base_url()?>assets/landing/js/owl.carousel.min.js"></script>
        <script src="<?php echo base_url()?>assets/landing/js/select2.min.js"></script>
                
        <script>
            $(document).ready(function() {
                $('#chartdiv').load('<?php echo base_url()?>landing/Landing/chart_global?_=' + (new Date()).getTime());
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
        
        <!-- app js -->
        <script src="<?php echo base_url()?>assets/landing/js/app.js"></script>

    </body>

</html>