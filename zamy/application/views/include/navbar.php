<nav class="navbar top-navbar navbar-expand-md navbar-dark">
	<!-- ============================================================== -->
	<!-- Logo -->
	<!-- ============================================================== -->
	<div class="navbar-header">
		<a class="navbar-brand" href="index.html">
			<!-- Logo icon --><b>
				<!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
				<!-- Dark Logo icon -->
				<img src="<?php echo base_url('assets/image/dark-logo.png')?>" alt="homepage" class="dark-logo" width="180" />
				<!-- Light Logo icon -->
				<img src="<?php echo base_url('assets/image/white-logo.png')?>" alt="homepage" class="light-logo" width="180" />
			</b>
			<!--End Logo icon -->
			<!-- Logo text -->
			</a>
	</div>
	<!-- ============================================================== -->
	<!-- End Logo -->
	<!-- ============================================================== -->
	<div class="navbar-collapse">
		<!-- ============================================================== -->
		<!-- toggle and nav items -->
		<!-- ============================================================== -->
		<ul class="navbar-nav mr-auto">
			<!-- This is  -->
			<li class="nav-item"> <a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
			<li class="nav-item"> <a class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="icon-menu"></i></a> </li>
			<!-- ============================================================== -->
			<!-- Search -->
			<!-- ============================================================== -->
			<!-- <li class="nav-item">
				<form class="app-search d-none d-md-block d-lg-block">
					<input type="text" class="form-control" placeholder="Search & enter">
				</form>
			</li> -->
		</ul>
		<!-- ============================================================== -->
		<!-- User profile and search -->
		<!-- ============================================================== -->
		<ul class="navbar-nav my-lg-0">
			<li class="nav-item dropdown">
				<a class="nav-link waves-effect waves-dark" href="javascript:;"> <i class="mdi mdi-plus-box"></i>
				<span class="fs-15">New Order</span>
				</a>
			</li>   

			<li class="nav-item dropdown">
				<a class="nav-link waves-effect waves-dark" href="javascript:;"><i class="mdi mdi-headset"></i>
				<!-- <span class="fs-15">Ask For Support</span> -->
				</a>
			</li>   

			<li class="nav-item">
				<a class="nav-link  waves-effect waves-dark" href="javascript:void(0)"> <i class="far fa-hand-paper"></i>                                
				</a>
			</li>
							 
			<li class="nav-item">
				<a class="nav-link  waves-effect waves-dark" href="javascript:void(0)"> <i class="mdi mdi-view-dashboard"></i>                                
				</a>
			</li>

			<li class="nav-item">
				<a class="nav-link waves-effect waves-dark" href="javascript:void(0)"> <img src="<?php echo base_url('assets/image/served-tray.svg')?>" class="svgimg">
				</a>
			</li>
			
			<li class="nav-item">
				<a class="nav-link waves-effect waves-dark" href="javascript:void(0)"> <i class="mdi mdi-bell"></i>
				</a>
			</li>                  
			
			<li class="nav-item"> <a class="nav-link  waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-earth"></i></a></li>
		</ul>
	</div>
</nav>