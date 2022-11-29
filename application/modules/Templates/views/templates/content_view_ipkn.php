<!DOCTYPE html>

<html lang="en">

	<!-- begin::Head -->
	<head>
		<base href="../../">
		<meta charset="utf-8" />
		<title>IPKN - Dashboard System</title>
		<meta name="description" content="Page with empty content">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!--begin::Fonts -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

		<!--end::Fonts -->

		<!--begin::Page Vendors Styles(used by this page) -->
		<link href="<?php echo base_url()?>assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Page Vendors Styles -->

		<!--begin::Global Theme Styles(used by all pages) -->
		<link href="<?php echo base_url()?>assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url()?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles -->

		<!--begin::Layout Skins(used by all pages) -->
		<link href="<?php echo base_url()?>assets/css/skins/header/base/light.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url()?>assets/css/skins/header/menu/light.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url()?>assets/css/skins/brand/dark.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url()?>assets/css/skins/aside/dark.css" rel="stylesheet" type="text/css" />

        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ttci-custom.css">

		<!-- Bootstrap core CSS -->
		<link rel="stylesheet" href="<?php echo base_url()?>assets/landing/css/bootstrap.min.css" type="text/css">

		<!-- Material Icon -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/landing/css/materialdesignicons.min.css" /><link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/landing/css/style.css" />


		<!--end::Layout Skins -->
		<link rel="shortcut icon" href="<?php echo base_url()?>assets/landing/images/parekraf-logo-color.png" />
	</head>

	<style>
		.table>thead tr.table-bg-blue {
			background: #17345d;
		}

		.modal-body table td{
			overflow-wrap: anywhere;
		}
	</style>
	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-footer--fixed kt-scrolltop--on kt-page--loading">

		<!-- begin:: Page -->

		<!-- begin:: Header Mobile -->
		<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
			<div class="kt-header-mobile__logo">
				<a href="#">
					<img alt="Logo" src="<?php echo base_url()?>assets/landing/images/parekraf-logo-color.png" style="max-width: 50px"/><br>
					
				</a>
			</div>
			<div class="kt-header-mobile__toolbar">
				<button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
				<!--<button class="kt-header-mobile__toggler" id="kt_header_mobile_toggler"><span></span></button>
				<button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>-->
			</div>
		</div>

		<!-- end:: Header Mobile -->
		<div class="kt-grid kt-grid--hor kt-grid--root">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

				<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside" >

					<!-- begin:: Aside -->
					<div class="kt-aside__brand kt-grid__item" id="kt_aside_brand" style="width: 100%">
						<div class="kt-aside__brand-logo justify-content-center" style="text-align: center; width:90%">
							<a href="#">
								<img alt="Logo" src="<?php echo base_url()?>assets/landing/images/parekraf-logo-color.png" height="70px">
							</a>
							<div style="padding-left: 10px; color: white !important">
								<div><span style="font-size: 35px;">IPKN</span></div>
								<div style="margin-top: -10px"><span>Home</span></div>
							</div>
						</div>
						<div class="kt-aside__brand-tools" style="width:10%">
							<button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler">
								<span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<polygon points="0 0 24 0 24 24 0 24" />
											<path d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z" fill="#000000" fill-rule="nonzero" transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) " />
											<path d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) " />
										</g>
									</svg></span>
								<span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
										<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
											<polygon points="0 0 24 0 24 24 0 24" />
											<path d="M12.2928955,6.70710318 C11.9023712,6.31657888 11.9023712,5.68341391 12.2928955,5.29288961 C12.6834198,4.90236532 13.3165848,4.90236532 13.7071091,5.29288961 L19.7071091,11.2928896 C20.085688,11.6714686 20.0989336,12.281055 19.7371564,12.675721 L14.2371564,18.675721 C13.863964,19.08284 13.2313966,19.1103429 12.8242777,18.7371505 C12.4171587,18.3639581 12.3896557,17.7313908 12.7628481,17.3242718 L17.6158645,12.0300721 L12.2928955,6.70710318 Z" fill="#000000" fill-rule="nonzero" />
											<path d="M3.70710678,15.7071068 C3.31658249,16.0976311 2.68341751,16.0976311 2.29289322,15.7071068 C1.90236893,15.3165825 1.90236893,14.6834175 2.29289322,14.2928932 L8.29289322,8.29289322 C8.67147216,7.91431428 9.28105859,7.90106866 9.67572463,8.26284586 L15.6757246,13.7628459 C16.0828436,14.1360383 16.1103465,14.7686056 15.7371541,15.1757246 C15.3639617,15.5828436 14.7313944,15.6103465 14.3242754,15.2371541 L9.03007575,10.3841378 L3.70710678,15.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" transform="translate(9.000003, 11.999999) rotate(-270.000000) translate(-9.000003, -11.999999) " />
										</g>
									</svg></span>
							</button>
						</div>
					</div>

					<!-- end:: Aside -->

					<!-- begin:: Aside Menu -->
					<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
						<div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1" data-ktmenu-dropdown-timeout="500">
						
							<ul class="kt-menu__nav ">
								<li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url().'dashboard'?>" class="kt-menu__link "><i class="kt-menu__link-icon fa fa-chart-bar"></i><span class="kt-menu__link-text">Dashboard IPKN</span></a></li>
								
								<?php foreach( $menu as $key=>$row_menu ) : ?>

								<li class="kt-menu__section">
									<h4 class="kt-menu__section-text"><?php echo $key; ?></h4>
									<i class="kt-menu__section-icon flaticon-more-v2"></i>
								</li>
								
									<?php 
										foreach( $row_menu as $value ) :
										$string_link = ''.$value['link'].'';
									?>
								
									<li class="kt-menu__item  <?php echo ( $value['link'] == '#' ) ? 'kt-menu__item--submenu' : '' ;?> " aria-haspopup="true" <?php echo ( $value['link'] == '#' ) ? 'data-ktmenu-submenu-toggle="hover"' : '' ;?> ><a href="javascript:;" <?php if( $value['link'] != '#' ){?> onclick="getMenu('<?php echo $value['link']?>')" <?php }?> class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-icon <?php echo $value['icon']?>"></i><span class="kt-menu__link-text"><?php echo $value['name']?></span><?php echo ( $value['link'] == '#' ) ? '<i class="kt-menu__ver-arrow la la-angle-right"></i>' : '' ;?> </a>
									<?php if( count($value['submenu']) != 0 ) : ?>
										<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
											<ul class="kt-menu__subnav">
												<li class="kt-menu__item  kt-menu__item--parent" aria-haspopup="true"><span class="kt-menu__link"><span class="kt-menu__link-text"><?php echo $value['name']?></span></span></li>
												<?php foreach($value['submenu'] as $row_sub_menu) : ?>
												<li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true" data-ktmenu-submenu-toggle="hover"><a href="javascript:;" onclick="getMenu('<?php echo $row_sub_menu['link']?>')" class="kt-menu__link kt-menu__toggle"><i class="kt-menu__link-bullet kt-menu__link-bullet--line"><span></span></i><span class="kt-menu__link-text"><?php echo $row_sub_menu['name']?></span></a></li>
												<?php endforeach; ?>
												
											</ul>
										</div>
									<?php endif; ?>
									</li>

									<?php endforeach; ?>
								<?php endforeach; ?>	
								<li class="kt-menu__item " aria-haspopup="true"><a href="<?php echo base_url().'login/logout'?>" class="kt-menu__link "><i class="kt-menu__link-icon flaticon-logout"></i><span class="kt-menu__link-text">Logout</span></a></li>					

							</ul>
						</div>
					</div>

					<!-- end:: Aside Menu -->
				</div>

				<!-- end:: Aside -->
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

					<!-- begin:: Header -->
					<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">

						<!-- begin:: Header Menu -->

						<div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
							<div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
								<ul class="kt-menu__nav ">
									<li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel kt-menu__item--active" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
										<marquee style="font-size: 14px">Selamat datang di Dashboard IPKN</marquee>
									</span>
									</li>
								</ul>
							</div>
						</div>

						<!-- end:: Header Menu -->

						<!-- begin:: Header Topbar -->
						<div class="kt-header__topbar">
							
							<div class="kt-header__topbar-item kt-header__topbar-item--quick-panel" data-toggle="kt-tooltip" title="" data-placement="right" data-original-title="Quick panel">
								<span class="kt-header__topbar-icon" id="kt_quick_panel_toggler_btn">
									<i class="fa fa-bell"></i>
								</span>
								<span class="badge-notification">
									<span id="badge-count-notif"></span>
								</span>
							</div>
							
							<!--begin: User Bar -->
							<div class="kt-header__topbar-item kt-header__topbar-item--user">
								<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
									<div class="kt-header__topbar-user">
										<span class="kt-header__topbar-welcome kt-hidden-mobile">Hi,</span>
										<span class="kt-header__topbar-username kt-hidden-mobile"><?php echo $this->session->userdata('user')->fullname?></span>
										<img class="kt-hidden" alt="Pic" src="<?php echo base_url()?>assets/media/users/300_25.jpg" />

										<!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
										<span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold"><?php echo substr($this->session->userdata('user')->fullname, 0,1)?></span>
									</div>
								</div>
								<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

									<!--begin: Head -->
									<!-- <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x" style="background-image: url(assets/media/misc/bg-1.jpg)">
										<div class="kt-user-card__avatar">
											<img class="kt-hidden" alt="Pic" src="<?php echo base_url()?>assets/media/users/300_25.jpg" />

											<span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold kt-font-success"><?php echo substr($this->session->userdata('user')->fullname, 0,1)?></span>
										</div>
										<div class="kt-user-card__name" style="color: orange">
											<?php echo $this->session->userdata('user')->fullname; ?>
										</div> 
										<div class="kt-user-card__badge">
											<span class="btn btn-success btn-sm btn-bold btn-font-md">23 messages</span>
										</div>
									</div> -->

									<!--end: Head -->

									<!--begin: Navigation -->
									<!-- <div class="kt-notification">
										<a href="#" class="kt-notification__item">
											<div class="kt-notification__item-icon">
												<i class="flaticon2-calendar-3 kt-font-success"></i>
											</div>
											<div class="kt-notification__item-details">
												<div class="kt-notification__item-title kt-font-bold">
													My Profile
												</div>
												<div class="kt-notification__item-time">
													Account settings and more
												</div>
											</div>
										</a>
										
										<div class="kt-notification__custom kt-space-between">
											<a href="<?php echo base_url().'login/logout'?>" class="btn btn-label btn-label-brand btn-sm btn-bold">Sign Out</a>
										</div>
									</div> -->

									<!--end: Navigation -->
								</div>
							</div>
							<!--end: User Bar -->
						</div>

						<!-- end:: Header Topbar -->
					</div>

					<!-- end:: Header -->
					<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

						<!-- begin:: Subheader -->
						<!-- <div class="kt-subheader   kt-grid__item" id="kt_subheader">
							<div class="kt-container  kt-container--fluid ">
								<div class="kt-subheader__main">
									<h3 class="kt-subheader__title">
										Dashboard </h3>
									<span class="kt-subheader__separator kt-hidden"></span>

									<div class="kt-subheader__breadcrumbs">
										<a href="#" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
										<span class="kt-subheader__breadcrumbs-separator"></span>
										<a href="" class="kt-subheader__breadcrumbs-link">
											Welcome to TTCI Dashboard </a>
									</div>
								</div>
								
							</div>
						</div> -->

						<!-- end:: Subheader -->

						<!-- begin:: Content -->
                        <!-- TODO : MAIN CONTENT IS HERE -->
						<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
							<div id="page-area-content">Content goes here... </div>
						</div>

						<!-- end:: Content -->
					</div>

					<!-- begin:: Footer -->
					
					<div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
						<div class="kt-container  kt-container--fluid ">
							<div class="kt-footer__copyright">
							<?php echo COPYRIGHT_YEAR; ?>&nbsp;&copy;&nbsp;<a href="http://kemenparekraf.go.id" target="_blank" class="kt-link">Kementerian Pariwisata dan Ekonomi Kreatif</a>
							</div>
							<!-- <div class="kt-footer__menu">
								<a href="http://kemenparekraf.go.id" target="_blank" class="kt-footer__menu-link kt-link">About</a>
								<a href="http://kemenparekraf.go.id" target="_blank" class="kt-footer__menu-link kt-link">Team</a>
								<a href="http://kemenparekraf.go.id" target="_blank" class="kt-footer__menu-link kt-link">Contact</a>
							</div> -->
						</div>
					</div>

					<!-- end:: Footer -->
				</div>
			</div>
		</div>

		<!-- end:: Page -->

		<!-- begin::Quick Panel -->
		<div id="kt_quick_panel" class="kt-quick-panel">
			<a href="#" class="kt-quick-panel__close" id="kt_quick_panel_close_btn"><i class="flaticon2-delete"></i></a>
			<div class="kt-quick-panel__nav">
				<ul class="nav nav-tabs nav-tabs-line nav-tabs-bold nav-tabs-line-3x nav-tabs-line-brand  kt-notification-item-padding-x" role="tablist">
					<li class="nav-item active">
						<a class="nav-link active" data-toggle="tab" href="#kt_quick_panel_tab_notifications" role="tab">Pengumuman</a>
					</li>
				</ul>
			</div>
			<div class="kt-quick-panel__content">
				<div class="tab-content">
					<div class="tab-pane fade show kt-scroll active" id="kt_quick_panel_tab_notifications" role="tabpanel">
						<div class="kt-notification">
							<div id="content-notification"></div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div id="globalModalViewMedium" class="modal fade" tabindex="-1">

			<div class="modal-dialog" style="margin-top: 50px; margin-bottom:50px;width:90%; background-color: white">

				<div class="modal-content">

				<div class="modal-header">

					<!-- <div class="table-header"> -->
					<span id="text_title_medium" style="font-weight: bold">TITLE</span>

					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">

						<span class="white">&times;</span>

					</button>

					

					<!-- </div> -->

				</div>

				<div class="modal-body" style="min-height: 400px !important">

					<div id="global_modal_content_detail_medium" style="background-color: white"></div>

				</div>

				</div><!-- /.modal-content -->

			</div><!-- /.modal-dialog -->

			</div>

		<!-- end::Quick Panel -->

		<!-- begin::Scrolltop -->
		<div id="kt_scrolltop" class="kt-scrolltop">
			<i class="fa fa-arrow-up"></i>
		</div>
		<!-- end::Scrolltop -->

		
		
		
		<!-- begin::Global Config(global config for global JS sciprts) -->
		<script>
			var KTAppOptions = {
				"colors": {
					"state": {
						"brand": "#5d78ff",
						"dark": "#282a3c",
						"light": "#ffffff",
						"primary": "#5867dd",
						"success": "#34bfa3",
						"info": "#36a3f7",
						"warning": "#ffb822",
						"danger": "#fd3995"
					},
					"base": {
						"label": [
							"#c5cbe3",
							"#a1a8c3",
							"#3d4465",
							"#3e4466"
						],
						"shape": [
							"#f0f3ff",
							"#d9dffa",
							"#afb4d4",
							"#646c9a"
						]
					}
				}
			};

			

		</script>

		<!-- end::Global Config -->

		<!--begin::Global Theme Bundle(used by all pages) -->
		<script src="<?php echo base_url()?>assets/plugins/global/plugins.bundle.js" type="text/javascript"></script>
		<script src="<?php echo base_url()?>assets/js/scripts.bundle.js" type="text/javascript"></script>
		<!--end::Global Theme Bundle -->
