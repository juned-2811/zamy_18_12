<?php 
$CI =& get_instance();
$CI->load->model('Common_model');
?>
          <?php if(isset($msg) || validation_errors() !== ''): ?>
              <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                  <?= validation_errors();?>
                  <?= isset($msg)? $msg: ''; ?>
              </div>
            <?php endif; ?>
            <?php if(isset($pass_error) || validation_errors() !== ''): ?>
              <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                  <?= validation_errors();?>
                  <?= isset($pass_error)? $pass_error: ''; ?>
              </div>
            <?php endif; ?>
            <?php if($this->session->flashdata('pass_error')) { $this->session->flashdata('pass_error'); } else { ""; } ?>

<div class="" id="account-settings">
<form class="profile-info-form" method="post" action="<?php echo base_url('my_account/Edit_profile/index/').$online_customer_details['id'];  ?>" enctype="multipart/form-data">
<div class="tabs-wrp account-settings brd-rd5">
	<h4 itemprop="headline">ACCOUNT SETTINGS</h4>
	<div class="account-settings-inner">
		<div class="row">
			<div class="col-md-4 col-sm-4 col-lg-4">
				<div class="profile-info text-center">
					<div class="profile-thumb brd-rd50">
						<img id="profile-display" src="<?php echo base_url('uploads/customer_profiles/'.$online_customer_details['profile']); ?>" alt="logo" itemprop="image">
					</div>
					<a class="red-clr change-password" href="<?php echo base_url('my_account/Changepassword/index');  ?>" title="" itemprop="url">Change Password</a>
					<div class="profile-img-upload-btn">
						<label class="fileContainer brd-rd5 yellow-bg">
							UPLOAD PICTURE
							<input id="profile-upload" name="new_profile" type="file" id="new_profile"/>
							<input type="hidden" name="profile" id="old_profile" value="<?php echo !empty($online_customer_details['profile']) ? $online_customer_details['profile'] : '' ?>">
						</label>
					</div>
					<p itemprop="description">Upload a profile picture or choose one of the following</p>
				</div>
			</div>

			<div class="col-md-8 col-sm-8 col-lg-8">
				<div class="profile-info-form-wrap">
 
                    
						<div class="row mrg20">
							<div class="col-md-12 col-sm-12 col-lg-12">
								<label>Complete Name <sup>*</sup></label>
								<input class="brd-rd3" name="name" type="text" placeholder="Enter Your Name" value="<?php echo !empty($online_customer_details['name']) ? $online_customer_details['name'] : '' ?>">
							</div>
							<div class="col-md-12 col-sm-12 col-lg-12">
								<label>Email Address <sup>*</sup></label>
								<input class="brd-rd3" name="email" type="email" placeholder="Enter Your Email Address" value="<?php echo !empty($online_customer_details['email']) ? $online_customer_details['email'] : '' ?>">
							</div>
							<div class="col-md-12 col-sm-12 col-lg-12">
								<label>Phone No <sup>*</sup></label>
								<input class="brd-rd3" name="phone" type="text" placeholder="Enter Your Phone No" value="<?php echo !empty($online_customer_details['phone']) ? $online_customer_details['phone'] : '' ?>">
							</div>
							<div class="col-md-12 col-sm-12 col-lg-12">
								<label>Country <sup>*</sup></label>
								<div class="select-wrp">
									<?php
	                                echo $CI->Common_model->select_html('country','country', 'name', 'add', 'form-control chosen', '$online_customer_details["country"]', '', '', 'load_state'); 
	                                ?>
								</div>

							</div>
							<div class="col-md-6 col-sm-6 col-lg-6">
								<label>State <sup>*</sup></label>
								<div class="select-wrp">
									<div id="load_state">
									<?php
									echo $CI->Common_model->select_html('state', 'state', 'name', 'edit', 'form-control chosen', $online_customer_details['state'], 'country_id', $online_customer_details['country'], 'load_city');
									?>
								   </div>
								</div>
							</div>
							<div class="col-md-6 col-sm-6 col-lg-6">
								<label>City <sup>*</sup></label>
								<div class="select-wrp" id="load_city">
                                   <?php 
                                  echo $CI->Common_model->select_html('city', 'city', 'name', 'edit', 'form-control chosen', $online_customer_details['city'], 'state_id',$online_customer_details['state']);

                                   ?>
								</div>
							</div>

							<!-- <div class="col-md-12 col-sm-12 col-lg-12">
	  							<label>Gender</label>			
							</div>
							<div class="col-md-6 col-sm-6 col-lg-6">
  								<div class="check-box">
                      				<input type="checkbox" id="gender" name="gender" value="male">
                      				<label for="gender">Male</label>
                    			</div>	
							</div>
							<div class="col-md-6 col-sm-6 col-lg-6">
  								<div class="check-box">
                      				<input type="checkbox" id="gender" name="gender" value="female">
                      				<label for="gender">Female</label>
                    			</div>	
							</div> -->

							<div class="col-md-12 col-sm-12 col-lg-12">
  								<div class="check-box">
                      				<input type="checkbox" id="change_password" name="change_password" value="1">
                      				<label for="change_password">Change Password</label>
                    			</div>	
							</div>

