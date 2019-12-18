<div class="" id="account-settings">



	<div class="tabs-wrp account-settings brd-rd5">
	  <h4 itemprop="headline">My Referral Code</h4>
	  <div class="account-settings-inner">
<section>
<?php
if (!empty($ref_code)) {
	$rf_code = $ref_code;
}
else{
    $rf_code = 'no-code contact info@zamy.com';
}
$str = 'Invite Your Friends';
$btn_data = strtoupper($str);
?>



<div class="block gray-bg bottom-padd210">
	<div class="sec-box bottom-padd140">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-lg-6">
					<div class="sec-wrapper">
						<div class="row">
							<p>Refer A friend And We will give you and your buddy Rs. 50 off on your next order above Rs. 200.</p>
						</div>
						<div class="row text-center">
							<h1>Your Code</h1>
						</div>
						<div class="row text-center">							
							<!--<div class="col-md-6 col-sm-6 col-lg-6">-->
<form>

  <div class="input-group">
   
    <input id="msg" type="text" class="form-control" id="rf_data" value="<?php echo $rf_code; ?>" name="msg" placeholder="Additional Info">
    <span class="input-group-addon"><i class="fa fa-tag" style="font-size:20px"></i></span>
  </div>
</form>
							<!--</div> -->
						</div>
                        <div class="row text-center" style="margin-top: 20px;">
				           <a class="btn btn-info" href="register-reservation.html" title="Invite your Friends" itemprop="url" data-toggle="modal" data-target="#refmodel" onclick="add_more()"><?php echo $btn_data;  ?></a>
			          </div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>


  <!-- Modal -->
  <div class="modal fade" id="refmodel" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Refer your friends</h4>
        </div>
        <div class="modal-body">
<form method="post" id="referral_form">
<div class="row"  id="add_menu">
  <div class="form-group">
    <div class="col-md-10">
      <input type="text" name="rf_email[]" class="form-control" id="rf_email" placeholder="Enter Email Address/Phone Number">
    </div>
    <div class="col-md-2">
        <div class="form-group">
          <input type="hidden" id="rf_code" name="rf_code" value="<?php echo $rf_code; ?>">
        </div>
    </div>
        
  </div>

</div>
</form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" id="add_rows">ADD</button>
          <button type="button" class="btn btn-danger" id="submit">SUBMIT</button>
        </div>
      </div>
      
    </div>
  </div>								
<script type="text/javascript">

count = 0;
$("#add_rows").click(function(){

	count = count+1;
    var html = '';
    html += '<div class="row"  id="add_menu_'+count+'">';
     html += '<div class="col-md-9">';
      html += '<div class="form-group">';
      html += '<input type="text" name="rf_email[]" class="form-control" id="rf_email" placeholder="Enter Email Address/Phone Number">';
      html += '</div>';
     html += '</div>';
     html += '<div class="col-md-3">';
      html += '<div class="form-group">';
      html += '<button type="button" class="btn btn-default" id="remove" onclick="remove('+count+')"><i class="fa fa-window-close"></i></button>';
     html += '</div>';
    html += '</div>';
    html += '</div>';
    $("#add_menu").after(html);

});
function remove(index){
	$('#add_menu_' + index).remove();
}
/*function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}*/
 $("#submit").click(function(){

  var form = $("#referral_form").serialize();
  $.ajax({
    url : '<?php echo base_url("my_account/Referral/send_ref_code");?>',
    data : form,
    method : 'POST',
    success : function(data){
      alert(data);
      window.location.replace('<?php echo base_url('my_account/Referral/index');?>');
    },
    error : function(){
      alert("ERROR");
    }
  });
 });
</script>
	  
