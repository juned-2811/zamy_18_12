<section>
            <div class="block">
				<div class="fixed-bg" style="background-image: url(assets/images/topbg.jpg);"></div>
                <div class="page-title-wrapper text-center">
					<div class="col-md-12 col-sm-12 col-lg-12">
						<div class="page-title-inner">
							<h1 itemprop="headline">Contact Us</h1>
							<span>A Greate Restaurant Website</span>
						</div>
					</div>
                </div>
            </div>
</section> 
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
            <li class="breadcrumb-item"><a href="#" title="" itemprop="url">Home</a></li>
            <li class="breadcrumb-item active">Contact Us</li> 
        </ol>
    </div>
</div>    
 
<section>
	<div class="block less-spacing gray-bg top-padd30">
		<div class="contact-form-wrapper text-center">
                                    <div class="contact-form-inner">
                                        <h3 itemprop="headline">If You Got Any Questions <br> Please Do Not Hesitate to Send us a Message.</h3>
                                        <div id="message"></div>
                                       
                                        <?php echo form_open(base_url('contact_us/index'), 'id=""', 'name="submit"');  ?> 
                                            <div class="row">
                                                <div class="col-md-12 col-sm-6 col-lg-12">
                                                    <input id="name" type="text" placeholder="Your Name" name="name">
                                                </div>
                                                <div class="col-md-12 col-sm-6 col-lg-12">
                                                    <input id="email" type="email" placeholder="Your Email" name="email">
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-lg-12">
                                                    <input type="text" placeholder="Subject" name="subject">
                                                </div>
                                                <div class="col-md-12 col-sm-12 col-lg-12">
                                                    <textarea id="comments" placeholder="Message" name="msg"></textarea>
                                                </div>
                                                <!--<div class="col-md-12 col-sm-12 col-lg-12">
                                                    <div class="g-recaptcha" data-sitekey="6LelmzAUAAAAAHBE2SJeRMfnzYVxH9RMGQstUij2"></div> 
                                                </div>-->
                                                <div class="col-md-3 col-sm-3 col-lg-3">
                                                    
                                                    <input type="submit" name="submit" class="btn btn-success" value="SUBMIT">
                                                    <img src="assets/images/ajax-loader.gif" class="loader" alt="ajax-loader.gif" itemprop="image">
                                                </div>
                                            </div>
                                        <?php echo form_close( ); ?>
                                    </div>
                                </div>

                                          
	</div>
</section>         