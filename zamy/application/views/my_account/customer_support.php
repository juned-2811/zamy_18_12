<?php if(isset($msg) || validation_errors() !== ''): ?>
              <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                  <?= validation_errors();?>
                  <?= isset($msg)? $msg: ''; ?>
              </div>
<?php endif; ?>
<div class="" id="account-settings">
	<form method="post" name="forgotpass" action="<?php echo base_url('my_account/ForgetPassword/index'); ?>" class="profile-info-form" enctype="multipart/form-data">
	<div class="tabs-wrp account-settings brd-rd5">
	  <h4 itemprop="headline">Customer Support</h4>
	  <div class="account-settings-inner">
		 <div class="row">
       <!--     -->

<table class="table">
  <thead class="thead-light">
    <th>Sr.no</th>
    <th>Ticket No</th>
    <th>Ticket Category</th>
    <th>Order ID</th>
    <th>Subject</th>
    <th>Message</th>
    <th>Status</th>
    <th>option</th>
  </thead>
  <tbody>
    <?php 
      if (!empty($data)) {
        $i = 1;
       foreach ($data as $row) {
            $ticketTitle = $row['ticketTitle'];
            if ($ticketTitle == '1') {
              $ticketcat =  'Payment Issue';
            } else if($ticketTitle == '2'){
              $ticketcat =  'Food Issue';
            } else if($ticketTitle == '3'){
              $ticketcat =  'Delivery Issue';
            } else if($ticketTitle == '4'){
              $ticketcat =  'Other';
            }
        if ($row['ticketSenderID'] != 1) {
          
    ?>
    <tr>
      <td><?= $i; ?></td>
      <td>#<?= $row['ticketChatID']; ?></td>
      <td><?= $ticketcat ?></td>
      <td><?= $row['order_id']; ?></td>
      <td><?= $row['subject']; ?></td>
      <td><?= $row['ticketBody']; ?></td>
      <td><?= $row['ticketstatus']; ?></td>
      <td><a href="<?php echo base_url('my_account/customer_support/view_conversation/'.$row['ticketID'].'/'.$row['ticketChatID']); ?>" class="btn btn-info">View</a></td>
    </tr>
    <?php 
        }
       $i++;
       } 
      } 
    ?>
  </tbody>
</table>
       <!--    -->
		 </div>
	  </div>	
	</div>	
	</form>	
</div>