<!-- 		
		<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
        <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
        <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script> -->

		<!-- highchat modules -->
		<script src="<?php echo base_url()?>assets/js/chart/highcharts.js"></script>
		<script src="<?php echo base_url()?>assets/js/chart/highcharts-more.js"></script>
		<script src="<?php echo base_url()?>assets/js/chart/modules/exporting.js"></script>
		
		<!--begin::Page Scripts(used by this page) -->
		<script src="<?php echo base_url()?>assets/js/pages/dashboard.js" type="text/javascript"></script>
		
		<!-- custom js for global function -->
		<script src="<?php echo base_url()?>assets/js/custom/menu_load_page.js"></script>
		<script src="<?php echo base_url()?>assets/js/custom/global_func.js"></script>
		<!-- end custom js for global -->

		<script src="<?php echo base_url()?>assets/plugins/custom/datatables/datatables.bundle.js"></script>

		<link href="<?php echo base_url()?>assets/js/achtung/ui.achtung-mins.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/achtung/ui.achtung-min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/achtung/achtung.js"></script> 
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.form.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-validation/dist/jquery.validate.js"></script> 
		
		<!--end::Page Scripts -->
		<script>
			// reload page for notification
			$(document).ready(function(){
				$('#page-area-content').load('<?php echo base_url()?>dashboard/Dashboard_ipkn/chart?_=' + (new Date()).getTime());
				// reload_notification();	
				// setInterval(function() {
				// 	reload_notification();
                // }, 12000); 
			})

			function show_modal(url, title){  

			preventDefault();

			$.getJSON(url, '' , function (data) {
			$('#global_modal_content_detail_medium').html(data.html);
			})

			$('#text_title_medium').text(title);

			$("#globalModalViewMedium").modal();

			}

			// function reload_notification(){
			// 	$('#content-notification').load('<?php echo base_url()?>master_data/Mst_info/get_notification?_=' + (new Date()).getTime());
			// 	$.getJSON("<?php echo site_url('master_data/Mst_info/count_notification') ?>", '', function (response) {
			// 		$('#badge-count-notif').html('<span class="kt-badge kt-badge--info">'+response.count+'</span>');
			// 	});
				
			// }
		</script>
	</body>

	<!-- end::Body -->
</html>