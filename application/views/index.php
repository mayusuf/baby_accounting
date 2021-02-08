<?php

defined('BASEPATH') OR exit('No direct script access allowed');
?>


<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "utf-8">
    <meta content = "width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name = "viewport">
    <title>Baby Account Software</title>
    <link rel="icon" href="<?php echo base_url(); ?>assets/images/baby_fav_icon.png" type="image/x-icon" />
    <link href = "<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel = "stylesheet">
    <!-- Font Awesome -->
    <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel = "stylesheet" href = "https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link href = "<?php echo base_url(); ?>assets/css/AdminLTE.min1.css" rel = "stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/custom_admin_style.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src = "https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src = "https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type = "text/css">


        body {
            background-color: #1e90c0;
            margin: 40px;
            font: 13px/20px normal Helvetica, Arial, sans-serif;
            color: #4F5155;
            font-family: Consolas, Monaco, Courier New, Courier, monospace;
        }

        h1 {
            color: #fff;
            background-color: transparent;
            font-size: 19px;
            font-weight: normal;
            padding: 14px 15px 10px 15px;
        }

        #container {
            margin: 10px;
            height: auto;
            border: 1px solid #D0D0D0;
            box-shadow: 0 0 8px #D0D0D0;
            position: relative;
        }

        #loginForm {
            position: relative;
            z-index: 10;
        }

        #image {
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            position: absolute;
        }

        .panel {
            background: #f4ecbc;
            opacity:0.90;
        }

        input.transparent-input1 {
            background-color: rgba(0, 0, 0, 0) !important;
            border: 1px solid #f7ffe6 !important;
        }
    </style>
</head>
<body>

<div id = "container">
    <div id = "image">
        <h1><strong style = "margin-left: 10px;"> Welcome to Baby Account Software!</strong>
            <!-- <a  href = "<?php echo base_url('/admin_login') ?>" class = "btn btn-warning "> Admin Login </a>-->
        </h1>
        <img src = "<?php echo base_url('assets/images/baby_account_img.jpg') ?>" class = "img-responsive"
             style = "height: 500px" />

    </div>

    <div id = "loginForm">
        <div class = "col-md-4 col-md-offset-3 col-sm-12">
            <div class = "login-panel panel panel-default">
                <div class = "panel-heading">
                    <h3 class = "panel-title">Please Login </h3>
                </div>
                <div class = "panel-body">
                    <?php
                    $attributes = array("class" => "form-horizontal", "id" => "loginform", "name" => "loginform");
                    echo form_open("admin/auth/admin_login/login", $attributes);
                    ?>
                    <?php echo $this->session->flashdata('msg'); ?>
                    <fieldset style = " padding: 15px;">
                        <div class = "form-group has-feedback">
                            <input type = "text" id = "username" name = "username" class = "form-control transparent-input"
                                   placeholder = "Email"
                                   value = "<?php echo set_value('username'); ?>" />
                            <span class = "glyphicon glyphicon-envelope form-control-feedback"></span>
                            <span class = "text-danger"><?php echo form_error('username'); ?></span>
                        </div>
                        <div class = "form-group has-feedback">
                            <input type = "password" id = "password" name = "password" placeholder = "Password"
                                   class = "form-control transparent-input"
                                   value = "<?php echo set_value('password'); ?>" />
                            <span class = "glyphicon glyphicon-lock form-control-feedback"></span>
                            <span class = "text-danger"><?php echo form_error('password'); ?></span>
                        </div>
                        <br />
                        <input class = "btn btn-lg btn-primary btn-block" name = "submit" type = "submit" id = "submit"
                               value = "login">
                    </fieldset>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>