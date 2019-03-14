<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3><?php echo lang('edit_user_heading');?> </h3>
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
            <div class="col-md-8 col-sm-8 col-xs-8">
                <div class="x_panel">
                    <div class="x_title">
                        <h2> <?php echo lang('edit_user_heading');?></h2>
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
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <p><?php echo lang('edit_user_subheading');?></p>

                        <div id="infoMessage"><?php echo $message;?></div>

                        <?php echo form_open_multipart(uri_string());?>
                        <div class="item form-group">
                            <p>
                                <?php echo lang('edit_user_fname_label', 'first_name');?> <br />
                                <?php echo form_input($first_name);?>
                            </p>
                        </div>
                        <p>
                            <?php echo lang('edit_user_lname_label', 'last_name');?> <br />
                            <?php echo form_input($last_name);?>
                        </p>

                        <p>
                            <?php echo lang('edit_user_company_label', 'company');?> <br />
                            <?php echo form_input($company);?>
                        </p>

                        <p>
                            <?php echo lang('edit_user_phone_label', 'phone');?> <br />
                            <?php echo form_input($phone);?>
                        </p>

                        <p>
                            <?php echo lang('edit_user_password_label', 'password');?> <br />
                            <?php echo form_input($password);?>
                        </p>

                        <p>
                            <?php echo lang('edit_user_password_confirm_label', 'password_confirm');?><br />
                            <?php echo form_input($password_confirm);?>
                        </p>

                        <p>
                            <label>profile img</label><br />
                            <?php echo form_input($userfile);?>
                        </p>

                        <?php if ($this->ion_auth->is_admin()): ?>

                            <h3><?php echo lang('edit_user_groups_heading');?></h3>
                            <?php foreach ($groups as $group):?>
                                <label class="checkbox">
                                    <?php
                                    $gID=$group['id'];
                                    $checked = null;
                                    $item = null;
                                    foreach($currentGroups as $grp) {
                                        if ($gID == $grp->id) {
                                            $checked= ' checked="checked"';
                                            break;
                                        }
                                    }
                                    ?>
                                    <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
                                    <?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>
                                </label>
                            <?php endforeach?>

                        <?php endif ?>

                        <?php echo form_hidden('id', $user->id);?>
                        <?php echo form_hidden($csrf); ?>

                        <p><?php //echo form_submit('submit', lang('edit_user_submit_btn'));?></p>
                        <p>
                            <button type="submit" class="btn btn-primary">Cancel</button>
                            <button id="send" type="submit" class="btn btn-success">Submit</button>
                        </p>

                        <?php echo form_close();?>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->