<div style="margin-top: 45px;"></div>
<section>
            <div class="block">
				<div class="fixed-bg" style="background-image: url(assets/images/topbg.jpg);"></div>
                <div class="page-title-wrapper text-center">
					<div class="col-md-12 col-sm-12 col-lg-12">
						<div class="page-title-inner">
							<h1 itemprop="headline">Restaurant Inquiry</h1>
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
            <li class="breadcrumb-item active">Restaurant Inquiery</li> 
        </ol>
    </div>
</div>  
  
<section>
  <div class="block top-padd30 gray-bg">
    <div class="container">
      <div class="row">
       <!-- <div class="col-md-3 col-sm-12 col-lg-3"></div>-->
        <div class="col-md-9 col-sm-12 col-lg-9">
          <div class="tab-content">
            <div class="tab-pane fade in active" id="reservation-tab1">
              <form method="post" action="<?php echo base_url('Restaurant_reservation/index');  ?>" class="restaurant-info-form brd-rd5" name="res_reg" id="res_reg" enctype="multipart/form-data">
                <div class="row mrg20">
                  <div class="col-md-6 col-sm-6 col-lg-6">
                    <label>Restaurant name <sup class="text-danger">*</sup></label>
                    <input class="brd-rd3" type="text" name="restaurant_name">
                  </div>
                  <div class="col-md-6 col-sm-6 col-lg-6">
                    <label>Restaurant Phone <sup>*</sup></label>
                    <input class="brd-rd3" type="text" name="restaurant_phone">
                  </div>
                  <div class="col-md-6 col-sm-6 col-lg-6">
                    <label>Manager Name <sup>*</sup></label>
                    <input class="brd-rd3" type="text" name="manager_name">
                  </div>
                  <div class="col-md-6 col-sm-6 col-lg-6">
                    <label>Manager Contact phone <sup>*</sup></label>
                    <input class="brd-rd3" type="text" name="manager_contact">
                  </div>
                  <div class="col-md-12 col-sm-12 col-lg-12">
                    <label>Contact Email<sup>*</sup></label>
                    <input class="brd-rd3" type="email" name="contact_email">
                  </div>
                  <div class="col-md-12 col-sm-12 col-lg-12">
                    <h4 itemprop="headline">Address Fields</h4>
                  </div>
                  <div class="col-md-12 col-sm-12 col-lg-12">
                    <label>Country <sup>*</sup></label>
                    <div class="select-wrp">
                        <select style="display: none;" name="country">
                            <option>India</option>
                            <option>UK</option>
                            <option>USA</option>
                        </select>
                    </div>
                  <div class="col-md-6 col-sm-6 col-lg-6">
                    <label>State <sup>*</sup></label>
                      <div class="select-wrp">
                        <select style="display: none;" name="state">
                            <option>Gujarat</option>
                            <option>Washington DC</option>
                            <option>Wales</option>
                        </select>
                      </div>
                  </div>
                  <div class="col-md-6 col-sm-6 col-lg-6">
                    <label>City <sup>*</sup></label>
                      <div class="select-wrp">
                        <select style="display: none;" name="city">
                            <option>Ahemedabad</option>
                            <option>Birmingham</option>
                            <option>London</option> 
                            <option>New York</option>
                        </select>
                      </div>
                  </div>
                  <div class="col-md-12 col-sm-12 col-lg-12">
                    <div class="check-box">
                      <input type="checkbox" id="agrement" name="terms_and_co" value="1">
                      <label for="agrement">Accept Terms and Conditions</label>
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12 col-lg-12 text-center">
                    <input type="submit" name="submit" href="#" class="brd-rd3 red-bg" value="Register">
                  </div>  
                </div>
              </form>
            </div>      
        </div>
      </div>
    </div>
  </div>
</section>
