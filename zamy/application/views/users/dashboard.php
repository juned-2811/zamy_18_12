<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="row page-titles">
	<div class="col-md-5 align-self-center">
		<h4 class="text-themecolor">Table View</h4>
	</div>
	<div class="col-md-7 align-self-center text-right">
		<div class="button-group">
			<button type="button" class="btn waves-effect waves-light btn-primary">Delivery </button>
			<button type="button" class="btn waves-effect waves-light btn-primary">Pick UP  </button>
			<button type="button" class="btn waves-effect waves-light btn-primary"><i class="mdi mdi-plus"></i> ADD Table </button>
		</div>

		<!-- <div class="d-flex justify-content-end align-items-center">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
				<li class="breadcrumb-item active">Dashboard</li>
			</ol>
		</div> -->
	</div>
</div>
<!-- ============================================================== -->
<!-- End Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<!-- ============================================================== -->

<!-- first section -->
<div class="row">                    
	<!-- Column -->
	<div class="col-lg-12 col-md-12">

		<ul class="list-inline font-12 table-color-view text-right">
			<li><i class="tb-book-circle blank-tb"></i> Blank Table</li>
			<li><i class="tb-book-circle running-tb"></i> Running Table</li>
			<li><i class="tb-book-circle printed-tb"></i> Printed Table</li>
			<li><i class="tb-book-circle paid-tb"></i> Paid Table</li>
			<li><i class="tb-book-circle running-kot-tb"></i> Running KOT Table</li>
		</ul>
		
	</div>                        
	<!-- Column -->

	<!-- Column -->
	<div class="col-lg-12 col-md-12">
		<ul class="select-table-view">
			<?php 
			/* echo "<pre>";
			print_r($tables);
			echo "</pre>"; */
			foreach($tables as $table){
				
				$status_running 	= 'active running-tb';
				$status_printed 	= 'active printed-tb';
				$status_running_kot = 'active running-kot-tb';
				
				$print_btn = '<a href="#"><img src="'.base_url('assets/image/print-icon.svg').'" class="svgimg" alt=""></i></a>';
				
				$save_btn = '<a href="#"><img src="'.base_url('assets/image/save-icon.svg').'" class="svgimg" alt=""></i></a>';
			?>
			<li onclick="select_table(<?php echo $table['table_id']?>);">
				<img src="<?php echo base_url('assets/')?>image/table-icon.svg" class="svgimg" alt="">
				<div class="mt-5 d-flex justify-content-between">
					<div class="action">
						<a href="#"><img src="<?php echo base_url('assets/')?>image/print-icon.svg" class="svgimg" alt=""></i></a>
						<a href="#"><img src="<?php echo base_url('assets/')?>image/save-icon.svg" class="svgimg" alt=""></i></a>
					</div>
					<span><?php echo $table['table_no']?></span>
				</div>
			</li>
			<?php } ?>
		</ul>
	</div>                     
	<!-- Column -->
</div>
<script>
function select_table(id){
	alert(id);
}
</script>