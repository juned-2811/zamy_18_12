<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h4 class="text-themecolor">Profile</h4>
		</div>
		<div class="col-md-7 align-self-center text-right">
			<div class="d-flex justify-content-end align-items-center">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
					<li class="breadcrumb-item active">Edit Profile</li>
				</ol>
			</div>
		</div>
	</div>
<div class="row">
	<div class="col-12">
	<?php if(isset($msg) || validation_errors() !== ''): ?>
	  <div class="alert alert-warning alert-dismissible">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		  <h4><i class="icon fa fa-warning"></i> Alert!</h4>
		  <?= validation_errors();?>
		  <?= isset($msg)? $msg: ''; ?>
	  </div>
	<?php endif; ?>
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Edit Profile</h4>
				 <?php echo form_open(base_url('users/edit_profile/'.$user['id']), 'class="floating-labels m-t-40"' )?> 
					<div class="form-group m-b-40">
						<input type="text" name="name" value="<?php echo $user['name'] ?>" class="form-control" id="name">
						<span class="bar"></span>
						<label for="name">Name</label>
					</div>
					<div class="form-group m-b-40">
						<input type="email" name="email" value="<?php echo $user['email'] ?>" class="form-control" id="email">
						<span class="bar"></span>
						<label for="email">Email</label>
					</div>
					<div class="form-group m-b-40">
						<input type="text" name="mobile_no" value="<?php echo $user['mobile_no'] ?>" class="form-control" id="mobile_no">
						<span class="bar"></span>
						<label for="mobile_no">Mobile</label>
					</div>
					<input type="submit" name="save_profile" value="Save Changes" class="btn btn-primary">
					<a href="<?= base_url()?>"  class="btn btn-dark">Cancel</a>
				</form>
			</div>
		</div>
		
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Change Password</h4>
				<?php echo form_open(base_url('users/edit_profile/'.$user['id']), 'class="floating-labels m-t-40"' )?> 
					<div class="form-group m-b-40">
						<input type="text" name="current_password" class="form-control" id="current_password">
						<span class="bar"></span>
						<label for="current_password">Current Password</label>
					</div>
					<div class="form-group m-b-40">
						<input type="text" name="password" class="form-control" id="password">
						<span class="bar"></span>
						<label for="password">New Password</label>
					</div>
					<div class="form-group m-b-40">
						<input type="text" name="confirm_password" class="form-control" id="confirm_password">
						<span class="bar"></span>
						<label for="confirm_password">Confirm Password</label>
					</div>
					<input type="submit" name="change_pass" value="Save Changes" class="btn btn-primary">
					<a href="<?= base_url()?>"  class="btn btn-dark">Cancel</a>
				</form>
			</div>
		</div>
		
	</div>
</div>