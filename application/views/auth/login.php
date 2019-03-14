<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentelella Alela! | </title>

    <!-- Bootstrap -->
    <link href="<?= base_url();?>awedget/assets/css/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?= base_url();?>awedget/assets/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?= base_url();?>awedget/assets/css/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="<?= base_url();?>awedget/assets/css/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="<?= base_url();?>awedget/assets/css/build/css/custom.min.css" rel="stylesheet">
</head>
<body class="login">
<!-- <h1><?php echo lang('login_heading');?></h1>
<p><?php echo lang('login_subheading');?></p>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/login");?>

  <p>
    <?php echo lang('login_identity_label', 'identity');?>
    <?php echo form_input($identity);?>
  </p>

  <p>
    <?php echo lang('login_password_label', 'password');?>
    <?php echo form_input($password);?>
  </p>

  <p>
    <?php echo lang('login_remember_label', 'remember');?>
    <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
  </p>


  <p><?php echo form_submit('submit', lang('login_submit_btn'));?></p>

<?php echo form_close();?>

<p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>
 -->

<div>
  <a class="hiddenanchor" id="signup"></a>
  <a class="hiddenanchor" id="signin"></a>

  <div class="login_wrapper">
    <div class="animate form login_form">
      <?php if($this->session->flashdata('success')):?>
          <div class="alert alert-success">
              <a class="close" data-dismiss="alert">&times;</a>
              <?php echo $this->session->flashdata('success');;?>
          </div>
      <?php endif; ?>
      <section class="login_content">
        <div id="infoMessage"><?php echo $message;?></div>
        <?php echo form_open("auth/login");?>
          <h1>Login Form</h1>
          <div>
            <?php echo lang('login_identity_label', 'identity');?>
            <?php echo form_input($identity);?>
          </div>
          <div>
            <?php echo lang('login_password_label', 'password');?>
            <?php echo form_input($password);?>
          </div>
          <div>
            <!-- <a class="btn btn-default submit" href="index.html">Log in</a> -->
            <!-- <a class="reset_pass" href="#">Lost your password?</a> -->
            <?php echo form_submit('submit', lang('login_submit_btn'),"class='btn btn-default submit'");?>

            <a class="reset_pass" href="forgot_password"><?php echo lang('login_forgot_password');?></a>
          </div>
          <div>
            <?php echo lang('login_remember_label', 'remember');?>
            <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
          </div>
          <div class="clearfix"></div>

          <div class="separator">
            <p class="change_link">New to site?
              <a href="#signup" class="to_register"> Create Account </a>
            </p>

            <div class="clearfix"></div>
            <br />

            <div>
              <h1><i class="fa fa-paw"></i> Developer city</h1>
              <p>©<?= date('Y'); ?> All Rights Reserved.</p>
            </div>
          </div>
        <?php echo form_close();?>
      </section>
    </div>

    <div id="register" class="animate form registration_form">
      <section class="login_content">
        <div id="infoMessage"><?php echo $message;?></div>
        <form action="<?=base_url().'Auth/create_user'?>" method = "post">
          <h1>Create Account</h1>
          <div>
            <input type="text" name="first_name" class="form-control" placeholder="First Name" required="" />
          </div>
          <div>
            <input type="text" name="last_name" class="form-control" placeholder="Last Name" required="" />
          </div>
          <div>
            <input type="text" name="company" class="form-control" placeholder="Company" required="" />
          </div>
          <div>
            <input type="text" name="phone" class="form-control" placeholder="Phone" required="" />
          </div>
          <div>
            <input type="email" name="email" class="form-control" placeholder="E-mail" required="" />
          </div>
          <div>
            <input type="text" name="identity" class="form-control" placeholder="Username" required="" />
          </div>
          <div>
            <input type="password" name="password" class="form-control" placeholder="Password" required="" />
          </div>
          <div>
            <input type="password" name="password_confirm" class="form-control" placeholder="Password Confirm" required="" />
          </div>
          <div>
            <button class="btn btn-default submit" type="submit">Submit </button>
           <!--  <a  href="index.html">Submit</a> -->
          </div>

          <div class="clearfix"></div>

          <div class="separator">
            <p class="change_link">Already a member ?
              <a href="#signin" class="to_register"> Log in </a>
            </p>

            <div class="clearfix"></div>
            <br />

            <div>
              <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
              <p>©<?= date('Y') ?> All Rights Reserved</p>
            </div>
          </div>
        </form>
      </section>
    </div>
  </div>
</div>
</body>