<div class="account_settings">
	<div class="" id="account-settings">
		<div class="tabs-wrp account-settings brd-rd5">
	  		<h4 itemprop="headline">CHANGE PASSWORD</h4>
	 		 <div class="account-settings-inner">
				<div class="row"> 
     		 		<div class="col-md-12 col-sm-12 col-lg-12">
            			<label>OLD PASSWORD</label>
         				<span toggle="#password-field" class="brd-rd3 fa fa-fw fa-eye field_icon toggle-password">Show/Hide</span>
        				<input type="password" name="old_pass" id="old_pass" placeholder="Enter the OLD Password" />
      				</div>
      				<div class="form-group">
						<span class="old_pass_error" style="color:red"></span><br />
					</div>
       				<div class="col-md-12 col-sm-12 col-lg-12">
            			<label>NEW PASSWORD</label>
         				<span toggle="#password-field" class="brd-rd3 fa fa-fw fa-eye field_icon toggle-password">Show/Hide</span>
        				<input type="password" name="new_pass" id="new_pass" placeholder="Enter the NEW PASSWORD" />
      				</div>
      				<div class="col-md-12 col-sm-12 col-lg-12">
            			<label>CONFORM PASSWORD</label>
         				<span toggle="#password-field" class="brd-rd3 fa fa-fw fa-eye field_icon toggle-password">Show/Hide</span>
        				<input type="password" name="conform_pass" id="conform_pass" placeholder="Conform your PASSWORD" />
      				</div>
      			</div>
			</div>	
		</div>	
	</div>
</div>
							<!--<div class="col-md-6 col-sm-6 col-lg-6">
								<label>Latitude <sup>*</sup></label>
								<input class="brd-rd3" type="text">
							</div>
							<div class="col-md-6 col-sm-6 col-lg-6">
								<label>Longitude <sup>*</sup></label>
								<input class="brd-rd3" type="text">
							</div>-->
							
							<div class="form-group">
								<span class="error" style="color:red"></span><br />
							</div>
							
							<div class="col-md-6 col-sm-6 col-lg-6">
								<input type="submit" name="submit" class="btn btn-danger" value="Save Details" style="color: yellow">
							</div>
						</div>
					

					
				</div>
			</div>
			<!--<div class="col-md-12 col-sm-12 col-lg-12">
				<div class="loc-map2">
					<div class="loc-mp2 brd-rd3" id="loc-map2"></div>
					<div class="loc-srch">
						<input class="brd-rd3" type="text" placeholder="Type Your Address">
						<button class="brd-rd3 red-bg" type="submit">Search Now</button>
					</div>
				</div>
			</div>-->
		</div>
	</div>
</div>
</form>
</div>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script src="<?php echo base_url('assets/js/google-map-int3.js')?>"></script>
<script type="text/javascript">
/* START Fetch State */
function load_state(id){
	$.ajax({
		url: "<?=base_url()?>my_account/Edit_profile/load_state_by_country/"+id,
		success: function(response) {
			$("#load_state").html(response);
			/* $(".chosen").chosen(); */
		},
		fail: function (error) {
			alert(error);
		}
	});
}
/* END Fetch State */

/* START Fetch City */
function load_city(id){
	$.ajax({
		url: "<?=base_url()?>my_account/Edit_profile/load_city_by_state/"+id,
		success: function(response) {
			$("#load_city").html(response);
			/*$(".chosen").chosen();*/
		},
		fail: function (error) {
			alert(error);
		}
	});
}

$(document).ready(function(){
	$(".account_settings").hide();
	$("#change_password").click(function(){
		if($(this).is(":checked")) 
		{
        	$(".account_settings").show();
    	} 
    	else 
    	{
        	$(".account_settings").hide();
    	}
	});
});



$("body").on('click', '.toggle-password', function() {
  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $("#old_pass");
  
  if (input.attr("type") === "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

$("body").on('click', '.toggle-password', function() {
  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $("#new_pass");
  
  if (input.attr("type") === "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

$("body").on('click', '.toggle-password', function() {
  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $("#conform_pass");
  
  if (input.attr("type") === "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});

$("#old_pass").blur(function(){
	var old_pass = $("#old_pass").val();
	
	$.ajax({
		url : '<?= base_url('my_account/Edit_profile/match_old_password/'); ?>',
		data : 'old_pass='+old_pass,
		type : 'POST',
		success : function(data){
			
			if(data == 1){
				$('.old_pass_error').text('Old Password matched successfully.');
			}
			else
			{
				$('.old_pass_error').text('Old Password not matched');
			}
		}
	});

});

$("#conform_pass").blur(function(){
	var new_pass = $("#new_pass").val();
	var confpass = $("#conform_pass").val();

	if(new_pass == confpass)
	{
		$('.error').text('');
		allowsubmit = true;
	}
	else
	{
		$('.error').text('New Password and Conform Password did not matched');
		allowsubmit = false;
	}
});

</script>