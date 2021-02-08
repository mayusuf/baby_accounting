<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Admin Accounts Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>assets/css/AdminLTE.min1.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="" style="margin-top:100px; padding: 5px;">
<div id="page-wrapper">
    <div class="row">
        <div class="col-md-5 col-md-offset-3">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Login </h3>
                </div>
                <div class="panel-body">
                    <?php
                    $attributes = array("class" => "form-horizontal", "id" => "loginform", "name" => "loginform");
                    echo form_open("admin/auth/admin_login/login", $attributes);
                    ?>
                    <?php echo $this->session->flashdata('msg'); ?>
                    <fieldset style=" padding: 15px;">
                        <div class="form-group has-feedback">
                            <input type="text" id="username" name="username" class="form-control" placeholder="Email"
                                   value="<?php echo set_value('username'); ?>"/>
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            <span class="text-danger"><?php echo form_error('username'); ?></span>
                        </div>
                        <div class="form-group has-feedback">
                            <input type="password" id="password" name="password" placeholder="Password"
                                   class="form-control"
                                   value="<?php echo set_value('password'); ?>"/>
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            <span class="text-danger"><?php echo form_error('password'); ?></span>
                        </div><br/>
                        <input class="btn btn-lg btn-success btn-block" name="submit" type="submit" id="submit"
                               value="login">
                        <!--<div class="checkbox">
                             <label>
                                 <input name="remember" type="checkbox" value="Remember Me">Remember Me
                             </label>
                             <span class="signup"><a id="showsignup" data-toggle='modal' data-target='#myModalRegistration' href="javascript:void(0)">(Sign Up)</a></span>
                         </div>
                         <a id="show_modal" class="forgot_pass_signin"  href="javascript:void(0)" data-toggle='modal' data-target='#myModalForgotPassword'>(Forgot Password?)</a>
                     -->
                    </fieldset>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /#page-wrapper -->


<!--        Modal for signup-->

<div class="modal fade" id="myModalRegistration" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Sign Up</h4>
            </div>
            <div class="modal-body">
                <div class="panel-body">
                    <form id="signup" accept-charset="UTF-8" role="form" method="post" action="">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" id="user_email" name="user_email"
                                       type="email" required="required">
                                <label class="error" style="display:none;" for="email">Please enter a valid email
                                    address.</label>
                            </div>

                            <div class="form-group">
                                <input class="form-control" placeholder="Username" id="user_name" name="user_name"
                                       type="text" required="required">
                            </div>

                            <div class="form-group">
                                <input class="form-control" placeholder="Password" id="user_pass" name="user_pass"
                                       type="password" value="" required="required">
                                <label id="pass_error" class="error" style="display:none;" for="email">Please enter your
                                    password above 6 Character.</label>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Confirm Password" id="re_pass" type="password"
                                       value="" required="required">
                                <label id="re_pass_error" class="error" style="display:none;" for="email">Your given
                                    password doesn't match.</label>
                            </div>

                            <input id="signup" class="btn btn-lg btn-success btn-block" type="submit" value="Sign Up">
                        </fieldset>
                    </form>
                    <p class="mszsuccess" style="display: none">You will get an Confirmation email after approval from
                        Admin.</p>

                </div>
            </div>
            <div class="modal-footer">
                <button id="close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal for forgot password-->
<div class="modal fade" id="myModalForgotPassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Forgot Password</h4>
            </div>
            <div class="modal-body">
                <form accept-charset="UTF-8" role="form">
                    <fieldset>
                        <div class="form-group">
                            <input class="form-control" placeholder="E-mail" id="email" name="user_email" type="email"
                                   required="required">
                            <label class="error" style="display:none;" for="email">Please enter a valid email
                                address.</label>
                        </div>
                        <input id="sendemail" class="btn btn-lg btn-success btn-block" type="submit" value="send">
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button id="close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url(); ?>assets/vendor/metisMenu/metisMenu.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="<?php echo base_url(); ?>assets/vendor/raphael/raphael.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/morrisjs/morris.min.js"></script>
<script src="<?php echo base_url(); ?>assets/data/morris-data.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url(); ?>assets/dist/js/billboy.js"></script>
</body>
</html>
