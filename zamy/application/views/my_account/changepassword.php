<?php if(isset($msg) || validation_errors() !== ''): ?>
              <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                  <?= validation_errors();?>
                  <?= isset($msg)? $msg: ''; ?>
              </div>
<?php endif; ?>
<div class="" id="account-settings">
	<form method="post" name="forgotpass" action="<?php echo base_url('my_account/Changepassword/index'); ?>" class="profile-info-form" enctype="multipart/form-data">
	<div class="tabs-wrp account-settings brd-rd5">
	  <h4 itemprop="headline">CHANGE PASSWORD</h4>
	  <div class="account-settings-inner">
		<div class="row"> 
      <div class="col-md-12 col-sm-12 col-lg-12">
            <label>OLD PASSWORD<sup>*</sup></label>
         <span toggle="#password-field" class="brd-rd3 fa fa-fw fa-eye field_icon toggle-password">Show/Hide</span>
        <input type="password" name="old_pass" id="pass_log_id" placeholder="Enter the OLD Password" />
      </div>
       <div class="col-md-12 col-sm-12 col-lg-12">
            <label>NEW PASSWORD<sup>*</sup></label>
         <span toggle="#password-field" class="brd-rd3 fa fa-fw fa-eye field_icon toggle-password">Show/Hide</span>
        <input type="password" name="new_pass" id="pass_log_id_TWO" placeholder="Enter the NEW PASSWORD" />
      </div>
      <div class="col-md-6 col-sm-6 col-lg-6">
          	<input type="submit" name="submit" class="btn btn-warning" value="Update Password" style="color: #fff"/>
      </div>	
		  </div>

	  </div>	
	</div>	
	</form>	
</div>

<script type="text/javascript">
$("body").on('click', '.toggle-password', function() {
  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $("#pass_log_id");
  if (input.attr("type") === "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
$("body").on('click', '.toggle-password', function() {
  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $("#pass_log_id_TWO");
  if (input.attr("type") === "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
</script>