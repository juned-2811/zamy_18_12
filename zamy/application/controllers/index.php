 <!-- Datatable style -->
<link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.css">

 <section class="content">
   <div class="box">
    <div class="box-header">
      <h3 class="box-title">Search</h3>
    </div>
   </div>
   <div class="box-body table-responsive">
      <form method='post' name="search_order_form" id="search_order_form">
       <div class="row">
        <div class="col-md-3">
          <div class="form-group">
          <input type="number" class="form-control" title="Order ID" name="order_id" placeholder="order_id" id="order_id" value="<?=!empty($search_data['order_id']) ? $search_data['order_id'] : ''; ?>">
          </div>
        </div>
        <div class="col-md-3">
        <div class="form-group">          
          <input type="text" class="form-control" title="Customer Name" name="customer_name" placeholder="customer_name" id="customer_name" value="<?=!empty($search_data['customer_name']) ? $search_data['customer_name'] : ''; ?>">
         </div> 
        </div>
        <div class="col-md-3">
          <div class="form-group">
          <input type="text" class="form-control" title="Restaurent Name" name="restaurant_name" placeholder="restaurant_name" id="restaurant_name" value="<?=!empty($search_data['restaurant_name']) ? $search_data['restaurant_name'] : ''; ?>">
         </div> 
        </div>
        <div class="col-md-3">
          <div class="form-group">
          <input type="text" class="form-control" title="Order Status" name="order_status" placeholder="order_status" id="order_status" value="<?=!empty($search_data['order_status']) ? $search_data['order_status'] : ''; ?>">
         </div> 
        </div>
       </div>
       <div class="row">
        <div class="col-md-3">
          <div class="form-group">
            <input type="text" class="form-control" title="Phone Number" name="shipping_phone" placeholder="Phone No" id="shipping_phone" value="<?=!empty($search_data['shipping_phone']) ? $search_data['shipping_phone'] : ''; ?>">
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <input type="text" class="form-control" name="area" placeholder="Area" id="area" value="<?=!empty($search_data['area']) ? $search_data['area'] : ''; ?>">
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <input type="date" class="form-control" title="Start Date" name="start_date" placeholder="Start Date" id="start_date" value="<?=!empty($search_data['start_date']) ? $search_data['start_date'] : ''; ?>">
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <input type="date" class="form-control" title="End Date" name="end_date" placeholder="End Date" id="end_date" value="<?=!empty($search_data['end_date']) ? $search_data['end_date'] : ''; ?>">
          </div>
        </div>

      </div>
      <div class="row">
        <div class="col-md-3 text-right pull-right">
          <input type="submit" name="search" value="SEARCH" class="btn btn-success"/>
          <input type="reset" name="reset" value="RESET" class="btn btn-info"/>
        </div>
      </div>
     </form>
   </div>
   <div class="box">

	 <div class="box">
    <div class="box-header">
      <h3 class="box-title">All Orders</h3>
    </div>
   </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
      <table id="example1" class="table table-bordered table-striped ">
        <thead>
        <tr>
          <th>Order</th>
          <th>Restaurent Name</th>
          <th>Date</th>
          <th>status</th>
          <th>Delivery Boy</th>
          <th>Total</th>
          <th>View</th>
          <th>Delete</th>
        </tr>
        </thead>
        <tbody>
          <?php 
		  if(!empty($all_orders)){
		
		  foreach($all_orders as $row){ ?>
          <tr>
            <td><a href="<?php echo base_url('admin/orders/orders_info/'.$row['order_id'].'/'.$row['userid']); ?>" title="order details" class="orders_details_all" >#<?php echo $row['order_id']." ".$row['customer_name'].", ".$row['shipping_phone']?></a></td>
			<td><a href="<?php echo base_url('admin/orders/orders_info/'.$row['order_id'].'/'.$row['userid']); ?>" title="order details"><?php echo $row['restaurant_name']." <br>(".$row['area'].", ".$row['landmark'].")"?></a></td>
			<td><?php echo date("d-m-Y h:i:s",strtotime($row['order_date']))?></td>
			<td><?php echo $row['order_status']?></td>
			<td><?php
				$delivery_boy = $this->user_model->assigned_delivery_boy($row['order_id']);
				if(!empty($delivery_boy)){
					echo $delivery_boy['delivery_boy_name'];
				}else{
					echo "Not assiged";
				}
			?></td>
			<td>₹<?php echo $row['order_total']?></td>
      <td> <a href="" title="Quick View" data-toggle="modal" data-target="#order_model" id="<?php echo $row['order_id']?>" uid="<?php echo $row['userid']?>" class="orders_info"><i class="fa fa-eye"></i></a></td>
            <td class="text-right">
             
              <button class="btn btn-danger o_per" onclick='forActive(<?php echo $row['order_id'];?>)' id="de_or_<?php echo $row['order_id']?>">Deleted</button>
              
            </td>
          </tr>
          <?php }} ?>
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</section>  
<!-- Large modal -->



<div class="container"> 
  <!--
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#or_details">Order Details</button>-->

<!-- Order Model -->
<div class="modal bs-example-modal-lg" tabindex="-1" role="dialog" id="order_model" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="myLargeModalLabel">Order Details</h2>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success waves-effect text-left" data-dismiss="modal" id="save_data">Save</button>
        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- End Order Model -->

<!-- DataTables -->
<script src="<?= base_url() ?>public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>public/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
   $('#example1').dataTable( {
	  "ordering": false
	} );
  });

  $(".orders_info").click(function(){
     var order_id = $(this).attr('id');
     var user_id = $(this).attr('uid');
      $.ajax({
   url : '<?= base_url('admin/Orders/order_details/'); ?>',
   data : 'order_id='+order_id+'&user_id='+user_id,
   type : 'POST',
   success : function(data){
    $('#order_model .modal-body').html(data);
   },
   error: function(){
    console.log("ERROR!");
   }
   });
  });
  function forActive(index){
     var id = index;
    $.ajax({
      url : '<?= base_url('admin/Orders/is_deleted_changed/'); ?>',
      data : 'order_id='+id,
      type : 'POST',
      success : function(data){
         alert(data);

         window.location.replace('/admin/orders/orders_permission');
      }
    });
  }
  $("#save_data").click(function(){
    var order_status = $("#order_status").val();
    var order_id = $("#order_id_assign").val();
    
    $.ajax({
      url : '<?= base_url('admin/Orders/edit_order_status/'); ?>',
      data : 'order_id='+order_id+'&order_status='+order_status,
      type : 'POST',
      success : function(data){
         alert(data);

         window.location.replace('/admin/orders');
      }
    });
  });
</script> 
<script>
$("#orders").addClass('active');
</script>        
