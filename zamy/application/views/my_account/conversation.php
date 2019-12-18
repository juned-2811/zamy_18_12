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
	  <h4 itemprop="headline">View Conversation</h4>
	  <div class="account-settings-inner">
  <p class="text-left">
    Order ID : <?php echo $data['order_id'];  ?>
    <br>
    Product Name : 
    <br>
    Order Details :
  </p> 
  <h3>Subject : <?php echo $data['subject'];  ?></h3>
<div class="row">
       <!-- CARD START    -->
<div class="card">
  <div class="card-title">
       <div class="pull-left">
         <h4>
           <?php
            $ticketTitle = $data['ticketTitle'];
            $ticketstatus = $data['ticketstatus'];
            if ($ticketTitle == '1') {
              echo 'Payment Issue';
            } else if($ticketTitle == '2'){
              echo 'Food Issue';
            } else if($ticketTitle == '3'){
              echo 'Delivery Issue';
            } else if($ticketTitle == '4'){
              echo 'Other';
            }
             ?>
         </h4>
       </div>
       <?php  if ($ticketstatus == 'open') { ?>
       <div class="pull-right">
         <a href="#" class="btn btn-success" data-toggle="modal" data-target="#customer_ry_model" onClick="Customer_Reply(<?php echo $data['ticketID'];  ?>);"><i class="fa fa-reply"></i>&nbsp;Reply</a>
       </div>
       <?php  } ?>
  </div>
  <br> 
  <hr>
<?php 
if (!empty($conversation)) {
        foreach ($conversation as $row) {
        $ticketSenderID = $row['ticketSenderID'];
        if ($ticketSenderID != 1) {
           $user_name = $row['user_name'];
           $user_email = $row['user_email'];
           $user_profile_name = $row['user_profile_name'];
        } else {
           $user_name = 'ADMIN';
           $user_email = 'sm@gmil.com';
           $user_profile_name = 'admin.png';
        }
        
?> 
  <div class="card-body">
    <div class="row">
      <div class="col-md-3 text-left">
        <div style="width: 50px; height: 50px;">
          <img src="<?php echo ('http://zamy.in/uploads/customer_profiles/'.$user_profile_name); ?>" alt="<?php echo $user_profile_name;  ?>" class="online"></div>

      </div>
      <div class="col-md-3"><span class="name"><?php echo $user_name;  ?></span></div>
      <div class="col-md-3"><span class="email"><?php echo $user_email;  ?></span></div>
      <div class="col-md-3 text-right">
        <i class="fa fa-clock-o"></i> <?php echo $row['ticketDateTime'];  ?>
      </div>
    </div>
    <div class="row pull-left">
      <span id="message"><strong>Message:</strong><?php echo $row['ticketBody'];  ?></span>
    </div>
  </div>
  <br> 
  <br> 
  <br> 
<?php
} 
}
?>  
</div>
       <!-- CARD END   -->
		 </div>
	  </div>	
	</div>	
	</form>	
</div>
<!--Customer Reply Model -->
<div class="modal" tabindex="-1" role="dialog" id="customer_ry_model">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title">Ticket Replay</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--Form Start -->
                  <form class="sign-form" method="post" id="customer_rpy_form">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <div class="form-group">
                                <textarea name="ticketBody" id="comments" rows="7" cols="10" class="form-control" placeholder="Description"></textarea>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12 col-lg-12">
                              <input type="hidden" id="ticketChatID" name="ticketChatID" value="">
                              <input type="hidden" id="ticketSenderID" name="ticketSenderID" value="">
                              <input type="hidden" id="ticketReceiverID" name="ticketReceiverID" value="1">
                              <input type="hidden" id="order_id" name="order_id" value="">
                              <input type="hidden" id="ticketTitle" name="ticketTitle" value="">
                              <input type="hidden" id="subject" name="subject" value="">
                              <input type="hidden" id="ticketstatus" name="ticketstatus" value="open">
                            </div>
                        </div>
                    </form>

        <!-- -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" id="send_customer_ry">Reply</button>
      </div>
    </div>
  </div>
</div>
<!-- -->
<script type="text/javascript">
  function Customer_Reply(index){
     var ticketID  = index;
      $.ajax({
      url : '<?php echo base_url('my_account/Customer_support/getDetails_for_Reply'); ?>',
      data : 'ticketID='+ticketID,
      method : 'POST',
      success : function(data){
         var obj = JSON.parse(data);
         $("#ticketChatID").val(obj.ticketChatID);
         $("#ticketSenderID").val(obj.ticketSenderID);
         $("#order_id").val(obj.order_id);
         $("#ticketTitle").val(obj.ticketTitle);
         $("#subject").val(obj.subject);
      },
      error : function(){
        console.log("ERROR! Something went to wrong");
      }
    });
  }
  $("#send_customer_ry").click(function(){
    var form = $("#customer_rpy_form").serialize();
    $.ajax({
      url : '<?php echo base_url('my_account/Customer_support/give_customer_reply/'); ?>',
      method : 'POST',
      data : form,
      success : function(data){
         alert(data);

      },
      error : function(){
        console.log("ERROR! Something went to wrong");
      }
    });
  });
</script>