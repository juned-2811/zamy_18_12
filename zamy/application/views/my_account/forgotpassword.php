<div id="msg">
          <?php if(isset($msg) || validation_errors() !== ''): ?>
              <div class="alert alert-warning alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h4><i class="icon fa fa-warning"></i> Alert!</h4>
                  <?= validation_errors();?>
                  <?= isset($msg)? $msg: ''; ?>
              </div>
            <?php endif; ?>
</div>
<div class="bread-crumbs-wrapper">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>" title="" itemprop="url">Home</a></li>
            <li class="breadcrumb-item active">Forgot-Password</li> 
        </ol>
    </div>
</div>    
 
<section>
  <div class="block less-spacing gray-bg top-padd30">
    <div class="contact-form-wrapper text-center">
                                    <div class="contact-form-inner">
                                        <h3 itemprop="headline">Forgot-Password</h3>
                                        <div id="message">Email-ID should be Proper</div>
                                       
                                        <?php echo form_open(base_url('my_account/ForgetPassword/index'), 'id=""', 'name="forgotpass"');  ?> 
                                            <div class="row">

                                                <div class="col-md-12 col-sm-6 col-lg-12">
                                                    
                                                    <input name="email" type="email" placeholder="Enter Your Email Address" value="">
                                                </div>

                                                <!--<div class="col-md-12 col-sm-12 col-lg-12">
                                                    <div class="g-recaptcha" data-sitekey="6LelmzAUAAAAAHBE2SJeRMfnzYVxH9RMGQstUij2"></div> 
                                                </div>-->
                                                <div class="col-md-3 col-sm-3 col-lg-3">
                                                    
                                                    <input type="submit" name="submit" class="btn btn-success" value="Send Password"/>
                                                    <img src="assets/images/ajax-loader.gif" class="loader" alt="ajax-loader.gif" itemprop="image">
                                                </div>
                                            </div>
                                        <?php echo form_close( ); ?>
                                    </div>
                                </div>

                                          
  </div>
</section>         
<!--  -->
<!--<div class="container" style="margin-top: 20px;">
 <div class="" id="account-settings">
	<form method="post" name="forgotpass" action="<?php //echo base_url('my_account/ForgetPassword/index'); ?>" class="profile-info-form" enctype="multipart/form-data">
	<div class="col-md-5 pull-center account-settings">
	  <h4 itemprop="headline">FORGOT PASSWORD</h4>
	  <div class="account-settings-inner">
		<div class="row">
          <div class="col-md-12 col-sm-12 col-lg-12">
          	   <label>Email Address <sup>*</sup></label>
			   <input class="brd-rd3" name="email" type="email" placeholder="Enter Your Email Address" value="">
          </div>
          <div class="col-md-6 col-sm-6 col-lg-6">
          	<input type="submit" name="submit" class="btn btn-info" value="Send Password"/>
          </div>	
		</div>
	  </div>	
	</div>	
	</form>	
 </div>
</div>-->