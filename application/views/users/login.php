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
        <form>
          <h1>Login Form</h1>
          <div>
            <?php echo form_error('username')?>
            <div class="input-group">
              <span class="input-group-addon addonExtra"> <i class="fa fa-user" style="color:white;"></i> </span>
              <?=form_input($username)?>
            </div>
          </div>
          <div>
            <input type="password" class="form-control" placeholder="Password" required="" />
          </div>
          <div>
            <a class="btn btn-default submit" href="index.html">Log in</a>
            <a class="reset_pass" href="#">Lost your password?</a>
          </div>

          <div class="clearfix"></div>

          <div class="separator">
            <p class="change_link">New to site?
              <a href="#signup" class="to_register"> Create Account </a>
            </p>

            <div class="clearfix"></div>
            <br />

            <div>
              <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
              <p>©<?= date('Y'); ?> All Rights Reserved.</p>
            </div>
          </div>
        </form>
      </section>
    </div>

    <div id="register" class="animate form registration_form">
      <section class="login_content">
        <form action="<?=base_url().'users/registration'?>" method = "post">
          <h1>Create Account</h1>
          <div>
            <input type="text" name="first_name" class="form-control" placeholder="First Name" required="" />
          </div>
          <div>
            <input type="email" name="email" class="form-control" placeholder="E-mail" required="" />
          </div>
          <div>
            <input type="text" name="username" class="form-control" placeholder="Username" required="" />
          </div>
          <div>
            <input type="password" name="password" class="form-control" placeholder="Password" required="" />
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
              <h1><i class="fa fa-paw"></i> Develpoer City</h1>
              <p>©2019 All Rights Reserved. </p>
            </div>
          </div>
        </form>
      </section>
    </div>
  </div>
</div>