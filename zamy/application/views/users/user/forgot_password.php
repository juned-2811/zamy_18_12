<!DOCTYPE html>
<html lang="en">
    <head>
          <title><?=isset($title)?$title:'HOPMeal POS' ?></title>
          <!-- Tell the browser to be responsive to screen width -->
          <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
          <!-- Bootstrap 3.3.6 -->
          <link rel="stylesheet" href="<?= base_url() ?>public/bootstrap/css/bootstrap.min.css">
          <!-- Theme style -->
          <link rel="stylesheet" href="<?= base_url() ?>public/dist/css/AdminLTE.min.css">
           <!-- Custom CSS -->
          <link rel="stylesheet" href="<?= base_url() ?>public/dist/css/style.css">
           <!-- jQuery 2.2.3 -->
          <script src="<?= base_url() ?>public/plugins/jQuery/jquery-2.2.3.min.js"></script>
       
    </head>
<body style="background: #e8e8ea; ">
    <div class="container">
        <div class="row">
            
            <div class="col-md-4 col-md-offset-4 text-center">
                <div class="login-title">
                    <h3><span>HOPMeal</span>POS SYSTEM</h3>
                </div>
                <?php if($this->session->flashdata('error')) { ?>
				<div class="row timeHide">
					<div class="col-sm-12">
					<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo $this->session->flashdata('error'); ?></div>
					</div>
				</div>
				<?php } ?>
				<?php if($this->session->flashdata('message')) { 
				$message = $this->session->flashdata('message');?>
				<div class="row timeHide fake">
					<div class="col-sm-12">
					<div class="alert <?php echo $message['class']; ?> alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><?php echo $message['msg'] ?></div>
					</div>
				</div>
				<?php } ?>
                <div class="form-box">
                    <div class="caption">
                        <h4>Forgot Password</h4>
                    </div>
                    <?php echo form_open(base_url('users/forgot_password'), 'class="login-form" '); ?>
                        <div class="input-group">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email" >

                            <input type="submit" name="submit" id="submit" class="form-control" value="Submit">
                        </div>
					<input type="hidden"  name="hash" value="<?php echo sha1(time()); ?>" />
                    <?php echo form_close(); ?>
					<p class=""><a href="<?php echo base_url()?>">Sign-in</a></p>
                </div>
				
            </div>
        </div>
    </div>
</body>

    <!-- Bootstrap 3.3.6 -->
    <script src="<?= base_url() ?>public/bootstrap/js/bootstrap.min.js"></script>
    
    <!-- AdminLTE App -->
    <script src="<?= base_url() ?>public/dist/js/app.min.js"></script>
  

    <style type="text/css">
    .login-title{
        padding-top: 80px;
    }
    .login-title span{
        font-size: 30px;
        line-height: 1.9;
        display: block;
        font-weight: 700;
    }
    .form-box{
        position: relative;
        background: #ffffff;
        max-width: 375px;
        width: 100%;
        border-top: 5px solid #33b5e5;
        box-shadow: 0 0 3px rgba(0, 0, 0, 0.1);
        padding: 30px;
    }

    .caption{
        margin-bottom:40px;
    }
    .login-form input[type=text], .login-form input[type=password]{
        margin-bottom:10px;
    }

    .login-form input {
        outline: none;
        display: block;
        width: 100%;
        border: 1px solid #d9d9d9;
        margin: 0 0 20px;
        padding: 10px 15px;
        box-sizing: border-box;
        border-radius: 0;
        -moz-border-radius: 0;
        -webkit-border-radius: 0;
        min-height: 40px;
        font-wieght: 400;
        -webkit-transition: 0.3s ease;
        transition: 0.3s ease;
    }

    .login-form input[type=submit]{
        cursor: pointer;
        background: #33b5e5;
        width: 100%;
        border: 0;
        padding: 8px 15px;
        color: #ffffff;
        -webkit-transition: 0.3s ease;
        transition: 0.3s ease;
        border-radius: 0;
        -moz-border-radius: 0;
        -webkit-border-radius: 0;
        min-height: 40px;
        
    }
    </style>
</html>