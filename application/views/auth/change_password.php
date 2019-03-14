<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3> <?php echo lang('change_password_heading');?></h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="row">
            <?php if($this->session->flashdata('success')):?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('success');;?>
                </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_title">
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <?php echo lang('change_password_heading');?>
                        <div class="clearfix"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-sm-8 col-xs-8">
                            <div class="x_content">

                                <div id="infoMessage"><?php echo $message;?></div>

                                <?php echo form_open("auth/change_password");?>

                                <p>
                                    <?php echo lang('change_password_old_password_label', 'old_password');?> <br />
                                    <?php echo form_input($old_password);?>
                                </p>

                                <p>
                                    <label for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label> <br />
                                    <?php echo form_input($new_password);?>
                                </p>

                                <p>
                                    <?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?> <br />
                                    <?php echo form_input($new_password_confirm);?>
                                </p>

                                <?php echo form_input($user_id);?>
                                <p><?php //echo form_submit('submit', lang('change_password_submit_btn'));?>
                                    <button class="btn btn-success" type="submit">Submit </button>
                                    <a class="btn btn-primary" href="javascript:window.history.go(-1);">Back</a>
                                </p>

                                <?php echo form_close();?>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
