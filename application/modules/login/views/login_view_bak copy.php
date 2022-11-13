<!DOCTYPE html>

<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>TTCI - Dashboard System</title>
		<meta name="description" content="Support center faq example">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!--begin::Page Custom Styles(used by this page) -->
		<link href="<?php echo base_url()?>assets/css/pages/support-center/faq-1.css" rel="stylesheet" type="text/css" />

		<!--end::Page Custom Styles -->

		<!--begin::Global Theme Styles(used by all pages) -->
		<link href="<?php echo base_url()?>assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url()?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" />

		<!--end::Global Theme Styles -->

		<!--begin::Layout Skins(used by all pages) -->
		<!-- <link href="<?php echo base_url()?>assets/css/skins/header/base/light.css" rel="stylesheet" type="text/css" /> -->
		<!-- <link href="<?php echo base_url()?>assets/css/skins/header/menu/light.css" rel="stylesheet" type="text/css" /> -->

		<!--end::Layout Skins -->
		<link rel="shortcut icon" href="<?php echo base_url()?>assets/media/logos/favicon.ico" />
	</head>

	<!-- end::Head -->
	<style>
		.kt-aside--fixed .kt-wrapper{
			padding-left: 10px !important;
			padding-top: 0px !important;
		}

	</style>
	<!-- begin::Body -->
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-aside--enabled kt-aside--fixed kt-page--loading">

		<!-- begin:: Page -->

		<!-- begin:: Header Mobile -->
		<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
			<div class="kt-header-mobile__logo">
				<a href="index.html">
					<img alt="Logo" src="<?php echo base_url()?>assets/media/logos/logo-parekraf.png" style="max-width: 40px"/>
				</a>
			</div>
			<div class="kt-header-mobile__toolbar">
				<button class="kt-header-mobile__toggler" id="kt_header_mobile_toggler"><span></span></button>
				<button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
			</div>
		</div>

		<!-- end:: Header Mobile -->
		<div class="kt-grid kt-grid--hor kt-grid--root">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">

				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">

					<!-- begin:: Header -->
					<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed " style="left: 0px !important">

						<!-- begin:: Header Menu -->
						<div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
							<div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
								<!-- <img src="<?php echo base_url()?>assets/media/logos/logo-parekraf.png" style="width:65px; padding: 5px">
								<span style="font-size:18px;">Kementerian Pariwisata dan Ekonomi Kreatif</span> -->
							</div>
						</div>

						<!-- end:: Header Menu -->

						<!-- begin:: Header Topbar -->
						<div class="kt-header__topbar">

							<!--begin: User Bar -->
							<div class="kt-header__topbar-item kt-header__topbar-item--user">
								<div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
									<div class="kt-header__topbar-user" style="background: #0b274f;">
										<span class="kt-header__topbar-welcome kt-hidden-mobile">Hi,</span>
										<span class="kt-header__topbar-username kt-hidden-mobile">Please Login <a href="#"> &nbsp;Here</a></span>
										<img class="kt-hidden" alt="Pic" src="assets/media/users/300_25.jpg" />

										<!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
										<span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold" id="kt_quick_panel_toggler_btn" title="Login">L</span>
									</div>
								</div>
								<div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">

								</div>
							</div>

							<!--end: User Bar -->
						</div>

						<!-- end:: Header Topbar -->
					</div>

					<!-- end:: Header -->
					<div class="kt-content  kt-content--fit-top " id="kt_content">

						<!-- begin:: Content -->

						<!-- begin:: Hero -->
						<div class="kt-sc-faq" style="background-image: url('<?php echo base_url()?>assets/media/bg/12.jpg')">
							<div class="kt-container ">
								<div class="kt-sc__top">
									<h3 class="kt-sc__title" style="margin-top:-70px">
										<img src="<?php echo base_url()?>assets/media/logos/logo-parekraf.png" width="80px">
										<span style="width:100px !important">Kementerian Pariwisata dan Ekonomi Kreatif</span>
									</h3>
								</div>
							</div>
						</div>

						<!-- end:: Hero -->
						<div class="kt-negative-spacing--7"></div>

						<!-- begin:: Section -->
						<div class="kt-container ">
							<div class="kt-portlet">
								<div class="kt-portlet__body">
									<span style="font-size: 18px">Travel & Tourism Competitiveness Index</span>
									<table id="summary-dt-table" class="table table-responsive-sm table-striped- table-bordered table-hover table-checkable dataTable no-footer dtr-inline">
										<thead>
											<tr>  
											<th width="50px" class="center"></th>
											<th width="40px" class="center"></th>
											<th width="40px" class="center"></th>
											<th>Pillar</th>
											<th>Subpillar</th>
											<th style="text-align: center">Value<br><?php echo date('Y')-1?></th>
											<th style="text-align: center">Value<br><?php echo date('Y')?></th>
											<th>Score</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>

								</div>
							</div>
						</div>

						<!-- end:: Section -->

						<!-- begin:: Section -->
						<div class="kt-container ">
							<div class="row">
								<div class="col-lg-4">
									<a href="#" class="kt-portlet kt-iconbox kt-iconbox--animate-slow">
										<div class="kt-portlet__body">
											<div class="kt-iconbox__body">
												<div class="kt-iconbox__icon">
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24" />
															<path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" fill="#000000" opacity="0.3" />
															<path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" fill="#000000" />
														</g>
													</svg> </div>
												<div class="kt-iconbox__desc">
													<h3 class="kt-iconbox__title">
														Getting Started
													</h3>
													<div class="kt-iconbox__content">
														Windows 10 automatically downloads and installs updates.
													</div>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="col-lg-4">
									<a href="#" class="kt-portlet kt-iconbox kt-iconbox--animate">
										<div class="kt-portlet__body">
											<div class="kt-iconbox__body">
												<div class="kt-iconbox__icon">
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<rect x="0" y="0" width="24" height="24" />
															<path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3" />
															<path d="M10.875,15.75 C10.6354167,15.75 10.3958333,15.6541667 10.2041667,15.4625 L8.2875,13.5458333 C7.90416667,13.1625 7.90416667,12.5875 8.2875,12.2041667 C8.67083333,11.8208333 9.29375,11.8208333 9.62916667,12.2041667 L10.875,13.45 L14.0375,10.2875 C14.4208333,9.90416667 14.9958333,9.90416667 15.3791667,10.2875 C15.7625,10.6708333 15.7625,11.2458333 15.3791667,11.6291667 L11.5458333,15.4625 C11.3541667,15.6541667 11.1145833,15.75 10.875,15.75 Z" fill="#000000" />
															<path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000" />
														</g>
													</svg> </div>
												<div class="kt-iconbox__desc">
													<h3 class="kt-iconbox__title">
														Tutorials
													</h3>
													<div class="kt-iconbox__content">
														Windows 10 automatically downloads and installs updates.
													</div>
												</div>
											</div>
										</div>
									</a>
								</div>
								<div class="col-lg-4">
									<a href="#" class="kt-portlet kt-iconbox kt-iconbox--animate-slower">
										<div class="kt-portlet__body">
											<div class="kt-iconbox__body">
												<div class="kt-iconbox__icon">
													<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
														<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
															<polygon points="0 0 24 0 24 24 0 24" />
															<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
															<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
														</g>
													</svg> </div>
												<div class="kt-iconbox__desc">
													<h3 class="kt-iconbox__title">
														User Guide
													</h3>
													<div class="kt-iconbox__content">
														Windows 10 automatically downloads and installs updates.
													</div>
												</div>
											</div>
										</div>
									</a>
								</div>
							</div>
						</div>

						<!-- end:: Section -->

						<!-- end:: Content -->
					</div>

					<!-- begin:: Footer -->
					<div class="kt-footer  kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" id="kt_footer">
						<div class="kt-container  kt-container--fluid ">
							<div class="kt-footer__copyright">
								2020&nbsp;&copy;&nbsp;<a href="http://keenthemes.com/metronic" target="_blank" class="kt-link">Keenthemes</a>
							</div>
							<div class="kt-footer__menu">
								<a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">About</a>
								<a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">Team</a>
								<a href="http://keenthemes.com/metronic" target="_blank" class="kt-footer__menu-link kt-link">Contact</a>
							</div>
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
						<a class="nav-link active" data-toggle="tab" href="#kt_quick_panel_tab_notifications" role="tab">Form Login</a>
					</li>
				</ul>
			</div>
			<div class="kt-quick-panel__content">
				<center>
				<div class="kt-grid__item kt-grid__item--fluid  kt-grid__item--order-tablet-and-mobile-1  kt-login__wrapper" style="padding: 20px">

					<!--begin::Body-->
					<div class="kt-login__body">
						
						
						<!--begin::Signin-->
						<div class="kt-login__form">
							

							<div class="kt-login__title">
								<a href="#" class="kt-login__logo">
									<img src="<?php echo base_url()?>assets/media/logos/logo-parekraf.png" style="max-width:100px">
								</a><br>
								<span style="font-size: 20px">TTCI DASHBOARD SYSTEM</span><br>
								<span>Travel & Tourism Competitiveness Index</span>
							</div>

							<!--begin::Form-->
							<form class="kt-form" action="<?php echo base_url().'login/process'?>" id="form-login" method="post">
								<span>FORM LOGIN</span>
								<div class="form-group">
									<input class="form-control" type="text" placeholder="Username" name="username" autocomplete="off">
								</div>
								<div class="form-group">
									<input class="form-control" type="password" placeholder="Password" name="password" autocomplete="off">
								</div>

								<!--begin::Action-->
								<div class="kt-login__actions">
									<button id="kt_login_signin_submit" class="btn btn-pill kt-login__btn-primary" style="background: #f9a606">Sign In</button>
								</div>

								<!--end::Action-->
							</form>

							<!--end::Form-->

						</div>

						<!--end::Signin-->
					</div>

					<!--end::Body-->
				</div>
				</center>
				
			</div>
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
		
		<script src="<?php echo base_url()?>assets/plugins/custom/datatables/datatables.bundle.js"></script>
		
		<link href="<?php echo base_url()?>assets/js/achtung/ui.achtung-mins.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/achtung/ui.achtung-min.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/achtung/achtung.js"></script> 
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.form.js"></script>
		<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery-validation/dist/jquery.validate.js"></script> 

		<!--end::Global Theme Bundle -->
		<script>
			
			$(document).ready(function() {
    
				//initiate dataTables plugin
				oTable = $('#summary-dt-table').DataTable({ 
					
					"processing": true, //Feature control the processing indicator.
					"serverSide": true, //Feature control DataTables' server-side processing mode.
					"ordering": false,
					"searching": false,
					"paging": false,
					"bFilter": false,
					
					// Load data for the table's content from an Ajax source
					"ajax": {
						"url": '<?php echo base_url()?>data/Tr_summary_dt_public/get_data',
						"type": "POST"
					},
					"columnDefs": [
						{ 
							"targets": [ 0 ], //last column
							"orderable": false, //set not orderable
						},
						{ "aTargets" : [ 0 ], "mData" : 1, "sClass":  "details-control"}, 
						{ "visible": true, "targets": [ 0 ] },
						{ "targets": [ 0,1 ], "visible": false },
					],

				});

				$('#summary-dt-table tbody').on('click', 'td.details-control', function () {
					var url_detail = '<?php echo base_url()?>data/Tr_summary_dt_public/show_detail';
					var tr = $(this).closest('tr');
					var row = oTable.row( tr );
					var data = oTable.row( $(this).parents('tr') ).data();
					var kode_primary = data[ 0 ];                  
					console.log(data);
					if ( row.child.isShown() ) {
						// This row is already open - close it
						row.child.hide();
						tr.removeClass('shown');
					}
					else {
						/*data*/            
						$.getJSON( url_detail + "/" + kode_primary , '' , function (data) {
							response_data = data;
							// Open this row
							row.child( format_html( response_data ) ).show();
							tr.addClass('shown');
						});
					}
					
				} );

				$('#summary-dt-table tbody').on( 'click', 'tr', function () {
					if ( $(this).hasClass('selected') ) {
						$(this).removeClass('selected');
					}
					else {
						oTable.$('tr.selected').removeClass('selected');
						$(this).addClass('selected');
					}
				} );
				
			});

			$('document').ready(function() {  

				/*========== PROCESS LOGIN ================*/
				$("#form-login").validate({focusInvalid:true});  
				
				$( "#username" )
				.keypress(function(event) {
					var keycode =(event.keyCode?event.keyCode:event.which); 
					if(keycode ==13){
					event.preventDefault();
					if($(this).valid()){
						$('#password').focus();
					}
					return false;       
					}
				});

				$( "#password" )
				.keypress(function(event) {
					var keycode =(event.keyCode?event.keyCode:event.which); 
					if(keycode ==13){
					if($("#form-login").valid()) {  
						$('#form-login').ajaxForm({
						beforeSend: function() {
							achtungShowLoader();
						},
						uploadProgress: function(event, position, total, percentComplete) {
						},
						complete: function(xhr) {     
							var data=xhr.responseText;
							var jsonResponse = JSON.parse(data);

							if(jsonResponse.status === 200){
							window.location = '<?php echo base_url().'dashboard'?>';
							}else{
							$.achtung({message: jsonResponse.message, timeout:5});
							}
							achtungHideLoader();
						}

						});
					}
					$("#form-login").submit();
					}
				});

				$( "#kt_login_signin_submit" )
				.on("click",function(event) {
					var keycode =(event.keyCode?event.keyCode:event.which); 
					if($("#form-login").valid()) {  
						$('#form-login').ajaxForm({
						beforeSend: function() {
							achtungShowLoader();
						},
						complete: function(xhr) {  
							//alert(xhr.responseText); return false;
							var data=xhr.responseText;
							var jsonResponse = JSON.parse(data);

							if(jsonResponse.status === 200){
							window.location = '<?php echo base_url().'dashboard'?>';
							}else{
							$.achtung({message: jsonResponse.message, timeout:5});
							}
							achtungHideLoader();
						}
						});
					}
					//   $("#form-login").submit();
					
				});

				$("#form-login input:text").first().focus();

				/*========== END PROCESS LOGIN ================*/

			});

			function format_html ( data ) {
				return data.html;
			}

		</script>
	</body>

	<!-- end::Body -->
</html>